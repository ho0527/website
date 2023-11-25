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

    if(isset($_GET["delresponse"])){
        $row=query($db,"SELECT*FROM `response` WHERE `id`=?",[$_GET["id"]]);
        if($row){
            query($db,"DELETE FROM `response` WHERE `id`=?",[$_GET["id"]]);
            $questionrow=query($db,"SELECT*FROM `question` WHERE `id`=?",[$row[0][2]]);
            query($db,"UPDATE `question` SET `responcount`=? WHERE `id`=?",[(int)$questionrow[0][4]-1,$row[0][2]]);
            query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$data','刪除回應','$time','qid=$id')");
            ?><script>alert("刪除成功");location.href="responselist.html"</script><?php
        }else{
            ?><script>alert("查無回應");location.href="responselist.html"</script><?php
        }
    }
?>