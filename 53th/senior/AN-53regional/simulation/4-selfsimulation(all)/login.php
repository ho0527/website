<?php
    include("link.php");
    $_SESSION["username"]=$_GET["username"];
    $_SESSION["code"]=$_GET["code"];
    $username=$_GET["username"];
    $code=$_GET["code"];
    if(!isset($_SESSION["error"])){ $_SESSION["error"]=0; }
    if($row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"))){
        if($row[3]==$code){
            $verify=str_split($_SESSION["verify"]);
            if($_SESSION["key"]==0){ rsort($verify); }else{ sort($verify); }
            if($verify==str_split($_GET["verify"])){
                ?><script>alert("登入成功");location.href="verify.php"</script><?php
                session_unset();
                query($db,"INSERT INTO `data`(`number`, `username`, `password`,`permission` ,`name`, `move`, `movetime`) VALUES ('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','登入成功','$time')");
                $_SESSION["data"]=$row[1];
                $_SESSION["permission"]=$row[5];
                $_SESSION["timer"]=60;
            }else{
                $_SESSION["error"]++;
                if($_SESSION["error"]<3){
                    ?><script>alert("圖形驗證碼有誤");location.href="index.php"</script><?php
                }else{
                    ?><script>alert("圖形驗證碼有誤");location.href="usererror.php"</script><?php
                    session_unset();
                    query($db,"INSERT INTO `data`(`number`, `username`, `password`,`permission` ,`name`, `move`, `movetime`) VALUES ('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','登入失敗','$time')");
                }
            }
        }else{
            $_SESSION["error"]++;
            if($_SESSION["error"]<3){
                ?><script>alert("密碼有誤");location.href="index.php"</script><?php
            }else{
                ?><script>alert("密碼有誤");location.href="usererror.php"</script><?php
                session_unset();
                query($db,"INSERT INTO `data`(`number`, `username`, `password`,`permission` ,`name`, `move`, `movetime`) VALUES ('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','登入失敗','$time')");
            }
        }
    }else{
        $_SESSION["error"]++;
        if($_SESSION["error"]<3){
            ?><script>alert("帳號有誤");location.href="index.php"</script><?php
        }else{
            ?><script>alert("帳號有誤");location.href="usererror.php"</script><?php
            session_unset();
            query($db,"INSERT INTO `data`(`number`, `username`, `password`, `name`, `move`, `movetime`) VALUES ('未知','','','','登入失敗','$time')");
        }
    }
?>