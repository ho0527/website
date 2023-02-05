<?php
    namespace App\Http\Controllers;
    use App\Models\User;
    use App\Http\Controllers\Controller;
    // use Illuminate\Http\Route;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    // include("../../link.php");

    // Route::group(["prefix" =>"home"],function(){
    //     Route::get("/index",[HomeController::class,"index"]);
    //     Route::post("/index",[HomeController::class,"indexProcess"]);
    //     Route::get("/about",[HomeController::class,"about"]);
    //     Route::get("/main",[HomeController::class,"main"]);
    // });

    class register extends Controller{
        public function register(Request $request){
            $validator=Validator::make($request->all(),[//提供的 Validator 來驗證 $request (來自客戶端的請求) 的資料是否符合規定。
                "email"=>"required|email|unique:users",//required->必填 unique->唯一
                "nickname"=>"required|string",
                "password"=>"required|string|min:8|max:24",
                "profile_image"=>"required|file|mimes:png,jpg"
            ],[
                "email.unique"=>"MSG_USER_EXISTS",
                "password.min"=>"MSG_PASSWORD_NOT_SECURE",
                "password.max"=>"MSG_PASSWORD_NOT_SECURE",
                "email.required"=>"MSG_MISSING_FLELD",
                "nickname.required"=>"MSG_MISSING_FLELD",
                "password.required"=>"MSG_MISSING_FLELD",
                "profile.required"=>"MSG_MISSING_FLELD",
                "email.email"=>"MSG_WORND_DATA_TYPE",
                "nickname.string"=>"MSG_WORND_DATA_TYPE",
                "password.string"=>"MSG_WORND_DATA_TYPE",
                "profile.file"=>"MSG_WORND_DATA_TYPE",
                "profile.mimes"=>"MSG_IMAGE_CAN_NOT_PROCESS",
            ]);
            $errors409=[
                "email.unique"=>"MSG_USER_EXISTS",
                "password.min"=>"MSG_PASSWORD_NOT_SECURE",
                "password.max"=>"MSG_PASSWORD_NOT_SECURE"
            ];
            $errors400=[
                "email.required"=>"MSG_MISSING_FLELD",
                "nickname.required"=>"MSG_MISSING_FLELD",
                "password.required"=>"MSG_MISSING_FLELD",
                "profile.required"=>"MSG_MISSING_FLELD",
                "email.email"=>"MSG_WORND_DATA_TYPE",
                "nickname.string"=>"MSG_WORND_DATA_TYPE",
                "password.string"=>"MSG_WORND_DATA_TYPE",
                "profile.file"=>"MSG_WORND_DATA_TYPE",
                "profile.mimes"=>"MSG_IMAGE_CAN_NOT_PROCESS"
            ];
            if($validator->fails()){//如果失敗
                $errors = $validator->errors();
                if($errors->has("email.unique")||$errors->has("password.min")||$errors->has("password.max")){
                    return response()->json([
                        "success"=>false,
                        "message"=>$errors409,
                    ],409);
                }else{
                    return response()->json([
                        "success"=>false,
                        "message"=>$errors400,
                    ],400);
                }
            }
            $user=new User();
            $user->email=$request->input("email");
            $user->nickname=$request->input("nickname");
            $user->password=Hash::make($request->input("password"));
            // handle profile image upload
            $profile_image=$request->file("profile_image");
            $path=$profile_image->store("public/profile_images");
            $user->profile_image=$path;
            $user->save();
            return response()->json([
                "success"=>true,
                "message"=>"User registered successfully",
                "data"=>$user
            ],201);
        }
    }
?>