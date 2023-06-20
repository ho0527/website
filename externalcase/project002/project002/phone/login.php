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
        <?php
            include("../link.php");
            if(isset($_SESSION["data"])){ header("location:upload.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="../icon/logo.png" class="logo">
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
                        ?><input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出"><?php
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
                    <input type="button" class="button" onclick="location.href='signup.php'" value="註冊">
                    <input type="submit" class="button" name="submit" value="登入">
                </div>
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
        <script src="menu.js"></script>
    </body>
</html>