<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    function time(){
        date_default_timezone_set("Asia/Taipei");
        return date("Y-m-d\TH:i:s");
    }

    function user($row,$type){
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

    function image($row){
        $data=[];
        for($i=0;$i<$row->count();$i=$i+1){
            $mainrow=[
                "id"=>$row[$i]->id,
                "url"=>$row[$i]->url,
                "title"=>$row[$i]->title,
                "created_at"=>$row[$i]->created_at,
            ];
            $data[]=$mainrow;
        }
        return $data;
    };

    function imagedetail($row){
        $data=[];
        for($i=0;$i<$row->count();$i=$i+1){
            $userrow=DB::table("users")
                ->where(function($query)use($row,$i){
                    $query->where("id","=",$row[$i]->author_id);
                })->select("*")->get();
            $mainrow=[
                "id"=>$row[$i]->id,
                "url"=>$row[$i]->url,
                "author"=>user($userrow,"normal"),
                "title"=>$row[$i]->title,
                "description"=>$row[$i]->description,
                "width"=>$row[$i]->width,
                "height"=>$row[$i]->height,
                "mimetype"=>$row[$i]->mimetype,
                "view_count"=>$row[$i]->view_count,
                "update_at"=>$row[$i]->update_at,
                "created_at"=>$row[$i]->created_at,
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
            $replycommentrow=DB::table("users")
                ->where("comment_id","=",$id)
                ->select("*")->get();
            if($imagerow->delete_at=="NULL"){
                $mainrow=[
                    "id"=>$row[$i]->id,
                    "user"=>user($userrow,"normal"),
                    "content"=>$row[$i]->content,
                    "comments"=>comment($replycommentrow),
                    "created_at"=>$row[$i]->created_at
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