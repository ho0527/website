<?php
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    include("error.php");
    include("function.php");

    class video extends Controller{
        public function uploadvideo(Request $request){
            $userid=logincheck();
            if($userid){
                $row=DB::table("users")
                    ->where("id","=",$userid)
                    ->select("*")->get();
                if(!$row[0]->disabled){
                    if($request->has("title")&&$request->has("description")&&$request->has("visibility")&&$request->has("category_id")&&$request->has("duration")&&$request->hasFile("video")){
                        $title=$request->input("title");
                        $description=$request->input("description");
                        $visibility=$request->input("visibility");
                        $categoryid=$request->input("category_id");
                        $duration=$request->input("duration");
                        $video=$request->file("video");
                        if(is_string($title)&&is_string($description)&&$visibility=="PUBLIC"||$visibility=="PREV"&&is_int($categoryid)&&is_int($duration)){
                            if(in_array($video->extension(),["mp4"])){
                                $path=$video->store("upload");
                                DB::table("video")->insert([
                                    "userid"=>$userid,
                                    "categoryid"=>$categoryid,
                                    "url"=>$path,
                                    "title"=>$title,
                                    "description"=>$description,
                                    "visibility"=>$visibility,
                                    "duration"=>$duration,
                                    "created_at"=>time()
                                ]);
                                $row=DB::table("video")
                                    ->latest()
                                    ->select("*")->get()[0];
                                return response()->json([
                                    "success"=>true,
                                    "message"=>"",
                                    "data"=>json([
                                        "id"=>$row->id,
                                        "url"=>url($path)
                                    ])
                                ],200);

                            }else{
                                return videoprocesserror();
                            }
                        }else{
                            return fileerror();
                        }
                    }else{
                        return missingfield();
                    }
                }else{
                    return userdisabled();
                }
            }else{
                return tokenerror();
            }
        }

        public function getvideo(Request $request){

        }

        public function gethotvideo(Request $request){

        }

        public function getpublicvideo(Request $request){

        }

        public function getidvideo(Request $request){

        }

        public function delvideo(Request $request){

        }

        public function like(Request $request){

        }

        public function comment(Request $request){

        }

        public function getcomment(Request $request){

        }

        public function replycomment(Request $request){

        }

        public function delcomment(Request $request){

        }

        public function getplaylist(Request $request){

        }

        public function playlist(Request $request){

        }

        public function getidplaylist(Request $request){

        }

        public function addvideotoplaylist(Request $request){

        }

        public function sortplaylist(Request $request){

        }

        public function delvideoformplaylist(Request $request){

        }

        public function delplaylist(Request $request){

        }

        public function getprogram(Request $request){

        }

        public function getidprogram(Request $request){

        }

        public function program(Request $request){

        }

        public function editprogram(Request $request){

        }

        public function addvideotoprogram(Request $request){

        }

        public function delvideoformprogram(Request $request){

        }

        public function delprogram(Request $request){

        }
    }
?>