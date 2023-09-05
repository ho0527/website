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
                $row=DB::table("users")
                    ->where("email","=",$email)
                    ->select("*")->get();
                if($row->isNotEmpty()&&$password==$row[0]->password){
                    DB::table("users")
                        ->where("id","=",$row[0]->id)
                        ->update([
                            "accesstoken"=>hash("sha256",$email),
                        ]);
                    $row=DB::table("users")
                        ->where("email","=",$email)
                        ->select("*")->get();
                    return response()->json([
                        "success"=>true,
                        "message"=>"",
                        "data"=>$row[0]->accesstoken
                    ]);
                }else{
                    return loginerror();
                }
            }else{
                return missingfield();
            }
        }

        public function logout(Request $request){
            $userid=logincheck();
            if(logincheck()){
                DB::table("users")
                    ->where("id","=",$userid)
                    ->update([
                        "access_token"=>NULL,
                    ]);
                unset($_SESSION["login"]);
                return response()->json([
                    "success"=>true,
                    "message"=>"",
                    "data"=>""
                ]);
            }else{
                return tokenerror();
            }
        }

        public function getuser(Request $request){

        }

        public function banuser(Request $request,$userid){

        }

        public function getblocklist(Request $request){

        }
    }
?>