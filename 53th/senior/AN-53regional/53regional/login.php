<?php
    include('link.php');
    if(isset($_GET["username"])){
        if(!isset($_SESSION["error"])){
            $_SESSION["error"]=0;
        }
        $username=$_GET["username"];
        $code=$_GET["code"];
        $_SESSION["username"]=$username;
        $_SESSION["password"]=$code;
        $user=query($db,"SELECT*FROM `user` WHERE `username`='$username'");
        if($row=fetch($user)){
            if($row[2]==$code){
                $verifyans=str_split($_SESSION["verifycode"]);
                $verify=str_split($_GET["verifycode"]);
                if($_SESSION["key"]==0){
                    rsort($verifyans);
                }else{
                    sort($verifyans);
                }
                if($verifyans==$verify){
                    ?><script>alert("登入成功");location.href="verify.php"</script><?php
                    query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登入成功')");
                    session_unset();
                    $_SESSION["data"]=$row[4];
                    $_SESSION["permission"]=$row[5];
                    $_SESSION["timer"]=60;
                }else{
                    $_SESSION["error"]=$_SESSION["error"]+1;
                    if($_SESSION["error"]<3){
                        ?><script>alert("圖形驗證碼有誤");location.href="index.php"</script><?php
                    }else{
                        ?><script>alert("圖形驗證碼有誤");location.href="usererror.php"</script><?php
                        query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登入失敗')");
                        header('Location: usererror.php');
                        session_unset();
                    }
                }
            }else{
                $_SESSION["error"]=$_SESSION["error"]+1;
                if($_SESSION["error"]<3){
                    ?><script>alert("密碼有誤");location.href="index.php"</script><?php
                }else{
                    ?><script>alert("密碼有誤");location.href="usererror.php"</script><?php
                    query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登入失敗')");
                    session_unset();
                }
            }
        }else{
            if($_SESSION["error"]<3){
                ?><script>alert("帳號有誤");location.href="index.php"</script><?php
                $_SESSION["error"]=$_SESSION["error"]+1;
            }else{
                ?><script>alert("帳號有誤");location.href="usererror.php"</script><?php
                query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('未知','','','','','','登入失敗')");
                session_unset();
            }
        }
    }else{
        ?><script>alert("未知錯誤請重新登入");location.href="index.php"</script><?php
    }
?>