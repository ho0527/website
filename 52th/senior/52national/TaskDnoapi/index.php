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
                帳號 <input type="text" class="input" id="username" name="username" value="<?= @$_SESSION["username"] ?>" maxlength="1250"><br><br>
                密碼 <input type="password" class="input" id="password" name="password" value="<?= @$_SESSION["password"] ?>" maxlength="1250"><br><br>
                <input type="button" class="button" onclick="location.href='signup.php'" value="註冊">
                <input type="submit" class="button" name="loginsubmit" value="登入">
                <input type="button" class="button" onclick="location.href='main.php'" value="瀏覽貼文(主頁)">
            </form>
        </div>
        <?php
            if(isset($_POST["loginsubmit"])){
                $_SESSION["username"]=$_POST["username"];
                $_SESSION["password"]=$_POST["password"];
                $username=$_SESSION["username"];
                $password=$_SESSION["password"];
                if(!block($username)){
                    if($row=fetch(query($dbuser,"SELECT*FROM `user` WHERE `username`='$username'"))){
                        if($row[3]==$password){
                            query($dbuser,"INSERT INTO `data`(`number`,`move`,`time`)VALUES('$row[1]','登入成功','$time')");
                            session_unset();
                            $_SESSION["data"]=$row[1];
                            ?><script>alert("登入成功");location.href="check.php"</script><?php
                        }else{
                            ?><script>alert("密碼有誤");location.href="index.php"</script><?php
                        }
                    }else{
                        ?><script>alert("帳號有誤");location.href="index.php"</script><?php
                    }
                }else{
                    ?><script>alert("帳號有誤");location.href="index.php"</script><?php
                }
            }

            if(isset($_GET["reset"])){
                unset($_SESSION["username"]);
                unset($_SESSION["password"]);
                header("location:index.php");
            }
        ?>
    </body>
</html>