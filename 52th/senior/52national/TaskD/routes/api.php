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
    session_start();
    if(!isset($_SESSION["data"])){ $_SESSION["data"]=""; }

    $user=function($row,$type){
        $mainrow=[
            "id"=>$row->id,
            "email"=>$row->email,
            "nickname"=>$row->nickname,
            "profile_image"=>$row->profile_image,
            "type"=>$row->type,
        ];
        if($type=="login"){
            $mainrow["access_token"]=$row->access_token;
        }
        return $mainrow;
    };

    $image=function($row){
        $data=[];
        $id=$row->id;
        $imagerow=DB::table("post_images")
            ->where(function($query)use($id){
                $query->where("post_id","=",$id);
            })->select("*")->get();
        for($i=0;$i<$imagerow->count();$i=$i+1){
            $data[]=[
                "id"=>$imagerow[$i]->id,
                "url"=>$imagerow[$i]->filename,
                "width"=>$imagerow[$i]->width,
                "height"=>$imagerow[$i]->height,
                "created_at"=>$imagerow[$i]->created_at
            ];
        }
        return $data;
    };

    $post=function($row)use($user,$image){
        $data=[];
        for($i=0;$i<count($row);$i=$i+1){
            $id=$row[$i]->id;
            $likerow=DB::table("user_likes")
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
                "id"=>$id,
                "author"=>$user($userrow[0],"normal"),
                "image"=>$image($row[$i]),
                "like_count"=>count($likerow),
                "content"=>$row[$i]->content,
                "type"=>$row[$i]->type,
                "tag"=>explode(" ",$row[$i]->tag),
                "location_name"=>$location,
            ];
            if($_SESSION["data"]!=""){
                $likerow2=DB::table("user_likes")
                    ->where(function($query)use($id){
                        $query->where("post_id","=",$id)
                            ->where("user_id","=",$_SESSION["data"]);
                    })->select("*")->get();
                if($likerow2->isNotEmpty()){
                    $mainrow["liked"]=true;
                }else{
                    $mainrow["liked"]=false;
                }
            }
            $mainrow["updated_at"]=$row[$i]->updated_at;
            $mainrow["created_at"]=$row[$i]->created_at;
            $data[]=$mainrow;
        }
        return $data;
    };

    $comment=function($row)use($user){
        $data=[];
        for($i=0;$i<count($row);$i=$i+1){
            $userrow=DB::table("users")
                ->where("id","=",$row[$i]->user_id)
                ->select("*")->get();
            $data[]=[
                "id"=>$row[$i]->id,
                "user"=>$user($userrow[0],"normal"),
                "content"=>$row[$i]->content,
                "created_at"=>$row[$i]->created_at
            ];
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

    # api 01
    Route::POST("/user/login",function(Request $request)use($loginerror,$missingfield,$datatypeerror,$user){
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
                    $_SESSION["data"]=$row[0]->id;
                    return response()->json([
                        "success"=>true,
                        "message"=>"",
                        "data"=>$user($row[0],"login")
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
    });

    # api 02
    Route::POST("/user/logout",function(Request $request)use($tokenerror){
        if($_SESSION["data"]!=""){
            DB::table("users")
                ->where("id","=",$_SESSION["data"])
                ->update([
                    "access_token"=>NULL,
                ]);
            $_SESSION["data"]="";
            return response()->json([
                "success"=>true,
                "message"=>"",
                "data"=>""
            ]);
        }else{
            return $tokenerror;
        }
    });

    # api 03
    Route::POST("/user/register",function(Request $request)use($userexist,$passworderror,$missingfield,$datatypeerror,$imageerror,$time,$user){
        if($request->has("email")&&$request->has("nickname")&&$request->has("password")&&$request->hasFile("profile_image")){
            $email=$request->input("email");
            $nickname=$request->input("nickname");
            $password=$request->input("password");
            $image=$request->file("profile_image");
            $row=DB::table("users")
                ->where(function($query)use($email){
                    $query->where("email","=",$email);
                })->select("*")->get();
            if($row->isEmpty()){
                if(filter_var($email,FILTER_VALIDATE_EMAIL)&&is_string($email)&&is_string($nickname)&&is_string($password)){
                    if(8<=strlen($password)&&strlen($password)<=24){
                        if(in_array($image->extension(),["png","jpg"])){
                            $path="http://localhost/website/52th/senior/52national/TaskD/storage/app/".$image->store("upload/profile");
                            DB::table("users")->insert([
                                "email"=>$email,
                                "password"=>$password,
                                "nickname"=>$nickname,
                                "profile_image"=>$path,
                                "type"=>"USER",
                                "created_at"=>$time
                            ]);
                            $row=DB::table("users")
                                ->where(function($query)use($email){
                                    $query->where("email","=",$email);
                                })->select("*")->get();
                            return response()->json([
                                "success"=>true,
                                "message"=>"",
                                "data"=>$user($row[0],"normal")
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

    # api 04
    Route::GET("/post/public",function(Request $request)use($datatypeerror,$post){
        $orderby=$request->input("order_by");
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

    # api 05
    Route::GET("/post/{post_id}",function(Request $request)use($nopermission,$posterror,$post,$comment){
        $id=$request->route("post_id");
        $row=DB::table("posts")
            ->where(function($query)use($id){
                $query->where("id","=",$id);
            })->select("*")->get();
        if($row->isNotEmpty()){
            $follow=DB::table("user_follows")
                ->where("user_id", "=", $row[0]->author_id)
                ->where("follow_user_id", "=", $_SESSION["data"])
                ->select("*")->get();
            if(($row[0]->type=="public")||(($follow->isNotEmpty()||$_SESSION["data"]==$row[0]->author_id)&&$row[0]->type=="only_follow")||($_SESSION["data"]==$row[0]->author_id&&$row[0]->type=="only_self")){
                $commentrow=DB::table("comments")
                    ->where(function($query)use($id){
                        $query->where("post_id","=",$id);
                    })->select("*")->get();
                return response()->json([
                    "success"=>true,
                    "message"=>"",
                    "data"=>[
                        "post"=>$post($row),
                        "comments"=>$comment($commentrow)
                    ]
                ]);
            }else{
                return $nopermission;
            }
        }else{
            return $posterror;
        }
    });

    # api 06
    Route::POST("/post",function(Request $request)use($tokenerror,$missingfield,$datatypeerror,$imageerror,$time,$post){
        if($_SESSION["data"]!=""){
            if($request->has("type")&&$request->has("content")&&$request->hasFile("images")){
                $type=$request->input("type");
                $tag=$request->input("tags");
                $content=$request->input("content");
                $location=$request->input("location_name");
                $image=$request->file("images");
                if(!($request->has("tags"))){ $tag=""; }
                if(!($request->has("location_name"))){ $location=""; }
                if(is_string($type)&&is_string($tag)&&is_string($content)&&is_string($location)&&($type=="public"||$type=="only_follow"||$type=="only_self")){
                    $tagtemp=explode(" ",$tag);
                    DB::table("posts")->insert([
                        "author_id"=>$_SESSION["data"],
                        "content"=>$content,
                        "type"=>$type,
                        "tag"=>implode(" ",$tagtemp),
                        "location"=>$location,
                        // "place_lat"=>$_SESSION["data"],
                        // "place_lng"=>$_SESSION["data"],
                        "created_at"=>$time,
                    ]);
                    $row=DB::table("posts")
                        ->latest()
                        ->select("*")->get();
                    $id=$row[0]->id;
                    $row=DB::table("posts")
                        ->where(function($query)use($id){
                            $query->where("id","=",$id);
                        })
                        ->select("*")->get();
                    for($i=0;$i<count($image);$i=$i+1){
                        if(in_array($image[$i]->extension(),["png","jpg"])){
                            $path="http://localhost/website/52th/senior/52national/TaskD/storage/app/".$image[$i]->store("upload/image");
                            $imagedata=getimagesize(storage_path("app/".$path));
                            DB::table("post_images")->insert([
                                "post_id"=>$id,
                                "width"=>$imagedata[0],
                                "height"=>$imagedata[1],
                                "filename"=>$path,
                                "created_at"=>$time
                            ]);
                        }else{
                            $row=DB::table("posts")
                                ->where(function($query)use($id){
                                    $query->where("id","=",$id);
                                })->delete();
                            $row=DB::table("post_images")
                                ->where(function($query)use($id){
                                    $query->where("id","=",$id);
                                })->delete();
                            return $imageerror;
                        }
                    }
                    return response()->json([
                        "success"=>true,
                        "message"=>"",
                        "data"=>$post($row)
                    ]);
                }else{
                    return $datatypeerror;
                }
            }else{
                return $missingfield;
            }
        }else{
            return $tokenerror;
        }
    });

    # api 07
    Route::POST("/post/{post_id}",function(Request $request)use($tokenerror,$nopermission,$missingfield,$datatypeerror,$posterror,$time,$post){
        if($_SESSION["data"]!=""){
            $id=$request->route("post_id");
            $row=DB::table("posts")
                ->where(function($query)use($id){
                    $query->where("id","=",$id);
                })->select("*")->get();
            if($row->isNotEmpty()){
                if($row[0]->author_id==$_SESSION["data"]){
                    if($request->has("type")&&$request->has("content")){
                        $type=$request->input("type");
                        $tag=$request->input("tags");
                        $content=$request->input("content");
                        if(!($request->has("tags"))){ $tag=""; }
                        if(is_string($type)&&is_string($tag)&&is_string($content)&&($type=="public"||$type=="only_follow"||$type=="only_self")){
                            $tagtemp=explode(" ",$tag);
                            DB::table("posts")
                                ->where("id","=",$id)
                                ->update([
                                    "content"=>$content,
                                    "type"=>$type,
                                    "tag"=>implode(" ",$tagtemp),
                                    "updated_at"=>$time,
                                ]);
                            $row=DB::table("posts")
                                ->where(function($query)use($id){
                                    $query->where("id","=",$id);
                                })
                                ->select("*")->get();
                            return response()->json([
                                "success"=>true,
                                "message"=>"",
                                "data"=>$post($row)
                            ]);
                        }else{
                            return $datatypeerror;
                        }
                    }else{
                        return $missingfield;
                    }
                }else{
                    return $nopermission;
                }
            }else{
                return $posterror;
            }
        }else{
            return $tokenerror;
        }
    });

    # api 08
    Route::DELETE("/post/{post_id}",function(Request $request)use($tokenerror,$nopermission,$posterror){
        if($_SESSION["data"]!=""){
            $id=$request->route("post_id");
            $row=DB::table("posts")
                ->where(function($query)use($id){
                    $query->where("id","=",$id);
                })->select("*")->get();
            if($row->isNotEmpty()){
                if($row[0]->author_id==$_SESSION["data"]){
                    $row=DB::table("posts")
                        ->where("id","=",$id)
                        ->delete();
                    return response()->json([
                        "success"=>true,
                        "message"=>"",
                        "data"=>""
                    ]);
                }else{
                    return $nopermission;
                }
            }else{
                return $posterror;
            }
        }else{
            return $tokenerror;
        }
    });

    # api 09
    Route::POST("/post/{post_id}/favorite",function(Request $request)use($tokenerror,$nopermission,$missingfield,$datatypeerror,$posterror){
        if($_SESSION["data"]!=""){
            $id=$request->route("post_id");
            $userid=$_SESSION["data"];
            $row=DB::table("posts")
                ->where(function($query)use($id){
                    $query->where("id","=",$id);
                })->select("*")->get();
            if($row->isNotEmpty()){
                if($row[0]->author_id!=$_SESSION["data"]){
                    if($request->has("favorite")){
                        $type=$request->input("favorite");
                        if($type==true){
                            $row=DB::table("user_likes")
                                ->where("post_id","=",$id)
                                ->where("user_id","=",$userid)
                                ->select("*")->get();
                            if($row->isEmpty()){
                                $row=DB::table("user_likes")->insert([
                                    "user_id"=>$userid,
                                    "post_id"=>$id,
                                ]);
                            }else{
                                $row=DB::table("user_likes")
                                    ->where("post_id","=",$id)
                                    ->where("user_id","=",$userid)
                                    ->delete();
                            }
                            return response()->json([
                                "success"=>true,
                                "message"=>"",
                                "data"=>""
                            ]);
                        }else{
                            return $datatypeerror;
                        }
                    }else{
                        return $missingfield;
                    }
                }else{
                    return $nopermission;
                }
            }else{
                return $posterror;
            }
        }else{
            return $tokenerror;
        }
    });

    # api 10
    Route::GET("/post/favorite",function(Request $request)use($tokenerror,$datatypeerror,$post){
        echo("yuewiqedhyfegwrveiwehdygf");
        if($_SESSION["data"]!=""){
            $id=$_SESSION["data"];
            $orderby=$request->input("order_by");
            $ordertype=$request->input("order_type");
            $page=$request->input("page");
            $pagesize=$request->input("page_size");
            if(!($request->has("order_by"))){ $orderby="created_at"; }
            if(!($request->has("order_type"))){ $ordertype="desc"; }
            if(!($request->has("page"))){ $page=1; }
            if(!($request->has("pagesize"))){ $pagesize=10; }
            if(($orderby=="created_at"||$orderby=="like_count")&&($ordertype=="asc"||$ordertype=="desc")&&(1<=$pagesize&&$pagesize<=100)){
                $row=DB::table("user_likes")
                    ->where("id","=",$id)
                    ->orderBy($orderby,$ordertype)
                    ->skip(($page-1)*$pagesize)
                    ->take($pagesize)
                    ->select("*")->get();
                return response()->json([
                    "success"=>true,
                    "message"=>"",
                    "data"=>[
                        "posts"=>$post($row)
                    ]
                ]);
            }else{
                return $datatypeerror;
            }
        }else{
            return $tokenerror;
        }
    });

    # api 11
    Route::POST("/post/{post_id}/comment",function(Request $request)use($tokenerror,$nopermission,$missingfield,$datatypeerror,$posterror,$comment){
        if($_SESSION["data"]!=""){
            $id=$request->route("post_id");
            $userid=$_SESSION["data"];
            $row=DB::table("posts")
                ->where(function($query)use($id){
                    $query->where("id","=",$id);
                })->select("*")->get();
            if($row->isNotEmpty()){
                if($row[0]->author_id!=$_SESSION["data"]){
                    if($request->has("content")){
                        $type=$request->input("content");
                        if($type==true){
                            $row=DB::table("user_likes")
                                ->where("post_id","=",$id)
                                ->where("user_id","=",$userid)
                                ->select("*")->get();
                            if($row->isEmpty()){
                                $row=DB::table("user_likes")->insert([
                                    "user_id"=>$userid,
                                    "post_id"=>$id,
                                ]);
                            }else{
                                $row=DB::table("user_likes")
                                    ->where("post_id","=",$id,"AND","user_id","=",$userid)
                                    ->delete();
                            }
                            return response()->json([
                                "success"=>true,
                                "message"=>"",
                                "data"=>$comment
                            ]);
                        }else{
                            return $datatypeerror;
                        }
                    }else{
                        return $missingfield;
                    }
                }else{
                    return $nopermission;
                }
            }else{
                return $posterror;
            }
        }else{
            return $tokenerror;
        }
    });

    # api 12
    Route::POST("/post/{post_id}/comment/{comment_id}",function(Request $request)use($tokenerror,$nopermission,$missingfield,$datatypeerror,$posterror,$commenterror){
        return view("welcome");
    });

    # api 13
    Route::DELETE("/post/{post_id}/comment/{comment_id}",function(Request $request)use($tokenerror,$nopermission,$missingfield,$datatypeerror,$posterror,$commenterror){
        return view("welcome");
    });

    # api 14
    Route::GET("/user/{user_id}/post",function(Request $request)use($datatypeerror,$usererror,$post){
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

    # api 15
    Route::GET("/user/{user_id}/",function(Request $request)use($usererror,$user){
        $id=$request->route("user_id");
        $row=DB::table("users")
            ->where(function($query)use($id){
                $query->where("id","=",$id);
            })->select("*")->get();
        if($row->isNotEmpty()){
            return response()->json([
                "success"=>true,
                "message"=>"",
                "data"=>$user($row[0],"normal")
            ]);
        }else{
            return $usererror;
        }
    });

    # api 16
    Route::POST("/user/{user_id}/profile",function(Request $request)use($tokenerror,$nopermission,$datatypeerror,$usererror,$imageerror,$time,$user){
        if($_SESSION["data"]!=""){
            $id=$request->route("user_id");
            if($id==$_SESSION["data"]){
                $row=DB::table("users")
                    ->where("id","=",$id)
                    ->select("*")->get();
                if($row->isNotEmpty()){
                    if($request->has("nickname")){
                        $nickname=$request->input("nickname");
                        if(preg_match("/^[a-z0-9_]{4,16}$/",$nickname)){
                            DB::table("users")->update([
                                "nickname"=>$nickname
                            ]);
                        }else{
                            return $datatypeerror;
                        }
                    }
                    if($request->hasFile("profile_image")){
                        $image=$request->file("profile_image");
                        if(in_array($image->extension(),["png","jpg"])){
                            $path="http://localhost/website/52th/senior/52national/TaskD/storage/app/".$image->store("upload/profile");
                            DB::table("users")->update([
                                "profile_image"=>$path
                            ]);
                        }else{
                            return $imageerror;
                        }
                    }
                    DB::table("users")->update([
                        "updated_at"=>$time
                    ]);
                    $row=DB::table("users")
                        ->where("id","=",$id)
                        ->select()->get();
                    return response()->json([
                        "success"=>true,
                        "message"=>"",
                        "data"=>$user($row[0],"normal")
                    ]);
                }else{
                    return $usererror;
                }
            }else{
                return $nopermission;
            }
        }else{
            return $tokenerror;
        }
    });

    # api 17
    Route::GET("/user/{user_id}/follow",function(Request $request)use($tokenerror,$datatypeerror,$user){
        if($_SESSION["data"]!=""){
            $id=$_SESSION["data"];
            $id=$request->route("user_id");
            $orderby=$request->input("order_by");
            $ordertype=$request->input("order_type");
            $page=$request->input("page");
            $pagesize=$request->input("page_size");
            if(!($request->has("order_by"))){ $orderby="created_at"; }
            if(!($request->has("order_type"))){ $ordertype="desc"; }
            if(!($request->has("page"))){ $page=1; }
            if(!($request->has("pagesize"))){ $pagesize=10; }
            if(($orderby=="created_at"||$orderby=="like_count")&&($ordertype=="asc"||$ordertype=="desc")&&(1<=$pagesize&&$pagesize<=100)){
                $row=DB::table("user_follows")
                    ->where("user_id","=",$id)
                    ->orderBy($orderby,$ordertype)
                    ->skip(($page-1)*$pagesize)
                    ->take($pagesize)
                    ->select("*")->get();
                return response()->json([
                    "success"=>true,
                    "message"=>"",
                    "data"=>[
                        "posts"=>$user($row)
                    ]
                ]);
            }else{
                return $datatypeerror;
            }
        }else{
            return $tokenerror;
        }
    });

    # api 18
    Route::POST("/user/{user_id}/follow",function(Request $request)use($tokenerror,$usererror){
        if($_SESSION["data"]!=""){
            $id=$request->route("user_id");
            $row=DB::table("users")
                ->where("id","=",$id)
                ->select("*")->get();
            if($row->isNotEmpty()){
                $row=DB::table("user_follows")->insert([
                    "user_id"=>$id,
                    "follow_user_id"=>$_SESSION["data"]
                ]);
                return response()->json([
                    "success"=>true,
                    "message"=>"",
                    "data"=>""
                ]);
            }else{
                return $usererror;
            }
        }else{
            return $tokenerror;
        }
    });

    # api 19
    Route::DELETE("/user/{user_id}/follow",function(Request $request)use($tokenerror,$usererror){
        if($_SESSION["data"]!=""){
            $id=$request->route("user_id");
            $row=DB::table("users")
                ->where("id","=",$id)
                ->select("*")->get();
            if($row->isNotEmpty()){
                $row=DB::table("user_follows")
                    ->where("user_id","=",$id,"AND","follow_user_id","=",$_SESSION["data"])
                    ->delete();
                return response()->json([
                    "success"=>true,
                    "message"=>"",
                    "data"=>""
                ]);
            }else{
                return $usererror;
            }
        }else{
            return $tokenerror;
        }
    });
?>