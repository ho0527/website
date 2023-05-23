<?php
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\DB;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    date_default_timezone_set("Asia/Taipei");
    $time=date("Y-m-d H:i:s");

    $logincheck=function(){
        $row=DB::table("users")
            ->where(function($query){
                $query->whereNotNull("access_token");
            })->select("*")->get();
        if($row->isNotEmpty()){
            return $row[0]->id;
        }else{
            return NULL;
        }
    };

    $user=function($row,$type){
        $mainrow=[
            "id"=>$row[0]->id,
            "email"=>$row[0]->email,
            "nickname"=>$row[0]->nickname,
            "profile_image"=>$row[0]->profile_image,
            "type"=>$row[0]->type,
        ];
        if($type=="login"){
            $mainrow["access_token"]=$row[0]->access_token;
        }
        return $mainrow;
    };

    $post=function($row)use($user,$logincheck){
        $data=[];
        for($i=0;$i<$row->count();$i=$i+1){
            $id=$row[$i]->id;
            $likerow=DB::table("user_likes")
                ->where(function($query)use($id){
                    $query->where("post_id","=",$id);
                })->select("*")->get();
            $imagerow=DB::table("post_images")
                ->where(function($query)use($id){
                    $query->where("post_id","=",$id);
                })->select("*")->get();
            $userrow=DB::table("users")
                ->where(function($query)use($row,$i){
                    $query->where("id","=",$row[$i]->author_id);
                })->select("*")->get();
            if($row[$i]->location==""){ $location=NULL; }
            else{ $location=$row[$i]->location; }
            $mainrow=[
                "id"=>$row[$i]->id,
                "author"=>$user($userrow,"normal"),
                "image"=>$imagerow,
                "like_count"=>$likerow->count(),
                "content"=>$row[$i]->content,
                "type"=>$row[$i]->type,
                "tag"=>explode(" ",$row[$i]->tag),
                "location_name"=>$location,
            ];
            if($logincheck()==NULL){
                $mainrow["updated_at"]=$row[$i]->updated_at;
                $mainrow["created_at"]=$row[$i]->created_at;
            }else{
                $likerow2=DB::table("user_likes")
                    ->where(function($query)use($id,$logincheck){
                        $query->where("post_id","=",$id)
                            ->where("user_id","=",$logincheck());
                    })->select("*")->get();
                if($likerow2->isNotEmpty()){
                    $mainrow["liked"]=true;
                }else{
                    $mainrow["liked"]=false;
                }
                $mainrow["updated_at"]=$row[$i]->updated_at;
                $mainrow["created_at"]=$row[$i]->created_at;
            }
            $data[]=$mainrow;
        }
        return $data;
    };

    $loginerror=response()->json(["success"=>false,"message"=>"MSG_INVALID_LOGIN","data"=>""],403);
    $userexist=response()->json(["success"=>false,"message"=>"MSG_USER_EXISTS","data"=>""],409);
    $passworderror=response()->json(["success"=>false,"message"=>"MSG_PASSWORD_NOT_SECURE","data"=>""],409);
    $tokenerror=response()->json(["success"=>false,"message"=>"MSG_INVALID_ACCESS_TOKEN","data"=>""],401);
    $nopermission=response()->json(["success"=>false,"message"=>"MSG_PERMISSION_DENY","data"=>""],403);
    $missingfield=response()->json(["success"=>false,"message"=>"MSG_MISSING_FIELD","data"=>""],400);
    $datatypeerror=response()->json(["success"=>false,"message"=>"MSG_WROND_DATA_TYPE","data"=>""],400);
    $imageerror=response()->json(["success"=>false,"message"=>"MSG_IMAGE_CAN_NOT_PROCESS","data"=>""],400);
    $posterror=response()->json(["success"=>false,"message"=>"MSG_POST_NOT_EXISTS","data"=>""],404);
    $commenterror=response()->json(["success"=>false,"message"=>"MSG_COMMENT_NOT_EXISTS","data"=>""],404);
    $usererror=response()->json(["success"=>false,"message"=>"MSG_USER_NOT_EXISTS","data"=>""],404);

    Route::post("/auth/login",function(Request $request)use($loginerror,$missingfield,$datatypeerror,$user,$logincheck){
        if($logincheck()==NULL){
            if($request->has("email")&&$request->has("password")){
                $email=$request->input("email");
                $password=$request->input("password");
                $row=DB::table("users")
                    ->where(function($query)use($email){
                        $query->where("email","=",$email);
                    })->select("*")->get();
                if($row->isNotEmpty()&&$row[0]->password==$password){
                    if(is_string($email)&&is_string($password)){
                        DB::table("users")
                            ->where("id","=",$row[0]->id)
                            ->update([
                                "access_token"=>hash("sha256",$email),
                            ]);
                        $row=DB::table("users")
                            ->where(function($query)use($email){
                                $query->where("email","=",$email);
                            })->select("*")->get();
                        return response()->json([
                            "success"=>true,
                            "message"=>"",
                            "data"=>$user($row,"login")
                        ]);
                    }else{
                        return $datatypeerror;
                    }
                }else{
                    return $loginerror;
                }
            }else{
                return $missingfield;
            }
        }else{
            return "alredlogin";
        }
    });

    Route::post("/auth/logout",function(Request $request)use($tokenerror,$logincheck){
        if($logincheck()!=NULL){
            $row=DB::table("users")
                ->where("id","=",$logincheck())
                ->update([
                    "access_token"=>NULL,
                ]);
            return response()->json([
                "success"=>true,
                "message"=>"",
                "data"=>""
            ]);
        }else{
            return $tokenerror;
        }
    });

    Route::post("/auth/register",function(Request $request)use($userexist,$passworderror,$missingfield,$datatypeerror,$imageerror,$time){
        if($request->has("email")&&$request->has("nickname")&&$request->has("password")&&$request->has("profile_image")){
            $email=$request->input("email");
            $nickname=$request->input("nickname");
            $password=$request->input("password");
            $image=$request->file("profile_image");
            $imagetype=array("image/png","image/jpeg");
            $row=DB::table("users")
                ->where(function($query)use($email){
                    $query->where("email","=",$email);
                })->select("*")->get();
            if($row->isEmpty()){
                if(filter_var($email,FILTER_VALIDATE_EMAIL)&&is_string($email)&&is_string($nickname)&&is_string($password)){
                    if(8<=strlen($password)&&strlen($password)<=24){
                        if(!in_array($image->getMimeType(),$imagetype)){
                            $imagepath=$image->storePublicly("profile_image","public"); // todo 圖片上傳
                            $row=DB::table("users")->insert([
                                "email"=>$email,
                                "password"=>$password,
                                "nick_name"=>$nickname,
                                "profile_image"=>$imagepath,
                                "type"=>"USER",
                                "created_at"=>$time
                            ]);
                            return response()->json([
                                "success"=>true,
                                "message"=>"",
                                "data"=>$row
                            ]);
                        }else{
                            return $imageerror;
                        }
                    }else{
                        return $passworderror;
                    }
                }else{
                    return $datatypeerror;
                }
            }else{
                return $userexist;
            }
        }else{
            return $missingfield;
        }
    });

    Route::get("/images/public",function(Request $request)use($datatypeerror,$post){
        $ordertype=$request->input("order_by");
        $ordertype=$request->input("order_type");
        $content=$request->input("content");
        $tag=$request->input("tag");
        $location=$request->input("location_name");
        $page=$request->input("page");
        $pagesize=$request->input("page_size");
        if(!($request->has("order_by"))){ $orderby="created_at"; }
        if(!($request->has("order_type"))){ $ordertype="desc"; }
        if(!($request->has("content"))){ $content=""; }
        if(!($request->has("tag"))){ $tag=""; }
        if(!($request->has("location_name"))){ $location=""; }
        if(!($request->has("page"))){ $page=1; }
        if(!($request->has("pagesize"))){ $pagesize=10; }
        if(($orderby=="created_at"||$orderby=="like_count")&&($ordertype=="asc"||$ordertype=="desc")&&(1<=$pagesize&&$pagesize<=100)){
            $row=DB::table("posts")
                ->where("type","=","public")
                ->where(function($query)use($content,$tag,$location){
                    $query->where("content","LIKE","%".$content."%")
                        ->where("tag","LIKE","%".$tag."%")
                        ->where("location","LIKE","%".$location."%");
                })
                ->orderBy($orderby,$ordertype)
                ->skip(($page-1)*$pagesize)
                ->take($pagesize)
                ->select("*")->get();
            return response()->json([
                "success"=>true,
                "message"=>"",
                "data"=>[
                    "total_count"=>$row->count(),
                    "posts"=>$post($row)
                ]
            ]);
        }else{
            return $datatypeerror;
        }
    });

    Route::get("/images/popular",function(Request $request)use($nopermission,$posterror,$logincheck){
        $id=$request->route("post_id");
        $row=DB::table("posts")
            ->where(function($query)use($id){
                $query->where("id","=",$id);
            })->select("*")->get();
        if($row->isNotEmpty()){
            if(($logincheck()==NULL&&$row[0]->type=="public")||($logincheck()!=NULL&&$row[0]->type=="public")){
                $commentrow=DB::table("comments")
                    ->where(function($query)use($id){
                        $query->where("post_id","=",$id);
                    })->select("*")->get();
                return response()->json([
                    "success"=>true,
                    "message"=>"",
                    "data"=>[
                        "post"=>$row[0],
                        "comments"=>$commentrow
                    ]
                ]);
            }else{
                return $nopermission;
            }
        }else{
            return $posterror;
        }
    });

    Route::get("/users/{user_id}/images",function(Request $request)use($datatypeerror,$usererror,$post){
        $userid=$request->route("user_id");
        $ordertype=$request->input("order_by");
        $ordertype=$request->input("order_type");
        $content=$request->input("content");
        $tag=$request->input("tag");
        $location=$request->input("location_name");
        $page=$request->input("page");
        $pagesize=$request->input("page_size");
        if(!($request->has("order_by"))){ $orderby="created_at"; }
        if(!($request->has("order_type"))){ $ordertype="desc"; }
        if(!($request->has("content"))){ $content=""; }
        if(!($request->has("tag"))){ $tag=""; }
        if(!($request->has("location_name"))){ $location=""; }
        if(!($request->has("page"))){ $page=1; }
        if(!($request->has("pagesize"))){ $pagesize=10; }
        $row=DB::table("users")
            ->where(function($query)use($userid){
                $query->where("id","=",$userid);
            })->select("*")->get();
        if($row->isNotEmpty()){
            if(($orderby=="created_at"||$orderby=="like_count")&&($ordertype=="asc"||$ordertype=="desc")&&(1<=$pagesize&&$pagesize<=100)){
                $row=DB::table("posts")
                    ->where("author_id","=",$userid)
                    ->where(function($query)use($content,$tag,$location){
                        $query->where("content","LIKE","%".$content."%")
                            ->where("tag","LIKE","%".$tag."%")
                            ->where("location","LIKE","%".$location."%");
                    })
                    ->orderBy($orderby,$ordertype)
                    ->skip(($page-1)*$pagesize)
                    ->take($pagesize)
                    ->select("*")->get();
                return response()->json([
                    "success"=>true,
                    "message"=>"",
                    "data"=>[
                        "total_count"=>$row->count(),
                        "posts"=>$post($row)
                    ]
                ]);
            }else{
                return $datatypeerror;
            }
        }else{
            return $usererror;
        }
    });

    Route::post("/images/upload",function(Request $request)use($usererror,$user){
        $id=$request->route("user_id");
        $row=DB::table("users")
            ->where(function($query)use($id){
                $query->where("id","=",$id);
            })->select("*")->get();
        if($row->isNotEmpty()){
            return response()->json([
                "success"=>true,
                "message"=>"",
                "data"=>$user($row,"normal")
            ]);
        }else{
            return $usererror;
        }
    });

    Route::put("/images/{image_id}",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
        return view("welcome");
    });

    Route::get("/images/{image_id}",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
        return view("welcome");
    });

    Route::delete("/images/{image_id}",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
        return view("welcome");
    });

    Route::get("/images/{image_id}/comments",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
        return view("welcome");
    });

    Route::post("/images/{image_id}/comments",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
        return view("welcome");
    });

    Route::delete("/comments/{comments_id}",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
        return view("welcome");
    });
?>