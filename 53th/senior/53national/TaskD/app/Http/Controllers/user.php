<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    include("error.php");
    include("fucntion.php");

    class user extends Controller{
        public function login(Request $request){
            if($request->has("email")&&$request->has("password")){
                $email=$request->input("email");
                $password=$request->input("password");
                if(is_string($email)&&is_string($password)){
                    $row=DB::table("users")
                        ->where(function($query)use($email){
                            $query->where("email","=",$email);
                        })->select("*")->get();
                    if($row->isNotEmpty()&&Hash::check($password,$row[0]->password)){ // TODO 如何驗證密碼
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
                            "data"=>user($row,"login")
                        ]);
                    }else{
                        return loginerror();
                    }
                }else{
                    return datatypeerror();
                }
            }else{
                return missingfield();
            }
        }

        public function register(Request $request){
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
                            $path=$image[0]->store("upload/image");
                            $imagedata=getimagesize(storage_path("app/".$path));
                            // $imagepath=$image->storePublicly("profile_image","public"); // todo 圖片上傳
                            DB::table("users")->insert([
                                "email"=>$email,
                                "password"=> Hash::make($password),
                                "nick_name"=>$nickname,
                                "profile_image"=>$path,
                                "type"=>"USER",
                                "created_at"=>time()
                            ]);
                            $row=DB::table("users")
                                ->where(function($query)use($email){
                                    $query->where("email","=",$email);
                                })->select("*")->get();
                            return response()->json([
                                "success"=>true,
                                "data"=>user($row,"normal")
                            ]);
                        }else{
                            return passworderror();
                        }
                    }else{
                        return datatypeerror();
                    }
                }else{
                    return userexist();
                }
            }else{
                return missingfield();
            }
        }

        public function logout(Request $request){
            $userid="";
            if(true){ // 如何比對?
                DB::table("users")
                    ->where("id","=",$userid)
                    ->update([
                        "access_token"=>NULL,
                    ]);
                unset($_SESSION["login"]);
                return response()->json([
                    "success"=>true
                ]);
            }else{
                return tokenerror();
            }
        }
    }
?>