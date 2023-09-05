<?php
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    include("error.php");
    include("function.php");

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
                    if($row->isNotEmpty()&&Hash::check($password,$row[0]->password)){
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
                $row=DB::table("users")
                    ->where(function($query)use($email){
                        $query->where("email","=",$email);
                    })->select("*")->get();
                if($row->isEmpty()){
                    if(filter_var($email,FILTER_VALIDATE_EMAIL)&&is_string($email)&&is_string($nickname)&&is_string($password)&&in_array($image->extension(),["png","jpg"])){
                        if(4<=strlen($password)){
                            $path=$image->store("image");
                            DB::table("users")->insert([
                                "email"=>$email,
                                "password"=> Hash::make($password),
                                "nickname"=>$nickname,
                                "profile_image"=>$path,
                                "type"=>"USER",
                                "created_at"=>time()
                            ]);
                            $row=DB::table("users")
                                ->latest()
                                ->select("*")->get();
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
            // 可以使用TOKEM的方式拿到TOKEN之後再比對
            $userid=logincheck();
            if(logincheck()){
                DB::table("users")
                    ->where("id","=",$userid)
                    ->update([
                        "access_token"=>NULL,
                    ]);
                return response()->json([
                    "success"=>true
                ]);
            }else{
                return tokenerror();
            }
        }
    }
?>