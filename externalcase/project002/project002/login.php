<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){ header("location:upload.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="icon/logo.jpg" class="logo">
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="貨幣">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="進行">
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='login.php'" value="登入">
            </div>
        </div>
        <div class="loginmain">
            <form method="POST">
                帳號: <input type="text" class="input" name="username"><br><br>
                密碼: <input type="text" class="input" name="password"><br><br>
                <input type="button" class="button" onclick="location.href='signup.php'" value="註冊">
                <input type="reset" class="button" value="清除">
                <input type="submit" class="button" name="submit" value="登入">
            </form>
        </div>
        <?php
            if(isset($_POST["submit"])){
                $username=$_POST["username"];
                $password=$_POST["password"];
                if($row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0]){
                    if($row[2]==$password){
                        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`)VALUES(?,'登入系統','$time')",[$row[0]]);
                        session_unset();
                        $_SESSION["data"]=$row[0];
                        ?><script>alert("登入成功");location.href="upload.php"</script><?php
                    }else{
                        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`)VALUES(?,'登入失敗(password)','$time')",[$row[0]]);
                        ?><script>alert("密碼有誤");location.href="login.php"</script><?php
                    }
                }else{
                    query($db,"INSERT INTO `log`(`username`,`move`,`movetime`)VALUES(?,'登入失敗(account)','$time')",[$row[0]]);
                    ?><script>alert("帳號有誤");location.href="login.php"</script><?php
                }
            }
        ?>
    </body>
</html>