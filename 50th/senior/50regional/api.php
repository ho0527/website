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
        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES(?,?,?,?)",[$data,"刪除面向",$time,""]);
        ?><script>alert("刪除成功!");location.href="project.php"</script><?php
    }
?>