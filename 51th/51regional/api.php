<?php
    include("link.php");

    if(isset($_GET["logout"])){
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }

    if(isset($_GET["formdel"])){
        $id=$_GET["id"];
        query($db,"UPDATE `question` SET `ps`='del' WHERE `id`='$id'");
        ?><script>location.href="admin.php"</script><?php
    }
?>