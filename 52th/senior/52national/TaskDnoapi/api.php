<?php
    include("link.php");

    if($_GET["key"]=="postsave"){
        if(isset($_SESSION["data"])){
            $data=$_SESSION["data"];
            $postid=$_GET["id"];
            $row=query($db,"SELECT*FROM `post` WHERE `id`='$postid'")[0];
            if($data!=$row[1]){
                if(!query($db,"SELECT*FROM `postfollow` WHERE `postid`='$postid'AND`user`='$data'")){
                    query($db,"INSERT INTO `postfollow`(`postid`,`user`,`time`)VALUES('$postid','$data','$time')");
                }else{
                    query($db,"DELETE FROM `postfollow` WHERE `postid`='$postid'AND`user`='$data'");
                }
                query($db,"INSERT INTO `log`(`number`,`move`,`time`)VALUES('$data','收藏/取消收藏貼文','$time')");
                ?><script>location.href="main.php"</script><?php
            }else{ ?><script>alert("無法儲存自己的貼文");location.href="main.php"</script><?php }
        }else{ ?><script>alert("請先登入");location.href="main.php"</script><?php }
    }elseif(isset($_GET["logout"])){
        $data=$_SESSION["data"];
        query($db,"UPDATE `user` SET `token`='' WHERE `id`='$data'");
        session_unset();
        query($db,"INSERT INTO `log`(`number`,`move`,`time`)VALUES('$data','登出成功','$time')");
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }else{ ?><script>alert("[ERROR]error key(404)");location.href="main.php"</script><?php }
?>