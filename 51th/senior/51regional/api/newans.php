<?php
    include("link.php");
    $userdata=$_SESSION["data"];
    $data=json_decode(file_get_contents("php://input"),true);
    $maindata=$data[0];
    $jsondata=json_encode($data[1]);
    query($db,"INSERT INTO `respond`()VALUES()",[$maindata[1],$maindata[2],$maindata[3],$maindata[4],$jsondata]);
    query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$userdata','新增意見成功','$time','qid=$maindata[0]')");
?>