<?php
    include("link.php");
    $data=$_SESSION["data"];

    if(isset($_GET["logout"])){
        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$data','登出系統','$time','')");
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }

    if(isset($_GET["formdel"])){
        $id=$_GET["id"];
        query($db,"UPDATE `question` SET `ps`='del' WHERE `id`='$id'");
        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$data','刪除問卷','$time','qid=$id')");
        ?><script>location.href="admin.php"</script><?php
    }

    if(isset($_GET["cancel"])){
        unset($_SESSION["id"]);
        unset($_SESSION["count"]);
        ?><script>location.href="admin.php"</script><?php
    }

    if(isset($_GET["getresponselist"])){
        $row=query($db,"SELECT*FROM `response` WHERE `questionid`=?",[$_SESSION["id"]]);
        echo(json_encode([
            "success"=>true,
            "data"=>$row
        ]));
    }
?>