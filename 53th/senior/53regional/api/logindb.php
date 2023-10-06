<?php
    include("../link.php");
    $key=$_GET["key"];
    $number=$_GET["number"];
    if($key=="success"){
        $row=query($db,"SELECT*FROM `user` WHERE `number`='$number'")[0];
        query($db,"INSERT INTO `data`(`number`,`username`,`password`,`name`,`permission`,`move1`,`move2`,`movetime`)VALUES(?,?,?,?,?,'登入','成功','$time')",[$row[4],$row[1],$row[2],$row[3],$row[5]]);
    }else{
        if($number=="未知"){
            query($db,"INSERT INTO `data`(`number`,`username`,`password`,`name`,`permission`,`move1`,`move2`,`movetime`)VALUES('N/A','','','','','登入','失敗','$time')");
        }else{
            $row=query($db,"SELECT*FROM `user` WHERE `number`='$number'")[0];
            query($db,"INSERT INTO `data`(`number`,`username`,`password`,`name`,`permission`,`move1`,`move2`,`movetime`)VALUES(?,?,?,?,?,'登入','成功','$time')",[$row[4],$row[1],$row[2],$row[3],$row[5]]);
        }
    }

    echo(json_encode([
        "success"=>true,
        "data"=>""
    ]));
?>