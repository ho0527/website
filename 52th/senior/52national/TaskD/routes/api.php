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
        return view("welcome");
    });

    Route::post("/user/register",function(Request $request)use($userexist,$passworderror,$missingfield,$datatypeerror,$imageerror){
        $email=$request->input("email");
        $nickname=$request->input("nickname");
        $password=$request->input("password");  
        $image=$request->input("image");
        $row=DB::table("users")
            ->where(function($query)use($email){
                $query->where("email","=",$email);
            })->select("*")->get();
        if($row->isEmpty()){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)&&is_string($email)&&is_string($nickname)&&is_string($password)&&is_file($image)){
                if(!(8<=strlen($password)&&strlen($password)<=24)){
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
        return view("welcome");
    });

    Route::get("/post/{post_id}",function(Request $request)use($nopermission,$posterror){
        return view("welcome");
    });

    Route::post("/post",function(Request $request)use($tokenerror,$missingfield,$datatypeerror,$imageerror){
        return view("welcome");
    });

    Route::post("/post",function(Request $request)use($tokenerror,$nopermission,$missingfield,$datatypeerror,$posterror){
        return view("welcome");
    });

    Route::delete("/post",function(Request $request)use($tokenerror,$nopermission,$posterror){
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