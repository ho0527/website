<?php
    include("link.php");
    if(isset($_GET["logout"])){
        if(isset($_SESSION["data"])){
            ?><script>alert("登出成功!");location.href="index.html"</script><?php
            session_unset();
        }else{
            ?><script>alert("請先登入!");location.href="index.html"</script><?php
        }
    }

    if(isset($_GET["logincheck"])){
        if(isset($_SESSION["data"])){
            echo("true");
        }else{
            echo("false");
        }
    }

    if(isset($_GET["traintypelist"])){
        $row=query($db,"SELECT*FROM `type`");
        echo(json_encode($row));
    }

    if(isset($_GET["key"])){
        if($_GET["key"]=="deltraintype"){
            $id=$_GET["id"];
            $row=query($db,"DELETE FROM `type` WHERE `id`=?",[$id]);
            ?><script>alert("刪除成功!");location.href="admintype.html"</script><?php
        }
    }
?>