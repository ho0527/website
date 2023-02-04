<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>網站前台登入介面</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <div class="logindiv">
            <form method="POST">
                <class class="indextitle">網路問卷調查系統</class>
                <?php include('link.php'); ?>
                <div class="text">
                    帳號: <input type="text" name="username" id="username" value="<?= @$_SESSION["username"] ?>" class="input"><br>
                </div>
                <div class="text">
                    密碼: <input type="password" name="code" id="code" value="<?= @$_SESSION["password"] ?>" class="input"><br>
                </div>
                <div class="div">
                    <input type="submit" value="清除" name="clear" class="button">
                    <input type="submit" value="登入" name="login" class="button">
                </div>
                <?php
                    if(isset($_POST["clear"])){
                        session_unset();
                        header("location:login.php");
                    }
                    if(isset($_POST["login"])){
                        $username=$_POST["username"];
                        $code=$_POST["code"];
                        $_SESSION["username"]=$username;
                        $_SESSION["password"]=$code;
                        $admin=mysqli_query($db,"SELECT*FROM `admin` WHERE `username`='$username'");
                        if($row=mysqli_fetch_row($admin)){
                            if($row[2]==$code){
                                    ?><script>alert("登入成功");location.href="verify.php"</script><?php
                                    session_unset();
                            }else{
                                ?><script>alert("密碼有誤");location.href="login.php"</script><?php
                            }
                        }else{
                            ?><script>alert("帳號有誤");location.href="login.php"</script><?php
                        }
                    }
                ?>
            </form>
        </div>
    </body>
</html>