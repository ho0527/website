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
                $row=DB::table("user")
                    ->where("email","=",$email)
                    ->select("*")->get();
                if($row->isNotEmpty()&&$password==$row[0]->password){
                    DB::table("user")
                        ->where("id","=",$row[0]->id)
                        ->update([
                            "accesstoken"=>hash("sha256",$email),
                        ]);
                    $row=DB::table("user")
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
                DB::table("user")
                    ->where("id","=",$userid)
                    ->update([
                        "accesstoken"=>NULL,
                    ]);
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
            $userid=logincheck();
            if($userid){
                if($userid=="1"){
                    $data=[];
                    $row=DB::table("user")
                        ->select("*")->get();
                    for($i=0;$i<count($row);$i=$i+1){
                        $enabled=true;
                        if($row[$i]->disabled=="true"){
                            $enabled=false;
                        }
                        $data[]=[
                            "id"=>$row[$i]->id,
                            "email"=>$row[$i]->email,
                            "nickname"=>$row[$i]->nickname,
                            "enabled"=>$enabled,
                            "user_type"=>$row[$i]->permission,
                            "created_at"=>$row[$i]->createdat,
                            "updated_at"=>$row[$i]->createdat,
                        ];
                    }
                    return response()->json([
                        "success"=>true,
                        "message"=>"",
                        "data"=>$data
                    ]);
                }else{
                    return nopermission();
                }
            }else{
                return tokenerror();
            }
        }

        public function banuser(Request $request,$userid){
            $loginuserid=logincheck();
            if($loginuserid){
                if($loginuserid=="1"){
                    if($request->has("ban")){
                        if($request->input("ban")){
                            $row=DB::table("user")
                                ->where("id","=",$userid)
                                ->select("*")->get();
                            if($row->isNotEmpty()){
                                if($row[0]->disabled=="false"){
                                    DB::table("user")
                                        ->where("id","=",$userid)
                                        ->update([
                                            "disabled"=>"true",
                                        ]);
                                }else{
                                    DB::table("user")
                                        ->where("id","=",$userid)
                                        ->update([
                                            "disabled"=>"false",
                                        ]);
                                }
                                return response()->json([
                                    "success"=>true,
                                    "message"=>"",
                                    "data"=>""
                                ]);
                            }else{
                                return usernotfound();
                            }
                        }else{
                            return datatypeerror();
                        }
                    }else{
                        return missingfield();
                    }
                }else{
                    return nopermission();
                }
            }else{
                return tokenerror();
            }
        }

        public function getblocklist(Request $request){

        }
    }
?>