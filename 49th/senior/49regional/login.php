<?php
    include("link.php");
    if(isset($_GET["username"])){
        if(!isset($_SESSION["error"])){
            $_SESSION["error"]=0;
        }
        $username=$_GET["username"];
        $code=$_GET["code"];
        $_SESSION["username"]=$username;
        $_SESSION["password"]=$code;
        if(!block($username)){
            if($row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"))){
                if($row[3]==$code){
                    if($_SESSION["verifycode"]==$_GET["verifycode"]){
                        query($db,"INSERT INTO `data`(`number`,`move`,`movetime`)VALUES('$row[1]','$time','登入成功')");
                        session_unset();
                        $_SESSION["data"]=$row[1];
                        $_SESSION["permission"]=$row[5];
                        $_SESSION["timer"]=60;
                        if($_SESSION["data"]=="a0001"){
                            ?><script>alert("登入成功");location.href="verify.php"</script><?php
                        }else{
                            ?><script>alert("登入成功");location.href="main.php"</script><?php
                        }
                    }else{
                        $_SESSION["error"]=$_SESSION["error"]+1;
                        if($_SESSION["error"]<3){
                            ?><script>alert("圖形驗證碼有誤");location.href="index.php"</script><?php
                        }else{
                            query($db,"INSERT INTO `data`(`number`,`move`,`movetime`)VALUES('$row[1]','$time','登入失敗')");
                            session_unset();
                            ?><script>alert("圖形驗證碼有誤");location.href="usererror.php"</script><?php
                        }
                    }
                }else{
                    $_SESSION["error"]=$_SESSION["error"]+1;
                    if($_SESSION["error"]<3){
                        ?><script>alert("密碼有誤");location.href="index.php"</script><?php
                    }else{
                        query($db,"INSERT INTO `data`(`number`,`move`,`movetime`)VALUES('$row[1]','$time','登入失敗')");
                        session_unset();
                        ?><script>alert("密碼有誤");location.href="usererror.php"</script><?php
                    }
                }
            }else{
                $_SESSION["error"]=$_SESSION["error"]+1;
                if($_SESSION["error"]<3){
                    ?><script>alert("帳號有誤");location.href="index.php"</script><?php
                }else{
                    query($db,"INSERT INTO `data`(`number`,`move`,`movetime`)VALUES('未知','$time','登入失敗')");
                    session_unset();
                    ?><script>alert("帳號有誤");location.href="usererror.php"</script><?php
                }
            }
        }else{
            $_SESSION["error"]=$_SESSION["error"]+1;
            if($_SESSION["error"]<3){
                ?><script>alert("帳號有誤");location.href="index.php"</script><?php
            }else{
                query($db,"INSERT INTO `data`(`number`,`move`,`movetime`)VALUES('未知','$time','登入失敗')");
                session_unset();
                ?><script>alert("帳號有誤");location.href="usererror.php"</script><?php
            }
        }
    }else{
        ?><script>alert("未知錯誤請重新登入");location.href="index.php"</script><?php
    }
?>