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
                $row=DB::table("user")
                    ->where("id","=",$userid)
                    ->select("*")->get();
                if($row[0]->disabled=="false"){
                    if($request->has("title")&&$request->has("description")&&$request->has("visibility")&&$request->has("category_id")&&$request->has("duration")&&$request->hasFile("video")){
                        $title=$request->input("title");
                        $description=$request->input("description");
                        $visibility=$request->input("visibility");
                        $categoryid=$request->input("category_id");
                        $duration=$request->input("duration");
                        $video=$request->file("video");
                        if(is_string($title)&&is_string($description)&&($visibility=="PUBLIC"||$visibility=="PRIVATE")&&is_numeric($categoryid)&&is_numeric($duration)){
                            if(in_array($video->extension(),["mp4"])){
                                $row=DB::table("category")
                                    ->where("id","=",$categoryid)
                                    ->select("*")->get();
                                if($row->isNotEmpty()){
                                    $path=$video->store("upload");
                                    DB::table("video")->insert([
                                        "userid"=>$userid,
                                        "categoryid"=>$categoryid,
                                        "url"=>$path,
                                        "title"=>$title,
                                        "description"=>$description,
                                        "visibility"=>$visibility,
                                        "duration"=>$duration,
                                        "count"=>0,
                                        "created_at"=>time()
                                    ]);
                                    $row=DB::table("video")
                                        ->latest()
                                        ->select("*")->get()[0];
                                    return response()->json([
                                        "success"=>true,
                                        "message"=>"",
                                        "data"=>[
                                            "id"=>$row->id,
                                            "url"=>url($path)
                                        ]
                                    ],200);
                                }else{
                                    return categorynotfound();
                                }
                            }else{
                                return videoprocesserror();
                            }
                        }else{
                            return datatypeerror();
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
            $row=DB::table("video")
                ->select("*")->get();

            $categoryrow=DB::table("category")
                ->select("*")->get();

            $data=[];

            for($i=0;$i<count($row);$i=$i+1){
                $data[]=[
                    "id"=>$row[$i]->id,
                    "title"=>$row[$i]->title,
                    "description"=>$row[$i]->description,
                    "duration"=>$row[$i]->duration,
                    "visibility"=>$row[$i]->visibility,
                    "created_at"=>$row[$i]->created_at,
                    "categoryid"=>$categoryrow[$row[$i]->categoryid]->title,
                ];
            }

            return response()->json([
                "success"=>true,
                "message"=>"",
                "data"=>$data
            ],200);
        }

        public function gethotvideo(Request $request){

        }

        public function getpublicvideo(Request $request){
            $keyword="";
            $page="1";
            if($request->has("q")){ $keyword=$request->input("q"); }
            if($request->has("page")){ $page=$request->input("page"); }

            $row=DB::table("video")
                ->where("visibility","=","PUBLIC")
                ->where("title","LIKE","%$keyword%")
                ->where("description","LIKE","%$keyword%")
                ->skip(($page-1)*10)
                ->take(10)
                ->select("*")->get();

            $categoryrow=DB::table("category")
                ->select("*")->get();

            $data=[];

            for($i=0;$i<count($row);$i=$i+1){
                $data[]=[
                    "id"=>$row[$i]->id,
                    "title"=>$row[$i]->title,
                    "description"=>$row[$i]->description,
                    "duration"=>$row[$i]->duration,
                    "visibility"=>$row[$i]->visibility,
                    "created_at"=>$row[$i]->created_at,
                    "category"=>$categoryrow[$row[$i]->categoryid]->title,
                ];
            }

            return response()->json([
                "success"=>true,
                "message"=>"",
                "data"=>$data
            ],200);
        }

        public function getidvideo(Request $request,$videoid){
            $userid=logincheck();
            if($userid){
                $row=DB::table("video")
                    ->where("id","=",$videoid)
                    ->select("*")->get();

                $userrow=DB::table("user")
                    ->where("id","=",$userid)
                    ->select("*")->get()[0];
                if($userrow->disabled=="false"){
                    if($row->isNotEmpty()){
                        if($row[0]->userid==$userid){
                            $categoryrow=DB::table("category")
                                ->where("id","=",$row[0]->categoryid)
                                ->select("*")->get();
                            $row=DB::table("video")
                                ->latest()
                                ->select("*")->get()[0];
                            return response()->json([
                                "success"=>true,
                                "message"=>"",
                                "data"=>[
                                    "id"=>$row->id,
                                    "title"=>$row[0]->title,
                                    "description"=>$row[0]->description,
                                    "visibility"=>$row[0]->visibility,
                                    "duration"=>$row[0]->duration,
                                    "created_at"=>$row[0]->created_at,
                                    "category"=>$categoryrow[$row[0]->categoryid]->title,
                                    "user"=>$userrow->nickname,
                                    "url"=>url($row[0]->url),

                                    // 未製作
                                    "like"=>0,
                                    "liked"=>false,
                                    "playlist_ids"=>[],
                                    "program_ids"=>[],
                                ]
                            ],200);
                        }else{
                            return nopermission();
                        }
                    }else{
                        return videonotfound();
                    }
                }else{
                    return userdisabled();
                }
            }else{
                return tokenerror();
            }
        }

        public function delvideo(Request $request,$videoid){
            $userid=logincheck();
            if($userid){
                $row=DB::table("video")
                    ->where("id","=",$videoid)
                    ->select("*")->get();

                $userrow=DB::table("user")
                    ->where("id","=",$userid)
                    ->select("*")->get()[0];
                if($userrow->disabled=="false"){
                    if($row->isNotEmpty()){
                        if($row[0]->userid==$userid){
                            $isinplaylist=false; // 未製作
                            if(!$isinplaylist){
                                $row=DB::table("video")
                                    ->where("id","=",$videoid)
                                    ->delete();
                                return response()->json([
                                    "success"=>true,
                                    "message"=>"",
                                    "data"=>""
                                ],200);
                            }else{
                                return videoinplaylist();
                            }
                        }else{
                            return nopermission();
                        }
                    }else{
                        return videonotfound();
                    }
                }else{
                    return userdisabled();
                }
            }else{
                return tokenerror();
            }
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