<?php
    include("link.php");
    $userdata=$_SESSION["data"];
    $data=json_decode(file_get_contents("php://input"),true);
    $maindata=$data[0];
    unset($data[0]);
    $datanew=array_values($data);
    $jsondata=json_encode($datanew);
    query($db,"UPDATE `question` SET `title`=?,`questioncount`=?,`pagelen`=?,`maxlen`=?,`log`=?,`updatetime`='$time' WHERE `id`='$maindata[0]'",[$maindata[1],$maindata[2],$maindata[3],$maindata[4],$jsondata]);
    query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$userdata','儲存問卷成功','$time','qid=$maindata[0]')");
?>