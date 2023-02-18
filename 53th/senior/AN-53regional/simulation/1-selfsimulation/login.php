<?php
    include("link.php");
    $username=$_GET["username"];
    $code=$_GET["code"];
    if(!isset($_SESSION["error"])){
        $_SESSION["error"]=0;
    }
    if($row=fetch(query($db,"SELECT * FROM `user` WHERE `username`='$username'"))){
        if($row[2]==$code){
            $ans=str_split($_SESSION["verify"]);
            $input=str_split($_GET["verify"]);
            print_r($ans);
            if($_SESSION["key"]==0){
                rsort($ans);
            }else{
                sort($ans);
            }
            print_r($ans);
            print_r($input);
            if($ans==$input){
                ?><script>alert("登入成功");location.href="verify.php"</script><?php
                query($db,"INSERT INTO `data`( `number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$date','登入成功')");
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
                    query($db,"INSERT INTO `data`( `number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$date','登入失敗')");
                    session_unset();
                }
            }
        }else{
            $_SESSION["error"]++;
            if($_SESSION["error"]<3){
                ?><script>alert("密碼有誤");location.href="index.php"</script><?php
            }else{
                ?><script>alert("密碼有誤");location.href="usererror.php"</script><?php
                query($db,"INSERT INTO `data`( `number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$date','登入失敗')");
                session_unset();
            }
        }
    }else{
        $_SESSION["error"]++;
        if($_SESSION["error"]<3){
            ?><script>alert("帳號有誤");location.href="index.php"</script><?php
        }else{
            ?><script>alert("帳號有誤");location.href="usererror.php"</script><?php
            query($db,"INSERT INTO `data`( `number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('未知','','','','','','登入失敗')");
            session_unset();
        }
    }
?>