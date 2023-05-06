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

    function logincheck(){
        $row=DB::table("users")
            ->where(function($query){
                $query->where("access_token","!=",NULL);
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
        $email=$request->input("email");
        $password=$request->input("password");
        $row=DB::table("users")
            ->where(function($query)use($email){
                $query->where("email","=",$email);
            })->select("*")->get();
        if($row->isNotEmpty()){
            if($row[0]->password==$password){
                $row=DB::table("users")
                    ->where("id","=",$row[0]->id)
                    ->update([
                        "access_token"=>hash("sha256",$email),
                    ]);
                return response()->json([
                    "success"=>true,
                    "message"=>"",
                    "data"=>$row[0]->id,
                ]);
            }else{
                return $loginerror;
            }
        }else{
            return $loginerror;
        }
    });

    Route::post("/user/logout",function(Request $request)use($tokenerror){
        $row=DB::table("users")
            ->where(function($query)use($email){
                $query->where("access_token","!=",NULL);
            })->select("*")->get();
        if($row->isNotEmpty()){
            $row=DB::table("users")
                ->where("id","=",$row[0]->id)
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

    Route::post("/user/register",function(Request $request)use($userexist,$passworderror,$missingfield,$datatypeerror,$imageerror){
        $email=$request->input("email");
        $nickname=$request->input("nickname");
        $password=$request->input("password");  
        $image=$request->input("image.bmp");
        $row=DB::table("users")
            ->where(function($query)use($email){
                $query->where("email","=",$email);
            })->select("*")->get();
        if($row->isEmpty()){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)&&is_string($email)&&is_string($nickname)&&is_string($password)&&is_file($image)){
                if(!(8<=strlen($password)&&strlen($password)<=24)){
                    return response()->json([
                        "success"=>true,
                        "message"=>"",
                        "data"=>$row[0]->id
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
    });

    Route::get("/post/public",function(Request $request)use($datatypeerror){
        $orderby=$request->input("order_by");
        $ordertype=$request->input("order_type");
        $context=$request->input("context");
        $tag=$request->input("tag");
        $location=$request->input("location_name");
        $page=$request->input("page");
        $pagesize=$request->input("page_size");
        if(empty($orderby)){ $orderby="created_at"; }
        if(empty($ordertype)){ $ordertype="desc"; }
        if(empty($page)){ $page=1; }
        if(empty($pagesize)){ $pagesize=10; }
        if(($orderby=="created_at"||$orderby=="like_count")&&($ordertype=="asc"||$ordertype=="desc")&&(1<=$pagesize&&$pagesize<=100)){
            $row=DB::table("posts")
                ->where(function($query)use($orderby,$ordertype,$context,$tag,$location,$page,$pagesize){
                    if(!empty($context)){
                        $query->where("context","LIKE","%".$context."%");
                    }
                });
            return response()->json([
                "success"=>true,
                "message"=>"",
                "data"=>[
                    "total_count"=>count($row),
                    "posts"=>$post
                ]
            ]);
        }else{
            return $datatypeerror;
        }
    });

    Route::get("/post/{post_id}",function(Request $request)use($nopermission,$posterror){
        $id=route("post_id");
        $row=DB::table("posts")
            ->where(function($query)use($id){
                $query->where("id","=",$id);
            })->select("*")->get();
        if($row->isNotEmpty()){
            if($row[0]->type!="public"){

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
        return view("welcome");
    });

    Route::get("/user/{user_id}/profile",function(Request $request)use($usererror){
        return view("welcome");
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