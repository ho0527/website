<?php
    include("../link.php");
    $data=json_decode(file_get_contents("php://input"),true);
    $userdata=$_SESSION["data"];
    $id=$_SESSION["id"];
    $projectname=$data[0];
    $projectdesciption=$data[1];
    $leader=$data[2];
    $member=implode("|&|",$data[3]);
    $facingname=implode("|&|",$data[4]);
    $facingdesciption=implode("|&|",$data[5]);
    query($db,"UPDATE `project` SET `projectname`=?,`projectdesciption`=?,`leader`=?,`member`=?,`facingname`=?,`facingdesciption`=? WHERE `id`='$id'",[$projectname,$projectdesciption,$leader,$member,$facingname,$facingdesciption]);
    query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES(?,?,?,?)",[$userdata,"修改面向",$time,$id]);
?>