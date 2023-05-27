<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TaskD</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){ header("location:main.php"); }
        ?>
        <div class="main">
            <form method="POST">
                <h2>登入</h2><hr>
                帳號 <input type="text" class="input" name="email"><br><br>
                密碼 <input type="password" class="input" name="password"><br><br>
                <input type="button" class="button" onclick="location.href='signup.php'" value="註冊">
                <input type="submit" class="button" name="loginsubmit" value="登入">
                <input type="button" class="button" onclick="location.href='main.php'" value="瀏覽貼文(主頁)">
            </form>
        </div>
        <?php
            if(isset($_POST["loginsubmit"])){
                $email=$_POST["email"];
                $password=$_POST["password"];
                if($row=query($db,"SELECT*FROM `user` WHERE `email`=?",[$email])[0]){
                    if($row[4]==$password){
                        query($db,"INSERT INTO `log`(`number`,`move`,`time`)VALUES('$row[0]','登入成功','$time')");
                        session_unset();
                        $_SESSION["data"]=$row[0];
                        ?><script>alert("登入成功");location.href="main.php"</script><?php
                    }else{
                        ?><script>alert("密碼有誤");location.href="index.php"</script><?php
                    }
                }else{
                    ?><script>alert("帳號有誤");location.href="index.php"</script><?php
                }
            }
        ?>
    </body>
</html>