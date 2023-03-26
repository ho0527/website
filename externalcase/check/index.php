<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>分數判別</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){ header("location:check.php"); }
        ?>
        <div class="main">
            <form method="POST">
                <h2>分數判別</h2><hr>
                帳號: <input type="text" name="username" class="input" id="username" value="<?= @$_SESSION["username"] ?>" maxlength="1250"><br><br>
                密碼: <input type="password" name="password" class="input" id="password" value="<?= @$_SESSION["password"] ?>" maxlength="1250"><br><br>
                <input type="button" class="button" onclick="location.href='signupedit.php'" value="註冊">
                <input type="button" class="button" onclick="location.href='index.php?reset='" value="清除">
                <input type="submit" class="button" name="loginsubmit" value="登入">
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