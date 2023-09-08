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

        public function like(Request $request,$videoid){
            $userid=logincheck();
            if($userid){
                $userrow=DB::table("user")
                    ->where("id","=",$userid)
                    ->select("*")->get();
                if($userrow[0]->disabled=="false"){
                    if($request->has("like")){
                        if($request->input("like")){
                            $row=DB::table("video")
                                ->where("id","=",$videoid)
                                ->select("*")->get();
                            if($row->isNotEmpty()){
                                if($row[0]->visibility=="PUBLIC"||($row[0]->visibility=="PRIVATE"&&$row[0]->userid==$userid)){
                                    $likerow=DB::table("like")
                                        ->where("userid","=",$userid)
                                        ->where("videoid","=",$videoid)
                                        ->select("*")->get();
                                    if($likerow->isEmpty()){
                                        DB::table("like")->insert([
                                            "userid"=>$userid,
                                            "videoid"=>$videoid,
                                            "created_at"=>time()
                                        ]);
                                    }else{
                                        DB::table("like")
                                            ->where("userid","=",$userid)
                                            ->where("videoid","=",$videoid)
                                            ->delete();
                                    }
                                    return response()->json([
                                        "success"=>true,
                                        "message"=>"",
                                        "data"=>""
                                    ],200);
                                }else{
                                    return nopermission();
                                }
                            }else{
                                return videonotfound();
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

        public function comment(Request $request,$videoid){
            $userid=logincheck();
            if($userid){
                $userrow=DB::table("user")
                    ->where("id","=",$userid)
                    ->select("*")->get();
                if($userrow[0]->disabled=="false"){
                    if($request->has("text")){
                        $text=$request->input("text");
                        if(is_string($text)){
                            $row=DB::table("video")
                                ->where("id","=",$videoid)
                                ->select("*")->get();
                            if($row->isNotEmpty()){
                                if($row[0]->visibility=="PUBLIC"||($row[0]->visibility=="PRIVATE"&&$row[0]->userid==$userid)){
                                    DB::table("comment")->insert([
                                        "userid"=>$userid,
                                        "videoid"=>$videoid,
                                        "replyid"=>NULL,
                                        "text"=>$text,
                                        "created_at"=>time()
                                    ]);

                                    return response()->json([
                                        "success"=>true,
                                        "message"=>"",
                                        "data"=>1 // WTF
                                    ],200);
                                }else{
                                    return nopermission();
                                }
                            }else{
                                return videonotfound();
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

        public function getcomment(Request $request){
        }

        public function replycomment(Request $request,$commentid){
            $userid=logincheck();
            if($userid){
                $userrow=DB::table("user")
                    ->where("id","=",$userid)
                    ->select("*")->get();
                if($userrow[0]->disabled=="false"){
                    $commentrow=DB::table("comment")
                        ->where("id","=",$commentid)
                        ->select("*")->get();
                    if($commentrow->isNotEmpty()){
                        $videorow=DB::table("video")
                            ->where("id","=",$commentrow[0]->videoid)
                            ->select("*")->get()[0];
                        if($videorow->visibility=="PUBLIC"||($videorow[0]->visibility=="PRIVATE"&&$videorow[0]->userid==$userid)){
                            if($request->has("text")){
                                $text=$request->input("text");
                                if(is_string($text)){
                                    DB::table("comment")->insert([
                                        "userid"=>$userid,
                                        "videoid"=>$commentrow[0]->videoid,
                                        "replyid"=>$commentid,
                                        "text"=>$text,
                                        "created_at"=>time()
                                    ]);

                                    return response()->json([
                                        "success"=>true,
                                        "message"=>"",
                                        "data"=>1 // WTF
                                    ],200);
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
                        return commentnotfound();
                    }
                }else{
                    return userdisabled();
                }
            }else{
                return tokenerror();
            }
        }

        public function delcomment(Request $request,$commentid){
            $userid=logincheck();
            if($userid){
                $userrow=DB::table("user")
                    ->where("id","=",$userid)
                    ->select("*")->get();
                if($userrow[0]->disabled=="false"){
                    $commentrow=DB::table("comment")
                        ->where("id","=",$commentid)
                        ->select("*")->get();
                    if($commentrow->isNotEmpty()){
                        $videorow=DB::table("video")
                            ->where("id","=",$commentrow[0]->videoid)
                            ->select("*")->get()[0];
                        if($commentrow[0]->userid==$userid||$userid=="1"){
                            if($request->has("ban")){
                                if($userid=="1"){
                                    if($request->has("days")&&$request->has("reason")){
                                        $day=$request->input("days");
                                        $reason=$request->input("reason");
                                        if(is_int($day)&&is_string($reason)){
                                            delcomment($commentid);
                                            DB::table("blocklist")->insert([
                                                "userid"=>$commentrow[0]->userid,
                                                "from"=>time(),
                                                "to"=>time(), // +days
                                                "reason"=>$reason,
                                                "createdat"=>time()
                                            ]);
                                            return response()->json([
                                                "success"=>true,
                                                "message"=>"",
                                                "data"=>""
                                            ],200);
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
                                delcomment($commentid);
                                return response()->json([
                                    "success"=>true,
                                    "message"=>"",
                                    "data"=>""
                                ],200);
                            }
                        }else{
                            return nopermission();
                        }
                    }else{
                        return commentnotfound();
                    }
                }else{
                    return userdisabled();
                }
            }else{
                return tokenerror();
            }
        }

        public function getplaylist(Request $request){
            $userid=logincheck();
            if($userid){
                $data=[];

                $row=DB::table("playlist")
                    ->where("userid","=",$userid)
                    ->select("*")->get();

                for($i=0;$i<count($row);$i=$i+1){
                    $data[]=[
                        "id"=>$row[$i]->id,
                        "title"=>$row[$i]->title
                    ];
                }

                return response()->json([
                    "success"=>true,
                    "message"=>"",
                    "data"=>$data
                ],200);
            }else{
                return tokenerror();
            }
        }

        public function playlist(Request $request){
            $userid=logincheck();
            if($userid){
                $userrow=DB::table("user")
                    ->where("id","=",$userid)
                    ->select("*")->get();
                if($userrow[0]->disabled=="false"){
                    if($request->has("title")){
                        $title=$request->input("title");
                        if(is_string($title)){
                            $row=DB::table("playlist")
                                ->where("title","=",$title)
                                ->select("*")->get();
                            if($row->isEmpty()){
                                DB::table("playlist")->insert([
                                    "userid"=>$userid,
                                    "title"=>$title,
                                    "videolist"=>"",
                                    "createdat"=>time()
                                ]);

                                return response()->json([
                                    "success"=>true,
                                    "message"=>"",
                                    "data"=>1 // WTF
                                ],200);
                            }else{
                                return playlisterror();
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

        public function getidplaylist(Request $request){

        }

        public function addvideotoplaylist(Request $request,$playlistid){
            $userid=logincheck();
            if($userid){
                $userrow=DB::table("user")
                    ->where("id","=",$userid)
                    ->select("*")->get();
                if($userrow[0]->disabled=="false"){
                    if($request->has("video_id")){
                        $videoid=$request->input("video_id");
                        if(is_int($videoid)){
                            $videorow=DB::table("video")
                                ->where("id","=",$videoid)
                                ->select("*")->get();
                            if($videorow->isNotEmpty()){
                                $row=DB::table("playlist")
                                    ->where("id","=",$playlistid)
                                    ->select("*")->get();
                                if($row->isNotEmpty()){
                                    if(($videorow[0]->visibility=="PUBLIC"||($videorow[0]->visibility=="PRIVATE"&&$videorow[0]->userid==$userid))&&$row[0]->userid==$userid){
                                        $videolist=explode(" ",$row[0]->videolist);
                                        if(!in_array($videoid,$videolist)){
                                            $videolist[]=$videoid;
                                            DB::table("playlist")
                                                ->where("id","=",$playlistid)
                                                ->update([
                                                    "videolist"=>implode(" ",$videolist)
                                                ]);
        
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
                                    return playlistnotfound();
                                }
                            }else{
                                return videonotfound();
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

        public function sortplaylist(Request $request){

        }

        public function delvideoformplaylist(Request $request,$playlistid,$videoid){
            $userid=logincheck();
            if($userid){
                $userrow=DB::table("user")
                    ->where("id","=",$userid)
                    ->select("*")->get();
                if($userrow[0]->disabled=="false"){
                    $videorow=DB::table("video")
                        ->where("id","=",$videoid)
                        ->select("*")->get();
                    if($videorow->isNotEmpty()){
                        $row=DB::table("playlist")
                            ->where("id","=",$playlistid)
                            ->select("*")->get();
                        if($row->isNotEmpty()){
                            if(($videorow[0]->visibility=="PUBLIC"||($videorow[0]->visibility=="PRIVATE"&&$videorow[0]->userid==$userid))&&$row[0]->userid==$userid){
                                $videolist=explode(" ",$row[0]->videolist);
                                if(in_array($videoid,$videolist)){
                                    $key=array_search($videoid,$videolist);
                                    unset($videolist[$key]);
                                    DB::table("playlist")
                                        ->where("id","=",$playlistid)
                                        ->update([
                                            "videolist"=>implode(" ",$videolist)
                                        ]);

                                    return response()->json([
                                        "success"=>true,
                                        "message"=>"",
                                        "data"=>""
                                    ],200);
                                }else{
                                    return videonotinplaylist();
                                }
                            }else{
                                return nopermission();
                            }
                        }else{
                            return playlistnotfound();
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

        public function delplaylist(Request $request,$playlistid){
            $userid=logincheck();
            if($userid){
                $userrow=DB::table("user")
                    ->where("id","=",$userid)
                    ->select("*")->get();
                if($userrow[0]->disabled=="false"){
                    $row=DB::table("playlist")
                        ->where("id","=",$playlistid)
                        ->select("*")->get();
                    if($row->isNotEmpty()){
                        if($row[0]->userid==$userid){
                            DB::table("playlist")
                                ->where("id","=",$playlistid)
                                ->delete();

                            return response()->json([
                                "success"=>true,
                                "message"=>"",
                                "data"=>""
                            ],200);
                        }else{
                            return nopermission();
                        }
                    }else{
                        return playlistnotfound();
                    }
                }else{
                    return userdisabled();
                }
            }else{
                return tokenerror();
            }
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