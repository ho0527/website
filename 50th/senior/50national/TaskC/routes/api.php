<?php
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\DB;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    date_default_timezone_set("Asia/Taipei");
    $time=date("Y-m-d H:i:s");

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
            "id"=>$row->id,
            "email"=>$row->email,
            "nickname"=>$row->nickname,
            "profile_image"=>$row->profile_image,
            "type"=>$row->type,
        ];
        if($type=="login"){
            $mainrow["access_token"]=$row->access_token;
        }
        return $mainrow;
    };

    $image=function($row){
        $data=[];
        $id=$row->id;
        $imagerow=DB::table("post_images")
            ->where(function($query)use($id){
                $query->where("post_id","=",$id);
            })->select("*")->get();
        for($i=0;$i<$imagerow->count();$i=$i+1){
            $data[]=[
                "id"=>$imagerow[$i]->id,
                "url"=>$imagerow[$i]->filename,
                "width"=>$imagerow[$i]->width,
                "height"=>$imagerow[$i]->height,
                "created_at"=>$imagerow[$i]->created_at
            ];
        }
        return $data;
    };

    $post=function($row)use($user,$logincheck,$image){
        $data=[];
        for($i=0;$i<$row->count();$i=$i+1){
            $id=$row[$i]->id;
            $likerow=DB::table("user_likes")
                ->where(function($query)use($id){
                    $query->where("post_id","=",$id);
                })->select("*")->get();
            $userrow=DB::table("users")
                ->where(function($query)use($row,$i){
                    $query->where("id","=",$row[$i]->author_id);
                })->select("*")->get();
            if($row[$i]->location==""){ $location=NULL; }
            else{ $location=$row[$i]->location; }
            $mainrow=[
                "id"=>$row[$i]->id,
                "author"=>$user($userrow,"normal"),
                "image"=>$image($row[$i]),
                "like_count"=>$likerow->count(),
                "content"=>$row[$i]->content,
                "type"=>$row[$i]->type,
                "tag"=>explode(" ",$row[$i]->tag),
                "location_name"=>$location,
            ];
            if($logincheck()==NULL){
                $mainrow["updated_at"]=$row[$i]->updated_at;
                $mainrow["created_at"]=$row[$i]->created_at;
            }else{
                $likerow2=DB::table("user_likes")
                    ->where(function($query)use($id,$logincheck){
                        $query->where("post_id","=",$id)
                            ->where("user_id","=",$logincheck());
                    })->select("*")->get();
                if($likerow2->isNotEmpty()){
                    $mainrow["liked"]=true;
                }else{
                    $mainrow["liked"]=false;
                }
                $mainrow["updated_at"]=$row[$i]->updated_at;
                $mainrow["created_at"]=$row[$i]->created_at;
            }
            $data[]=$mainrow;
        }
        return $data;
    };

    $comment=function($row)use($user){
        $data=[];
        $id=$row->id;
        $commentrow=DB::table("comments")
            ->where(function($query)use($id){
                $query->where("post_id","=",$id);
            })->select("*")->get();
        for($i=0;$i<$commentrow->count();$i=$i+1){
            $data[]=[
                "id"=>$commentrow[$i]->id,
                "user"=>$user($commentrow[$i],"normal"),
                "context"=>$commentrow[$i]->context,
                "created_at"=>$commentrow[$i]->created_at
            ];
        }
        return $data;
    };

    $loginerror=response()->json(["success"=>false,"message"=>"MSG_INVALID_LOGIN","data"=>""],403);
    $tokenerror=response()->json(["success"=>false,"message"=>"MSG_INVALID_TOKEN","data"=>""],401);
    $userdisabled=response()->json(["success"=>false,"message"=>"MSG_USER_DISABLED","data"=>""],403);
    $nopermission=response()->json(["success"=>false,"message"=>"MSG_PERMISSION_DENY","data"=>""],403);
    $missingfield=response()->json(["success"=>false,"message"=>"MSG_MISSING_FIELD","data"=>""],400);
    $datatypeerror=response()->json(["success"=>false,"message"=>"MSG_WRONG_DATA_TYPE","data"=>""],400);
    $videoprocesserror=response()->json(["success"=>false,"message"=>"MSG_VIDEO_CAN_NOT_PROCESS","data"=>""],400);
    $videolengtherror=response()->json(["success"=>false,"message"=>"MSG_WRONG_VIDEOS_LENGTH","data"=>""],400);
    $covererror=response()->json(["success"=>false,"message"=>"MSG_COVER_CAN_NOT_PROCESS","data"=>""],400);
    $categorynotfound=response()->json(["success"=>false,"message"=>"MSG_CATEGORY_NOT_EXISTS","data"=>""],404);
    $videonotfound=response()->json(["success"=>false,"message"=>"MSG_VIDEO_NOT_EXISTS","data"=>""],404);
    $commentnotfound=response()->json(["success"=>false,"message"=>"MSG_COMMENT_NOT_EXISTS","data"=>""],404);
    $playlistnotfound=response()->json(["success"=>false,"message"=>"MSG_PLAYLIST_NOT_EXISTS","data"=>""],404);
    $videonotinplaylist=response()->json(["success"=>false,"message"=>"MSG_VIDEO_NOT_IN_PLAYLIST","data"=>""],404);
    $programnotfound=response()->json(["success"=>false,"message"=>"MSG_PROGRAM_NOT_EXISTS","data"=>""],404);
    $usernotfound=response()->json(["success"=>false,"message"=>"MSG_USER_NOT_EXISTS","data"=>""],404);
    $videonotinprogram=response()->json(["success"=>false,"message"=>"MSG_VIDEO_NOT_IN_PROGRAM","data"=>""],404);
    $videoinplaylist=response()->json(["success"=>false,"message"=>"MSG_VIDEO_ALREADY_IN_PLAYLIST","data"=>""],409);
    $videoinprogram=response()->json(["success"=>false,"message"=>"MSG_VIDEO_ALREADY_IN_PROGRAM","data"=>""],409);
    $playlisterror=response()->json(["success"=>false,"message"=>"MSG_DUPLICATED_PLAYLIST","data"=>""],409);
    $programerror=response()->json(["success"=>false,"message"=>"MSG_DUPLICATED_PROGRAM","data"=>""],409);
    $videonopermission=response()->json(["success"=>false,"message"=>"MSG_VIDEO_NOT_PUBLIC","data"=>""],409);

    Route::POST("/v1/login",function(Request $request)use($loginerror,$missingfield,$datatypeerror,$user,$logincheck){
        if($logincheck()==NULL){
            if($request->has("email")&&$request->has("password")){
                $email=$request->input("email");
                $password=$request->input("password");
                $row=DB::table("users")
                    ->where(function($query)use($email){
                        $query->where("email","=",$email);
                    })->select("*")->get();
                if($row->isNotEmpty()&&$row[0]->password==$password){
                    if(is_string($email)&&is_string($password)){
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
                            "message"=>"",
                            "data"=>$user($row[0],"login")
                        ]);
                    }else{
                        return $datatypeerror;
                    }
                }else{
                    return $loginerror;
                }
            }else{
                return $missingfield;
            }
        }else{
            return "alredlogin";
        }
    });

    Route::POST("/v1/logout",function(Request $request)use($tokenerror,$logincheck){
        if($logincheck()!=NULL){
            $row=DB::table("users")
                ->where("id","=",$logincheck())
                ->update([
                    "access_token"=>NULL,
                ]);
            return response()->json([
                "success"=>true,
                "message"=>"",
                "data"=>""
            ]);
        }else{
            return $tokenerror;
        }
    });

    Route::POST("/v1/video",function(Request $request)use($tokenerror){
        return;
    });

    Route::GET("/v1/video",function(Request $request)use($tokenerror){
        return;
    });

    Route::GET("/v1/video/hot",function(Request $request)use($tokenerror){
        return;
    });

    Route::GET("/v1/video/public/?q={keyword}&page={page}",function(Request $request)use($tokenerror){
        return;
    });

    Route::GET("api/v1/video/{video_id}",function(Request $request)use($tokenerror){
        return;
    });

    Route::DELETE("api/v1/video/{video_id}",function(Request $request)use($tokenerror){
        return;
    });

    Route::PUT("api/v1/video/{video_id}/like",function(Request $request)use($tokenerror){
        return;
    });

    Route::POST("api/v1/video/{video_id}/comment",function(Request $request)use($tokenerror){
        return;
    });

    Route::GET("api/v1/video/{video_id}/comment?page={page}",function(Request $request)use($tokenerror){
        return;
    });

    Route::POST("api/v1/comment/{comment_id}/reply",function(Request $request)use($tokenerror){
        return;
    });

    Route::DELETE("api/v1/comment/{comment_id}",function(Request $request)use($tokenerror){
        return;
    });

    Route::GET("api/v1/playlist",function(Request $request)use($tokenerror){
        return;
    });

    Route::POST("api/v1/playlist",function(Request $request)use($tokenerror){
        return;
    });

    Route::GET("api/v1/playlist/{playlist_id}",function(Request $request)use($tokenerror){
        return;
    });

    Route::POST("api/v1/playlist/{playlist_id}/video",function(Request $request)use($tokenerror){
        return;
    });

    Route::PUT("api/v1/playlist/{playlist_id}/order",function(Request $request)use($tokenerror){
        return;
    });

    Route::DELETE("api/v1/playlist/{playlist_id}/video/{video_id}",function(Request $request)use($tokenerror){
        return;
    });

    Route::DELETE("api/v1/playlist/{playlist_id}",function(Request $request)use($tokenerror){
        return;
    });

    Route::GET("api/v1/program?q={keywords}&page={page}",function(Request $request)use($tokenerror){
        return;
    });

    Route::GET("api/v1/program/{program_id}",function(Request $request)use($tokenerror){
        return;
    });

    Route::GET("api/v1/user",function(Request $request)use($tokenerror){
        return;
    });

    Route::PUT("api/v1/user/{user_id}/ban",function(Request $request)use($tokenerror){
        return;
    });

    Route::POST("api/v1/program",function(Request $request)use($tokenerror){
        return;
    });

    Route::PUT("api/v1/program/{program_id}",function(Request $request)use($tokenerror){
        return;
    });

    Route::POST("api/v1/program/{program_id}/video",function(Request $request)use($tokenerror){
        return;
    });

    Route::DELETE("api/v1/program/{program_id}/video/{video_id}",function(Request $request)use($tokenerror){
        return;
    });

    Route::DELETE("api/v1/program/{program_id}",function(Request $request)use($tokenerror){
        return;
    });

    Route::GET("api/v1/blacklist",function(Request $request)use($tokenerror){
        return;
    });
?>