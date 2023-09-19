<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
        <!-- <link rel="stylesheet" href="../phone.css"> -->
        <link rel="stylesheet" href="../plugin/css/macossection.css">
        <link rel="stylesheet" href="../plugin/css/sort.css">
        <script src="../plugin/js/macossection.js"></script>
        <script src="../plugin/js/sort.js"></script>
    </head>
    <body>
        <?php include("../link.php"); ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="../icon/logo.jpg" class="logo">
            </div>
            <div class="navigationbarright">
                <img src="../icon/menu-outline.svg" class="menu" id="menubutton" draggable="false">
            </div>
            <div class="menudiv" id="menu">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="貨幣">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="進行">
                <?php
                    if(isset($_SESSION["data"])){
                        ?><input type="button" class="navigationbarbutton" onclick="location.href='../api.php?logout='" value="登出"><?php
                    }else{
                        ?><input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='login.php'" value="登入"><?php
                    }
                ?>
            </div>
        </div>
        <div class="loginmain">
            <form method="POST">
                帳號 <input type="text" class="input" name="username"><br><br>
                密碼 <input type="text" class="input" name="password"><br><br>
                <div class="xcenter">
                    <input type="reset" class="button" value="清除">
                    <input type="submit" class="button" name="submit" value="註冊">
                </div>
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
        <script src="menu.js"></script>
    </body>
</html>