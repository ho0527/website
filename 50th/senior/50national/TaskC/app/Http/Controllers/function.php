<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    session_start();

    function time(){
        date_default_timezone_set("Asia/Taipei");
        return date("Y-m-d H:i:s");
    }

    function logincheck(){
        $row=DB::table("user")
            ->where("accesstoken","!=","NULL")
            ->select("*")->get();
        if($row->isNotEmpty()){
            return $row[0]->id;
        }else{
            return 0;
        }
    }
?>