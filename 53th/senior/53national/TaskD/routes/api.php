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
    $time=date("Y-m-d\TH:i:s");
    session_start();

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

    $image=function($row){
        $data=[];
        for($i=0;$i<$row->count();$i=$i+1){
            $mainrow=[
                "id"=>$row[$i]->id,
                "url"=>$row[$i]->url,
                "title"=>$row[$i]->title,
                "created_at"=>$row[$i]->created_at,
            ];
            $data[]=$mainrow;
        }
        return $data;
    };

    $imagedetail=function($row)use($user){
        $data=[];
        for($i=0;$i<$row->count();$i=$i+1){
            $userrow=DB::table("users")
                ->where(function($query)use($row,$i){
                    $query->where("id","=",$row[$i]->author_id);
                })->select("*")->get();
            $mainrow=[
                "id"=>$row[$i]->id,
                "url"=>$row[$i]->url,
                "author"=>$user($userrow,"normal"),
                "title"=>$row[$i]->title,
                "description"=>$row[$i]->description,
                "width"=>$row[$i]->width,
                "height"=>$row[$i]->height,
                "mimetype"=>$row[$i]->mimetype,
                "view_count"=>$row[$i]->view_count,
                "update_at"=>$row[$i]->update_at,
                "created_at"=>$row[$i]->created_at,
            ];
            $data[]=$mainrow;
        }
        return $data;
    };

    $loginerror=response()->json(["success"=>false,"message"=>"MSG_INVALID_LOGIN"],403);
    $userexist=response()->json(["success"=>false,"message"=>"MSG_USER_EXISTS"],409);
    $passworderror=response()->json(["success"=>false,"message"=>"MSG_PASSWORD_NOT_SECURE"],409);
    $tokenerror=response()->json(["success"=>false,"message"=>"MSG_INVALID_ACCESS_TOKEN"],401);
    $nopermission=response()->json(["success"=>false,"message"=>"MSG_PERMISSION_DENY"],403);
    $missingfield=response()->json(["success"=>false,"message"=>"MSG_MISSING_FIELD"],400);
    $datatypeerror=response()->json(["success"=>false,"message"=>"MSG_WROND_DATA_TYPE"],400);
    $posterror=response()->json(["success"=>false,"message"=>"MSG_POST_NOT_EXISTS"],404);
    $commenterror=response()->json(["success"=>false,"message"=>"MSG_COMMENT_NOT_EXISTS"],404);
    $usererror=response()->json(["success"=>false,"message"=>"MSG_USER_NOT_EXISTS"],404);
    $fileerror=response()->json(["success"=>false,"message"=>"MSG_INVALID_FILE_FORMAT"],400);

    Route::POST("/auth/login",function(Request $request)use($loginerror,$missingfield,$datatypeerror,$user,$logincheck){
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
                        $_SESSION["login"]=$row[0]->id;
                        return response()->json([
                            "success"=>true,
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

    Route::POST("/auth/register",function(Request $request)use($userexist,$passworderror,$missingfield,$datatypeerror,$user,$time){
        if($request->has("email")&&$request->has("nickname")&&$request->has("password")&&$request->has("profile_image")){
            $email=$request->input("email");
            $nickname=$request->input("nickname");
            $password=$request->input("password");
            $image=$request->file("profile_image");
            $imagetype=array("image/png","image/jpg");
            $row=DB::table("users")
                ->where(function($query)use($email){
                    $query->where("email","=",$email);
                })->select("*")->get();
            if($row->isEmpty()){
                if(filter_var($email,FILTER_VALIDATE_EMAIL)&&is_string($email)&&is_string($nickname)&&is_string($password)&&!in_array($image->getMimeType(),$imagetype)){
                    if(8<=strlen($password)&&strlen($password)<=24){
                        $imagepath=$image->storePublicly("profile_image","public"); // todo 圖片上傳
                        DB::table("users")->insert([
                            "email"=>$email,
                            "password"=>hash("sha256",$password),
                            "nick_name"=>$nickname,
                            "profile_image"=>$imagepath,
                            "type"=>"USER",
                            "created_at"=>$time
                        ]);
                        $row=DB::table("users")
                            ->where(function($query)use($email){
                                $query->where("email","=",$email);
                            })->select("*")->get();
                        return response()->json([
                            "success"=>true,
                            "data"=>$user($row,"normal")
                        ]);
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

    Route::POST("/auth/logout",function(Request $request)use($tokenerror,$logincheck){
        if($logincheck()!=NULL){
            $row=DB::table("users")
                ->where("id","=",$logincheck())
                ->update([
                    "access_token"=>NULL,
                ]);
            unset($_SESSION["login"]);
            return response()->json([
                "success"=>true,
                "data"=>""
            ]);
        }else{
            return $tokenerror;
        }
    });

    Route::GET("/images/search",function(Request $request)use($datatypeerror,$image){
        $ordertype=$request->input("order_by");
        $ordertype=$request->input("order_type");
        $keyword=$request->input("keyword");
        $page=$request->input("page");
        $pagesize=$request->input("page_size");
        if(!($request->has("order_by"))){ $orderby="created_at"; }
        if(!($request->has("order_type"))){ $ordertype="desc"; }
        if(!($request->has("keyword"))){ $keyword=""; }
        if(!($request->has("page"))){ $page=1; }
        if(!($request->has("pagesize"))){ $pagesize=10; }
        if(($orderby=="created_at"||$orderby=="like_count")&&($ordertype=="asc"||$ordertype=="desc")&&(1<=$pagesize&&$pagesize<=100)){
            $row=DB::table("posts")
                ->where("type","=","public")
                ->where(function($query)use($keyword){
                    $query->where("keyword","LIKE","%".$keyword."%");
                })
                ->orderBy($orderby,$ordertype)
                ->skip(($page-1)*$pagesize)
                ->take($pagesize)
                ->select("*")->get();
            return response()->json([
                "success"=>true,
                "data"=>[
                    "total_count"=>$row->count(),
                    "posts"=>$image($row)
                ]
            ]);
        }else{
            return $datatypeerror;
        }
    });

    Route::GET("/images/popular",function(Request $request)use($nopermission,$posterror,$logincheck){
    });

    Route::GET("/users/{user_id}/images",function(Request $request)use($datatypeerror,$usererror,$post){
    });

    Route::POST("/images/upload",function(Request $request)use($usererror,$user){
    });

    Route::PUT("/images/{image_id}",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
    });

    Route::GET("/images/{image_id}",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
    });

    Route::DELETE("/images/{image_id}",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
    });

    Route::GET("/images/{image_id}/comments",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
    });

    Route::POST("/images/{image_id}/comments",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
    });

    Route::DELETE("/comments/{comments_id}",function(Request $request)use($tokenerror,$datatypeerror,$imageerror){
    });
?>