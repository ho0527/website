<?php
    include("link.php");
    $data=$_SESSION["data"];

    if(isset($_GET["logout"])){
        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$data','登出系統','$time','')");
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }

    if(isset($_GET["projectdel"])){
        $id=$_SESSION["id"];
        $data=$_SESSION["data"];
        query($db,"DELETE FROM `project` WHERE `id`='$id'");
        query($db,"DELETE FROM `facing` WHERE `projectid`='$id'");
        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES(?,?,?,?)",[$data,"刪除面向",$time,""]);
        ?><script>alert("刪除成功!");location.href="project.php"</script><?php
    }

    if(isset($_GET["key"])){
        if($_GET["key"]=="canpostopinion"){
            if($_GET["value"]=="true"||$_GET["value"]=="false"){
                $id=$_GET["id"];
                $value=$_GET["value"];
                query($db,"UPDATE `project` SET `canpostopinion`='$value' WHERE `id`='$id'");
                query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES(?,?,?,?)",[$data,"停止或開啟發表意見功能",$time,"id=".$id]);
                ?><script>location.href="teamleader.php"</script><?php
            }
        }
    }
?>