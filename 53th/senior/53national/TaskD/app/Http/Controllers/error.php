<?php
    function loginerror(){
        return response()->json(["success"=>false,"message"=>"MSG_INVALID_LOGIN"],403);
    }

    function userexist(){
        return response()->json(["success"=>false,"message"=>"MSG_USER_EXISTS"],409);
    }

    function passworderror(){
        return response()->json(["success"=>false,"message"=>"MSG_PASSWORD_NOT_SECURE"],409);
    }

    function tokenerror(){
        return response()->json(["success"=>false,"message"=>"MSG_INVALID_ACCESS_TOKEN"],401);
    }

    function nopermission(){
        return response()->json(["success"=>false,"message"=>"MSG_PERMISSION_DENY"],403);
    }

    function missingfield(){
        return response()->json(["success"=>false,"message"=>"MSG_MISSING_FIELD"],400);
    }

    function datatypeerror(){
        return response()->json(["success"=>false,"message"=>"MSG_WROND_DATA_TYPE"],400);
    }

    function imageerror(){
        return response()->json(["success"=>false,"message"=>"MSG_IMAGE_NOT_EXISTS"],404);
    }

    function commenterror(){
        return response()->json(["success"=>false,"message"=>"MSG_COMMENT_NOT_EXISTS"],404);
    }

    function usererror(){
        return response()->json(["success"=>false,"message"=>"MSG_USER_NOT_EXISTS"],404);
    }

    function fileerror(){
        return response()->json(["success"=>false,"message"=>"MSG_INVALID_FILE_FORMAT"],400);
    }
?>