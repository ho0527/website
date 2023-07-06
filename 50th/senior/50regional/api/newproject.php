<?php
    include("../link.php");
    $data=json_decode(file_get_contents("php://input"),true);
    $userdata=$_SESSION["data"];
    $projectname=$data[0];
    $projectdesciption=$data[1];
    $leader=$data[2];
    $member=implode("|&|",$data[3]);
    $facingname=implode("|&|",$data[4]);
    $facingdesciption=implode("|&|",$data[5]);
    query($db,"INSERT INTO `project`(`projectname`,`projectdesciption`,`leader`,`member`,`facingname`,`facingdesciption`)VALUES(?,?,?,?,?,?)",[$projectname,$projectdesciption,$leader,$member,$facingname,$facingdesciption]);
    query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES(?,?,?,?)",[$userdata,"新增面向",$time,""]);
?>