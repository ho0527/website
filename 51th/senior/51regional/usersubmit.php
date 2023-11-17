<?php
    include("link.php");
    $userdata=$_SESSION["data"];
    query($db,"INSERT INTO `question`(`userid`,`questionid`,`respond`)VALUES(?,?,?)",[$_POST["userid"],$_POST["questionid"],$_POST["respond"]]);
    query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES(?,?,?,?)",[$userdata,"回應問卷成功",$time,"qid=".$maindata[0]]);
    echo(json_encode([
        "success"=>true,
        "data"=>""
    ]));
?>