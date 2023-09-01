<?php
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    include("error.php");
    include("function.php");

    class post extends Controller{
        public function getpost(Request $request){
            $orderby=$request->input("order_by");
            $ordertype=$request->input("order_type");
            $content=$request->input("content");
            $tag=$request->input("tag");
            $location=$request->input("location_name");
            $page=$request->input("page");
            $pagesize=$request->input("page_size");
            if(!($request->has("order_by"))){ $orderby="created_at"; }
            if(!($request->has("order_type"))){ $ordertype="desc"; }
            if(!($request->has("content"))){ $content=""; }
            if(!($request->has("tag"))){ $tag=""; }
            if(!($request->has("location_name"))){ $location=""; }
            if(!($request->has("page"))){ $page=1; }
            if(!($request->has("pagesize"))){ $pagesize=10; }
            if(($orderby=="created_at"||$orderby=="like_count")&&($ordertype=="asc"||$ordertype=="desc")&&(1<=$pagesize&&$pagesize<=100)){
                $row=DB::table("posts")
                    ->where("type","=","public")
                    ->where(function($query)use($content,$tag,$location){
                        $query->where("content","LIKE","%".$content."%")
                            ->where("tag","LIKE","%".$tag."%")
                            ->where("location","LIKE","%".$location."%");
                    })
                    ->orderBy($orderby,$ordertype)
                    ->skip(($page-1)*$pagesize)
                    ->take($pagesize)
                    ->select("*")->get();
                return response()->json([
                    "success"=>true,
                    "message"=>"",
                    "data"=>[
                        "total_count"=>$row->count(),
                        "posts"=>post($row)
                    ]
                ]);
            }else{
                return datatypeerror();
            }
        }

        public function getidpost(Request $request,$postid){
            $id=$request->route("post_id");
            $row=DB::table("posts")
                ->where(function($query)use($id){
                    $query->where("id","=",$id);
                })->select("*")->get();
            $userid=logincheck();
            if($row->isNotEmpty()){
                $follow=DB::table("user_follows")
                    ->where("user_id", "=", $row[0]->author_id)
                    ->where("follow_user_id", "=", $_SESSION["data"])
                    ->select("*")->get();
                if(($row[0]->type=="public")||(($follow->isNotEmpty()||$userid==$row[0]->author_id)&&$row[0]->type=="only_follow")||($userid==$row[0]->author_id&&$row[0]->type=="only_self")){
                    $commentrow=DB::table("comments")
                        ->where(function($query)use($id){
                            $query->where("post_id","=",$id);
                        })->select("*")->get();
                    return response()->json([
                        "success"=>true,
                        "message"=>"",
                        "data"=>[
                            "post"=>post($row),
                            "comments"=>comment($commentrow)
                        ]
                    ]);
                }else{
                    return nopermission();
                }
            }else{
                return posterror();
            }
        }

        public function post(Request $request){
            if($_SESSION["data"]!=""){
                if($request->has("type")&&$request->has("content")&&$request->hasFile("images")){
                    $type=$request->input("type");
                    $tag=$request->input("tags");
                    $content=$request->input("content");
                    $location=$request->input("location_name");
                    $image=$request->file("images");
                    if(!($request->has("tags"))){ $tag=""; }
                    if(!($request->has("location_name"))){ $location=""; }
                    if(is_string($type)&&is_string($tag)&&is_string($content)&&is_string($location)&&($type=="public"||$type=="only_follow"||$type=="only_self")){
                        $tagtemp=explode(" ",$tag);
                        DB::table("posts")->insert([
                            "author_id"=>$_SESSION["data"],
                            "content"=>$content,
                            "type"=>$type,
                            "tag"=>implode(" ",$tagtemp),
                            "location"=>$location,
                            // "place_lat"=>$_SESSION["data"],
                            // "place_lng"=>$_SESSION["data"],
                            "created_at"=>time(),
                        ]);
                        $row=DB::table("posts")
                            ->latest()
                            ->select("*")->get();
                        $id=$row[0]->id;
                        $row=DB::table("posts")
                            ->where(function($query)use($id){
                                $query->where("id","=",$id);
                            })
                            ->select("*")->get();
                        for($i=0;$i<count($image);$i=$i+1){
                            if(in_array($image[$i]->extension(),["png","jpg"])){
                                $path="http://localhost/website/52th/senior/52national/TaskD/storage/app/".$image[$i]->store("upload/image");
                                $imagedata=getimagesize(storage_path("app/".$path));
                                DB::table("post_images")->insert([
                                    "post_id"=>$id,
                                    "width"=>$imagedata[0],
                                    "height"=>$imagedata[1],
                                    "filename"=>$path,
                                    "created_at"=>time()
                                ]);
                            }else{
                                $row=DB::table("posts")
                                    ->where(function($query)use($id){
                                        $query->where("id","=",$id);
                                    })->delete();
                                $row=DB::table("post_images")
                                    ->where(function($query)use($id){
                                        $query->where("id","=",$id);
                                    })->delete();
                                return imageerror();
                            }
                        }
                        return response()->json([
                            "success"=>true,
                            "message"=>"",
                            "data"=>post($row)
                        ]);
                    }else{
                        return datatypeerror();
                    }
                }else{
                    return missingfield();
                }
            }else{
                return tokenerror();
            }
        }

        public function editpost(Request $request,$postid){
            if($_SESSION["data"]!=""){
                $id=$request->route("post_id");
                $row=DB::table("posts")
                    ->where(function($query)use($id){
                        $query->where("id","=",$id);
                    })->select("*")->get();
                if($row->isNotEmpty()){
                    if($row[0]->author_id==$_SESSION["data"]){
                        if($request->has("type")&&$request->has("content")){
                            $type=$request->input("type");
                            $tag=$request->input("tags");
                            $content=$request->input("content");
                            if(!($request->has("tags"))){ $tag=""; }
                            if(is_string($type)&&is_string($tag)&&is_string($content)&&($type=="public"||$type=="only_follow"||$type=="only_self")){
                                $tagtemp=explode(" ",$tag);
                                DB::table("posts")
                                    ->where("id","=",$id)
                                    ->update([
                                        "content"=>$content,
                                        "type"=>$type,
                                        "tag"=>implode(" ",$tagtemp),
                                        "updated_at"=>time(),
                                    ]);
                                $row=DB::table("posts")
                                    ->where(function($query)use($id){
                                        $query->where("id","=",$id);
                                    })
                                    ->select("*")->get();
                                return response()->json([
                                    "success"=>true,
                                    "message"=>"",
                                    "data"=>post($row)
                                ]);
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
                    return posterror();
                }
            }else{
                return tokenerror();
            }
        }

        public function delpost(Request $request,$postid){
            $userid=logincheck();
            if($userid){
                $id=$request->route("post_id");
                $row=DB::table("posts")
                    ->where(function($query)use($id){
                        $query->where("id","=",$id);
                    })->select("*")->get();
                if($row->isNotEmpty()){
                    if($row[0]->author_id==$userid){
                        $row=DB::table("posts")
                            ->where("id","=",$id)
                            ->delete();
                        return response()->json([
                            "success"=>true,
                            "message"=>"",
                            "data"=>""
                        ]);
                    }else{
                        return nopermission();
                    }
                }else{
                    return posterror();
                }
            }else{
                return tokenerror();
            }
        }

        public function favorite(Request $request,$postid){
            $userid=logincheck();
            if($userid){
                $id=$request->route("post_id");
                $row=DB::table("posts")
                    ->where(function($query)use($id){
                        $query->where("id","=",$id);
                    })->select("*")->get();
                if($row->isNotEmpty()){
                    if($row[0]->author_id!=$userid){
                        if($request->has("favorite")){
                            $type=$request->input("favorite");
                            if($type==true){
                                $row=DB::table("user_likes")
                                    ->where("post_id","=",$id)
                                    ->where("user_id","=",$userid)
                                    ->select("*")->get();
                                if($row->isEmpty()){
                                    $row=DB::table("user_likes")->insert([
                                        "user_id"=>$userid,
                                        "post_id"=>$id,
                                    ]);
                                }else{
                                    $row=DB::table("user_likes")
                                        ->where("post_id","=",$id)
                                        ->where("user_id","=",$userid)
                                        ->delete();
                                }
                                return response()->json([
                                    "success"=>true,
                                    "message"=>"",
                                    "data"=>""
                                ]);
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
                    return posterror();
                }
            }else{
                return tokenerror();
            }
        }

        public function getfavorite(Request $request){
            $userid=logincheck();
            if($userid!=""){
                $orderby=$request->input("order_by");
                $ordertype=$request->input("order_type");
                $page=$request->input("page");
                $pagesize=$request->input("page_size");
                if(!($request->has("order_by"))){ $orderby="created_at"; }
                if(!($request->has("order_type"))){ $ordertype="desc"; }
                if(!($request->has("page"))){ $page=1; }
                if(!($request->has("pagesize"))){ $pagesize=10; }
                if(($orderby=="created_at"||$orderby=="like_count")&&($ordertype=="asc"||$ordertype=="desc")&&(1<=$pagesize&&$pagesize<=100)){
                    $row=DB::table("user_likes")
                        ->where("id","=",$userid)
                        ->orderBy($orderby,$ordertype)
                        ->skip(($page-1)*$pagesize)
                        ->take($pagesize)
                        ->select("*")->get();
                    return response()->json([
                        "success"=>true,
                        "message"=>"",
                        "data"=>[
                            "posts"=>post($row)
                        ]
                    ]);
                }else{
                    return datatypeerror();
                }
            }else{
                return tokenerror();
            }
        }
        public function editfavorite(Request $request,$postid){
            if($_SESSION["data"]!=""){
                $id=$request->route("post_id");
                $userid=$_SESSION["data"];
                $row=DB::table("posts")
                    ->where(function($query)use($id){
                        $query->where("id","=",$id);
                    })->select("*")->get();
                if($row->isNotEmpty()){
                    if($row[0]->author_id!=$_SESSION["data"]){
                        if($request->has("content")){
                            $type=$request->input("content");
                            if($type==true){
                                $row=DB::table("user_likes")
                                    ->where("post_id","=",$id)
                                    ->where("user_id","=",$userid)
                                    ->select("*")->get();
                                if($row->isEmpty()){
                                    $row=DB::table("user_likes")->insert([
                                        "user_id"=>$userid,
                                        "post_id"=>$id,
                                    ]);
                                }else{
                                    $row=DB::table("user_likes")
                                        ->where("post_id","=",$id,"AND","user_id","=",$userid)
                                        ->delete();
                                }
                                return response()->json([
                                    "success"=>true,
                                    "message"=>"",
                                    "data"=>comment($row)
                                ]);
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
                    return posterror();
                }
            }else{
                return tokenerror();
            }
        }

        public function comment(Request $request,$postid,$commentid){
        }

        public function editcomment(Request $request,$postid,$commentid){
        }

        public function delcomment(Request $request,$postid,$commentid){
        }
    }
?>