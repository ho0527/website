<?php
    include("link.php");
    if(!isset($_SESSION["error"])){ $_SESSION["error"]=0; }
    $username=$_GET["username"];
    $code=$_GET["code"];
    $_SESSION["username"]=$_GET["username"];
    $_SESSION["code"]=$_GET["code"];
    if($row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"))){
        if($row[2]==$code){
            $verifyans=str_split($_SESSION["verify"]);
            if($_SESSION["key"]==0){ rsort($verifyans); }else{ sort($verifyans); }
            if($verifyans==(str_split($_GET["verify"]))){
                ?><script>alert("登入成功");location.href="verify.php"</script><?php
                query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登入成功')");
                session_unset();
                $_SESSION["data"]=$row[4];
                $_SESSION["permission"]=$row[5];
                $_SESSION["timer"]=60;
            }else{
                $_SESSION["error"]++;
                if($_SESSION["error"]<3){
                    ?><script>alert("圖形驗證碼有誤");location.href="index.php"</script><?php
                }else{
                    ?><script>alert("圖形驗證碼有誤");location.href="usererror.php"</script><?php
                    query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登入失敗')");
                    session_unset();
                }
            }
        }else{
            $_SESSION["error"]++;
            if($_SESSION["error"]<3){
                ?><script>alert("密碼有誤");location.href="index.php"</script><?php
            }else{
                ?><script>alert("密碼有誤");location.href="usererror.php"</script><?php
                query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登入失敗')");
                session_unset();
            }
        }
    }else{
        $_SESSION["error"]++;
        if($_SESSION["error"]<3){
            ?><script>alert("帳號有誤");location.href="index.php"</script><?php
        }else{
            ?><script>alert("帳號有誤");location.href="usererror.php"</script><?php
            query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('未知','','','','','$time','登入失敗')");
            session_unset();
        }
    }
?>