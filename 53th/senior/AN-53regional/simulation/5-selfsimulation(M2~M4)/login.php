<?php
    include("link.php");
    $_SESSION["username"]=$_GET["username"];
    $_SESSION["code"]=$_GET["code"];
    $username=$_GET["username"];
    $code=$_GET["code"];
    if(!isset($_SESSION["error"])){ $_SESSION["error"]=0; }
    if($row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"))){
        if($row[2]==$code){
            $verify=str_split($_SESSION["verify"]);
            if($_SESSION["key"]==0){ rsort($verify); }else{ sort($verify); }
            if($verify==str_split($_GET["verify"])){
                session_unset();
                query($db,"INSERT INTO `data`(`number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登入失敗')");
                $_SESSION["data"]=$row[4];
                $_SESSION["permission"]=$row[5];
                $_SESSION["timer"]=60;
                ?><script>alert("登入成功");location.href="verify.php"</script><?php
            }else{
                $_SESSION["error"]++;
                if($_SESSION["error"]<3){
                    ?><script>alert("圖形驗證碼有誤");location.href="index.php"</script><?php
                }else{
                    session_unset();
                    query($db,"INSERT INTO `data`(`number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登入失敗')");
                    ?><script>alert("圖形驗證碼有誤");location.href="usererror.php"</script><?php
                }
            }
        }else{
            $_SESSION["error"]++;
            if($_SESSION["error"]<3){
                ?><script>alert("密碼有誤");location.href="index.php"</script><?php
            }else{
                session_unset();
                query($db,"INSERT INTO `data`(`number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登入失敗')");
                ?><script>alert("密碼有誤");location.href="usererror.php"</script><?php
            }
        }
    }else{
        $_SESSION["error"]++;
        if($_SESSION["error"]<3){
            ?><script>alert("帳號有誤");location.href="index.php"</script><?php
        }else{
            session_unset();
            query($db,"INSERT INTO `data`(`number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('未知','','','','','$time','登入失敗')");
            ?><script>alert("帳號有誤");location.href="usererror.php"</script><?php
        }
    }
?>