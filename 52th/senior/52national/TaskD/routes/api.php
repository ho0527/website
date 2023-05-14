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

    function logincheck(){
        $row=DB::table("users")
            ->where(function($query){
                $query->whereNotNull("access_token");
            })->select("*")->get();
        if($row->isNotEmpty()){
            return $row[0]->id;
        }else{
            return NULL;
        }
    }

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

    Route::post("/user/login",function(Request $request)use($loginerror,$missingfield,$datatypeerror){
        if(logincheck()==NULL){
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
                        return response()->json([
                            "success"=>true,
                            "message"=>"",
                            "data"=>$row[0]
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

    Route::post("/user/logout",function(Request $request)use($tokenerror){
        if(logincheck()!=NULL){
            $row=DB::table("users")
                ->where("id","=",logincheck())
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

    Route::post("/user/register",function(Request $request)use($userexist,$passworderror,$missingfield,$datatypeerror,$imageerror,$time){
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

    Route::get("/post/public",function(Request $request)use($datatypeerror){
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
                    "posts"=>$row
                ]
            ]);
        }else{
            return $datatypeerror;
        }
    });

    Route::get("/post/{post_id}",function(Request $request)use($nopermission,$posterror){
        $id=$request->route("post_id");
        $row=DB::table("posts")
            ->where(function($query)use($id){
                $query->where("id","=",$id);
            })->select("*")->get();
        $commentrow=DB::table("comments")
            ->where(function($query)use($id){
                $query->where("post_id","=",$id);
            })->select("*")->get();
        if($row->isNotEmpty()){
            if((logincheck()==NULL&&$row[0]->type=="public")||(logincheck()!=NULL&&$row[0]->type=="public")){
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

    Route::post("/post",function(Request $request)use($tokenerror,$missingfield,$datatypeerror,$imageerror){
        return view("welcome");
    });

    Route::post("/post/{post_id}",function(Request $request)use($tokenerror,$nopermission,$missingfield,$datatypeerror,$posterror){
        return view("welcome");
    });

    Route::delete("/post/{post_id}",function(Request $request)use($tokenerror,$nopermission,$posterror){
        return view("welcome");
    });

    Route::post("/post/{post_id}/favorite",function(Request $request)use($tokenerror,$nopermission,$missingfield,$datatypeerror,$posterror){
        return view("welcome");
    });

    Route::get("/post/favorite",function(Request $request)use($tokenerror,$datatypeerror){
        return view("welcome");
    });

    Route::post("/post/{post_id}/comment",function(Request $request)use($tokenerror,$nopermission,$missingfield,$datatypeerror,$posterror){
        return view("welcome");
    });

    Route::post("/post/{post_id}/comment/{comment_id}",function(Request $request)use($tokenerror,$nopermission,$missingfield,$datatypeerror,$posterror,$commenterror){
        return view("welcome");
    });

    Route::delete("/post/{post_id}/comment/{comment_id}",function(Request $request)use($tokenerror,$nopermission,$missingfield,$datatypeerror,$posterror,$commenterror){
        return view("welcome");
    });

    Route::get("/user/{user_id}/post",function(Request $request)use($datatypeerror,$usererror){
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
                        "posts"=>$row
                    ]
                ]);
            }else{
                return $datatypeerror;
            }
        }else{
            return $usererror;
        }
    });

    Route::get("/user/{user_id}/",function(Request $request)use($usererror){
        $id=$request->route("user_id");
        $row=DB::table("users")
            ->where(function($query)use($id){
                $query->where("id","=",$id);
            })->select("*")->get();
        if($row->isNotEmpty()){
            return response()->json([
                "success"=>true,
                "message"=>"",
                "data"=>$row
            ]);
        }else{
            return $usererror;
        }
    });

    Route::post("/user/{user_id}/profile",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
        return view("welcome");
    });

    Route::get("/user/{user_id}/follow",function(Request $request)use($tokenerror,$datatypeerror){
        return view("welcome");
    });

    Route::post("/user/{user_id}/follow",function(Request $request)use($tokenerror,$datatypeerror,$usererror){
        return view("welcome");
    });

    Route::delete("/user/{user_id}/follow",function(Request $request){
        return view("welcome");
    });
?>