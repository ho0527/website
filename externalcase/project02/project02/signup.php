<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php include("link.php"); ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="icon/logo.png" class="logo">
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="貨幣">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="進行">
                <input type="button" class="navigationbarbutton" onclick="location.href='login.php'" value="登入">
            </div>
        </div>
        <div class="loginmain">
            <form method="POST">
                帳號: <input type="text" class="input" name="username"><br><br>
                密碼: <input type="text" class="input" name="password"><br><br>
                <input type="reset" class="button" value="清除">
                <input type="submit" class="button" name="submit" value="註冊">
            </form>
        </div>
        <?php
            if(isset($_POST["submit"])){
                $username=$_POST["username"];
                $password=$_POST["password"];
                if($username==""||$password==""){
                    query($db,"INSERT INTO `log`(`username`,`move`,`movetime`)VALUES(?,'註冊失敗','$time')",[$username]);
                    ?><script>alert("請輸入帳密");location.href="signup.php"</script><?php
                }else{
                    if(!query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])){
                        query($db,"INSERT INTO `user`(`username`,`password`)VALUES(?,?)",[$username,$password]);
                        $row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0];
                        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`)VALUES(?,'註冊成功','$time')",[$row[0]]);
                        ?><script>alert("註冊成功");location.href="login.php"</script><?php
                    }else{
                        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`)VALUES(?,'註冊失敗','$time')",[$username]);
                        ?><script>alert("帳號已存在");location.href="signup.php"</script><?php
                    }
                }
            }
        ?>
    </body>
</html>