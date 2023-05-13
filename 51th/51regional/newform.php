<?php
    include("link.php");
    $userdata=$_SESSION["data"];
    $data=json_decode(file_get_contents("php://input"),true);
    print_r($data);
    $questionid=$_SESSION["id"];
    $jsondata=json_encode($data);
    query($db,"UPDATE `question` SET `log`='$jsondata',`updatetime`='$time' WHERE `id`='$questionid'");
    query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$userdata','儲存問卷成功','$time','qid=$questionid')");
?>