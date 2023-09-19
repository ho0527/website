<?php
    include("../link.php");
    if(isset($_POST["success"])){
        $data=json_decode($_POST["data"],true);
        for($i=0;$i<count($data);$i=$i+1){
            $id=$data[$i][0];
            $score=$data[$i][1];
            query($db,"UPDATE `score` SET `score`=? WHERE `id`=?",[$score,$id]);
        }
        echo(json_encode(["success"=>true]));
    }else{
        echo(json_encode(["success"=>false]));
    }
?>