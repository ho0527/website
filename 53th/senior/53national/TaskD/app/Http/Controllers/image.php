<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    date_default_timezone_set("Asia/Taipei");
    $time=date("Y-m-d\TH:i:s");

    $logincheck=function(){
        $row=DB::table("users")
            ->where(function($query){
                $query->whereNotNull("access_token");
            })->select("*")->get();
        if($row->isNotEmpty()){
            return $row[0]->id;
        }else{
            return NULL;
        }
    };

    $user=function($row,$type){
        $mainrow=[
            "id"=>$row[0]->id,
            "email"=>$row[0]->email,
            "nickname"=>$row[0]->nickname,
            "profile_image"=>$row[0]->profile_image,
            "type"=>$row[0]->type,
        ];
        if($type=="login"){
            $mainrow["access_token"]=$row[0]->access_token;
        }
        return $mainrow;
    };

    $image=function($row){
        $data=[];
        for($i=0;$i<count($row);$i=$i+1){
            if($row[$i]->delete_at=="NULL"){
                $mainrow=[
                    "id"=>$row[$i]->id,
                    "url"=>$row[$i]->url,
                    "title"=>$row[$i]->title,
                    "update_at"=>$row[$i]->update_at,
                    "created_at"=>$row[$i]->created_at
                ];
                $data[]=$mainrow;
            }
        }
        return $data;
    };

    $imagedetail=function($row)use($user){
        $data=[];
        for($i=0;$i<$row->count();$i=$i+1){
            if($row[$i]->delete_at=="NULL"){
                $userrow=DB::table("users")
                    ->where(function($query)use($row,$i){
                        $query->where("id","=",$row[$i]->user_id);
                    })->select("*")->get();
                $viewrow=DB::table("image_views")
                    ->where("image_id","=",$row[$i]->id)
                    ->select("*")->get();
                $commentrow=DB::table("comments")
                    ->where("image_id","=",$row[$i]->id)
                    ->select("*")->get();
                $mainrow=[
                    "id"=>$row[$i]->id,
                    "url"=>$row[$i]->url,
                    "author"=>$user($userrow,"normal"),
                    "title"=>$row[$i]->title,
                    "description"=>$row[$i]->description,
                    "width"=>$row[$i]->width,
                    "height"=>$row[$i]->height,
                    "mimetype"=>$row[$i]->mimetype,
                    "view_count"=>$viewrow->count(),
                    "comment_count"=>$commentrow->count(),
                    "update_at"=>$row[$i]->update_at,
                    "created_at"=>$row[$i]->created_at,
                ];
                $data[]=$mainrow;
            }
        }
        return $data;
    };

    $comment=function($row){
        $data=[];
        for($i=0;$i<count($row);$i=$i+1){
            $id=$row[$i]->id;
            $imagerow=DB::table("images")
                    ->where("id","=",$row[$i]->image_id)
                    ->select("*")->get()[0];
            $userrow=DB::table("users")
                ->where("id","=",$row[$i]->user_id)
                ->select("*")->get();
            $replycommentrow=DB::table("users")
                ->where("comment_id","=",$id)
                ->select("*")->get();
            if($imagerow->delete_at=="NULL"){
                $mainrow=[
                    "id"=>$row[$i]->id,
                    "user"=>$user($userrow),
                    "content"=>$row[$i]->content,
                    "comments"=>$comment($replycommentrow),
                    "created_at"=>$row[$i]->created_at
                ];
                $data[]=$mainrow;
            }
        }
        return $data;
    };

    $delcomment=function($id){
        $row=DB::table("comments")
            ->where("comment_id","=",$id)
            ->select("*")->get();
    
        DB::table("comments")
            ->where("id","=",$id)
            ->delete();
        for($i=0;$i<count($row);$i=$i+1){
            $delcomment($row[$i]->id);
        }
    };

    $loginerror=response()->json(["success"=>false,"message"=>"MSG_INVALID_LOGIN"],403);
    $userexist=response()->json(["success"=>false,"message"=>"MSG_USER_EXISTS"],409);
    $passworderror=response()->json(["success"=>false,"message"=>"MSG_PASSWORD_NOT_SECURE"],409);
    $tokenerror=response()->json(["success"=>false,"message"=>"MSG_INVALID_ACCESS_TOKEN"],401);
    $nopermission=response()->json(["success"=>false,"message"=>"MSG_PERMISSION_DENY"],403);
    $missingfield=response()->json(["success"=>false,"message"=>"MSG_MISSING_FIELD"],400);
    $datatypeerror=response()->json(["success"=>false,"message"=>"MSG_WROND_DATA_TYPE"],400);
    $imageerror=response()->json(["success"=>false,"message"=>"MSG_IMAGE_NOT_EXISTS"],404);
    $commenterror=response()->json(["success"=>false,"message"=>"MSG_COMMENT_NOT_EXISTS"],404);
    $usererror=response()->json(["success"=>false,"message"=>"MSG_USER_NOT_EXISTS"],404);
    $fileerror=response()->json(["success"=>false,"message"=>"MSG_INVALID_FILE_FORMAT"],400);

    class usercontroller extends Controller{
        public function search(Request $request){
            $orderby="create_at";
            $ordertype="desc";
            $keyword="";
            $page=1;
            $pagesize=10;
            if($request->has("order_by")){ $orderby=$request->input("order_by"); }
            if($request->has("order_type")){ $ordertype=$request->input("order_type"); }
            if($request->has("keyword")){ $keyword=$request->input("keyword"); }
            if($request->has("page")){ $page=$request->input("page"); }
            if($request->has("pagesize")){ $pagesize=$request->input("page_size"); }
            if(($orderby=="created_at"||$orderby=="like_count"||$orderby=="width"||$orderby=="height")&&($ordertype=="asc"||$ordertype=="desc")&&(1<=$pagesize&&$pagesize<=100)){
                $row=DB::table("posts")
                    ->where("type","=","public")
                    ->where(function($query)use($keyword){
                        $query->where("keyword","LIKE","%".$keyword."%");
                    })
                    ->orderBy($orderby,$ordertype)
                    ->skip(($page-1)*$pagesize)
                    ->take($pagesize)
                    ->select("*")->get();
                return response()->json([
                    "success"=>true,
                    "data"=>[
                        "total_count"=>count($row),
                        "posts"=>$image($row)
                    ]
                ]);
            }else{
                return $datatypeerror;
            }
        }

        public function popular(Request $request){
            $limit=10;
            if($request->has("limit")){ $limit=$request->input("limit"); };
            if(1<=$limit&&$limit<=100){
                $data=[];
                $maindata=[];
                $row=DB::table("image_views")
                    ->select("*")->get();

                for($i=0;$i<count($row);$i=$i+1){
                    $check=false;
                    for($j=0;$j<count($data);$j=$j+1){
                        if($data[$j][0]==$row[$i]->image_id){
                            $data[$j][1]=$data[$j][1]+1;
                            $check=true;
                        }
                    }
                    if(!$check){
                        $data=[$row[$j]->image_id,0];
                    }
                }

                usort($data,function($a,$b){
                    if($a[1]<$b[1]){ // !!!不確定是否相反!!!
                        return 1;
                    }else{
                        return 0;
                    }
                });

                for($i=0;$i<min(count($data),$limit);$i=$i+1){
                    $datarow=DB::table("images")
                        ->where("id","=",$data[$i][0])
                        ->select("*")->get();
                    
                    $maindata[]=[
                        "id"=>$row[$i][0],
                        "url"=>$data[$i]->url,
                        "title"=>$data[$i]->title,
                        "updated_at"=>$data[$i]->updated_at,
                        "created_at"=>$data[$i]->created_at
                    ];
                }

                return response()->json([
                    "success"=>true,
                    "data"=>$maindata
                ]);
            }else{
                return $datatypeerror;
            }
        }

        public function searchuserimage(Request $request,$userid){
            $row=DB::table("users")
                ->where("id","=",$userid)
                ->select("*")->get();
            if($row->isNotEmpty()){
                $row=DB::table("images")
                    ->where("user_id","=",$userid,"AND","deleted_at","=","NULL")
                    ->select("*")->get();
                return response()->json([
                    "success"=>true,
                    "data"=>$image($row)
                ]);
            }else{
                return $usererror;
            }
        }

        public function upload(Request $request){
            if(true){ // token check
                if($request->has("title")&&$request->has("description")&&$request->hasFile("image")){
                    $userid="";
                    $title=$request->input("title");
                    $description=$request->input("description");
                    $image=$request->file("image");
                    if(in_array($image[0]->extension(),["png","jpg"])){
                        $path=$image[0]->store("upload/image");
                        $imagedata=getimagesize(storage_path("app/".$path));
                        DB::table("images")->insert([
                            "url"=>$path,
                            "user_id"=>$userid,
                            "title"=>$title,
                            "description"=>$description,
                            "width"=>$imagedata[0],
                            "height"=>$imagedata[1],
                            "mimetype"=>$image[0]->extension(),
                            "created_at"=>$time
                        ]);
                        $row=DB::table("images")
                            ->latest()
                            ->select("*")->get();
                        return response()->json([
                            "success"=>true,
                            "data"=>$imagedetail($row,"login")
                        ],200);
                    }else{
                        return $fileerror;
                    }
                }else{
                    return $missingfield;
                }
            }else{
                return $tokenerror;
            }
        }

        public function updateimage(Request $request,$imageid){
            $row=DB::table("images")
                ->where("id","=",$imageid)
                ->select("*")->get()[0];
            $userid="";
            if($row->isNotEmpty()||$row->deleted_at=="NULL"){
                if(true){
                    $title=$row->title;
                    $description=$row->description;
                    if($request->has("title")){ $title=$request->input("title"); }
                    if($request->has("description")){ $description=$request->input("description"); }
    
                    if(is_string($title)&&is_string($description)){
                        DB::table("images")
                            ->where("id","=",$imageid)
                            ->update([
                                "title"=>$title,
                                "description"=>$description,
                                "update_at"=>$time,
                            ]);
                        $row=DB::table("images")
                            ->where("id","=",$imageid)
                            ->select("*")->get();
                        return response()->json([
                            "success"=>true,
                            "data"=>$imagedetail($row)
                        ],200);
                    }else{
                        return $datatypeerror;
                    }
                }else{
                    return $nopermission;
                }
            }else{
                return $imageerror;
            }
        }

        public function getimage(Request $request,$imageid){
            $row=DB::table("images")
                ->where("id","=",$imageid)
                ->select("*")->get()[0];
            $userid="";
            if($row->isNotEmpty()||$row->deleted_at=="NULL"){
                if($userid==""){ $userid="-1"; } // 如果沒有登入id=-1

                DB::table("image_views")->insert([
                    "user_id"=>$userid,
                    "image_id"=>$imageid,
                    "viewed_at"=>$time
                ]);

                return response()->json([
                    "success"=>true,
                    "data"=>$imagedetail($row)
                ],200);
            }else{
                return $imageerror;
            }
        }

        public function delimage(Request $request,$imageid){
            $row=DB::table("images")
                ->where("id","=",$imageid)
                ->select("*")->get()[0];
            $userid="";
            if($row->isNotEmpty()||$row->deleted_at=="NULL"){
                if(true){
                    DB::table("images")
                        ->where("id","=",$imageid)
                        ->update([
                            "deleted_at"=>$time
                        ]);

                    return response()->json([
                        "success"=>true,
                    ],200);
                }else{
                    return $nopermission;
                }
            }else{
                return $imageerror;
            }
        }

        public function getcomment(Request $request,$imageid){
            $row=DB::table("images")
                ->where("id","=",$imageid)
                ->select("*")->get()[0];
            $userid="";
            if($row->isNotEmpty()||$row->deleted_at=="NULL"){
                return response()->json([
                    "success"=>true,
                    "data"=>$comment($row)
                ],200);
            }else{
                return $imageerror;
            }
        }

        public function comment(Request $request,$imageid){
            $row=DB::table("images")
                ->where("id","=",$imageid)
                ->select("*")->get()[0];
            $userid=1;
            if($row->isNotEmpty()||$row->deleted_at=="NULL"){
                if(true){
                    if($request->has("content")){
                        $content=$request->input("content");
                        if(is_string($content)){
                            DB::table("comments")->insert([
                                "image_id"=>$imageid,
                                "user_id"=>$userid,
                                "content"=>$content,
                                "created_at"=>$time
                            ]);
        
                            $row=DB::table("comments")
                                ->latest()
                                ->select("*")->get();
                            return response()->json([
                                "success"=>true,
                                "data"=>$comment($row)
                            ],200);
                        }else{
                            return $datatypeerror;
                        }
                    }else{
                        return $missingfield;
                    }
                }else{
                    return $nopermission;
                }
            }else{
                return $imageerror;
            }
        }

        public function replycomment(Request $request,$imageid,$commentid){
            $row=DB::table("images")
                ->where("id","=",$imageid)
                ->select("*")->get()[0];
            $commentrow=DB::table("comments")
                ->where("id","=",$commentid)
                ->select("*")->get()[0];
            $userid=1;
            if($row->isNotEmpty()||$row->deleted_at=="NULL"){
                if($commentrow->isNotEmpty()||$commentrow->image_id==$imageid){
                    if(true){
                        if($request->has("content")){
                            $content=$request->input("content");
                            if(is_string($content)){
                                DB::table("comments")->insert([
                                    "image_id"=>$imageid,
                                    "user_id"=>$userid,
                                    "comment_id"=>$commentid,
                                    "content"=>$content,
                                    "created_at"=>$time
                                ]);
            
                                $row=DB::table("comments")
                                    ->latest()
                                    ->select("*")->get();
                                return response()->json([
                                    "success"=>true,
                                    "data"=>$comment($row)
                                ],200);
                            }else{
                                return $datatypeerror;
                            }
                        }else{
                            return $missingfield;
                        }
                    }else{
                        return $nopermission;
                    }
                }else{
                    return $commenterror;
                }
            }else{
                return $imageerror;
            }
        }

        public function delcomment(Request $request,$imageid,$commentid){
            $row=DB::table("images")
                ->where("id","=",$imageid)
                ->select("*")->get()[0];
            $commentrow=DB::table("comments")
                ->where("id","=",$commentid)
                ->select("*")->get()[0];
            $userid=1;
            if($row->isNotEmpty()||$row->deleted_at=="NULL"){
                if($commentrow->isNotEmpty()||$commentrow->image_id==$imageid){
                    if(true||$userid==1){
                        $delcomment($commentid);
                        return response()->json([
                            "success"=>true
                        ],200);
                    }else{
                        return $nopermission;
                    }
                }else{
                    return $commenterror;
                }
            }else{
                return $imageerror;
            }
        }

        public function popularuser(Request $request){
            $orderby="upload_count";
            $limit=10;
            if($request->has("order_by")){
                $orderby=$request->input("order_by");
            }
            if($request->has("limit")){
                $limit=$request->input("limit");
            }
            $data=[];
            $maindata=[];
            if(1<=$limit&&$limit<=100){
                if($orderby=="upload_count"){
                    $row=DB::table("images")
                        ->select("*")->get();
                }elseif($orderby=="total_view_count"){
                    $row=DB::table("image_views")
                        ->select("*")->get();
                }elseif($orderby=="total_comment_count"){
                    $row=DB::table("comments")
                        ->select("*")->get();
                }else{
                    return $datatypeerror;
                }

                for($i=0;$i<count($row);$i=$i+1){
                    $check=false;
                    for($j=0;$j<count($data);$j=$j+1){
                        if($data[$j][0]==$row[$i]->user_id){
                            $data[$j][1]=$data[$j][1]+1;
                            $check=true;
                        }
                    }
                    if(!$check){
                        $data=[$row[$j]->user_id,0];
                    }
                }

                usort($data,function($a,$b){
                    if($a[1]<$b[1]){ // !!!不確定是否相反!!!
                        return 1;
                    }else{
                        return 0;
                    }
                });

                for($i=0;$i<min(count($data),$limit);$i=$i+1){
                    $row=DB::table("users")
                        ->where("id","=",$data[$i][0])
                        ->select("*")->get();
                    $maindata[]=[
                        "user"=>$user($row),
                        "\"".$orderby."\""=>$data[$i][1]
                    ];
                }

                return response()->json([
                    "success"=>true,
                    "data"=>$maindata
                ]);
            }else{
                return $datatypeerror;
            }
        }
    }
?>