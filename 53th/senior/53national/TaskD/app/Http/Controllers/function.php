<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    function time(){
        date_default_timezone_set("Asia/Taipei");
        return date("Y-m-d H:i:s");
    }

    function logincheck(){
        $row=DB::table("users")
            ->where("access_token","!=","NULL")
            ->select("*")->get();
        if($row->isNotEmpty()){
            return $row[0]->id;
        }else{
            return 0;
        }
    }

    function user($row,$type){
        $mainrow=[
            "id"=>$row[0]->id,
            "email"=>$row[0]->email,
            "nickname"=>$row[0]->nickname,
            "profile_image"=>"http://localhost/website/53th/senior/53national/TaskD/storage/app/".$row[0]->profile_image,
            "type"=>$row[0]->type,
            "created_at"=>implode("T",explode(" ",$row[0]->created_at))
        ];
        if($type=="login"){
            $mainrow["access_token"]=$row[0]->access_token;
        }
        return $mainrow;
    };

    function image($row){
        $data=[];
        for($i=0;$i<$row->count();$i=$i+1){
            $mainrow=[
                "id"=>$row[$i]->id,
                "url"=>"http://localhost/website/53th/senior/53national/TaskD/storage/app/".$row[$i]->url,
                "title"=>$row[$i]->title,
                "updated_at"=>$row[$i]->updated_at,
                "created_at"=>$row[$i]->created_at,
            ];
            $data[]=$mainrow;
        }
        return $data;
    };

    function imagedetail($row){
        $data=[];
        for($i=0;$i<count($row);$i=$i+1){
            $userrow=DB::table("users")
                ->where("id","=",$row[$i]->user_id)
                ->select("*")->get();
            $imageviewrow=DB::table("image_views")
                ->select("*")->get();
            $mainrow=[
                "id"=>$row[$i]->id,
                "url"=>"http://localhost/website/53th/senior/53national/TaskD/storage/app/".$row[$i]->url,
                "author"=>user($userrow,"normal"),
                "title"=>$row[$i]->title,
                "description"=>$row[$i]->description,
                "width"=>$row[$i]->width,
                "height"=>$row[$i]->height,
                "mimetype"=>$row[$i]->mimetype,
                "view_count"=>count($imageviewrow),
                "updated_at"=>implode("T",explode(" ",$row[$i]->updated_at)),
                "created_at"=>implode("T",explode(" ",$row[$i]->created_at))
            ];
            $data[]=$mainrow;
        }
        return $data;
    };


    function comment($row){
        $data=[];
        for($i=0;$i<count($row);$i=$i+1){
            $id=$row[$i]->id;
            $imagerow=DB::table("images")
                    ->where("id","=",$row[$i]->image_id)
                    ->select("*")->get()[0];
            $userrow=DB::table("users")
                ->where("id","=",$row[$i]->user_id)
                ->select("*")->get();
            $replycommentrow=DB::table("comments")
                ->where("comment_id","=",$id)
                ->select("*")->get();
            if($imagerow->deleted_at==NULL){
                $mainrow=[
                    "id"=>$row[$i]->id,
                    "user"=>user($userrow,"normal"),
                    "content"=>$row[$i]->content,
                    "comments"=>comment($replycommentrow),
                    "created_at"=>implode("T",explode(" ",$row[$i]->created_at))
                ];
                $data[]=$mainrow;
            }
        }
        return $data;
    };

    function delcomment($id){
        $row=DB::table("comments")
            ->where("comment_id","=",$id)
            ->select("*")->get();

        DB::table("comments")
            ->where("id","=",$id)
            ->delete();
        for($i=0;$i<count($row);$i=$i+1){
            delcomment($row[$i]->id);
        }
    };
?>