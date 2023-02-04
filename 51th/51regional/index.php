<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="center">
            <div class="logindiv">
                <form method="POST">
                    <class class="indextitle">網路問卷調查系統</class>
                    <?php include("link.php"); ?>
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
                            header("location:index.php");
                        }
                        if(isset($_POST["login"])){
                            $username=$_POST["username"];
                            $code=$_POST["code"];
                            $_SESSION["username"]=$username;
                            $_SESSION["password"]=$code;
                            $admin=query("SELECT*FROM `admin` WHERE `username`='$username'");
                            if($row=fetch($admin)){
                                print_r($row);
                                if($row[2]==$code){
                                        ?><script>alert("登入成功");location.href="verify.php"</script><?php
                                        session_unset();
                                }else{
                                    ?><script>//alert("密碼有誤");location.href="login.php"</script><?php
                                }
                            }else{
                                ?><script>alert("帳號有誤");location.href="login.php"</script><?php
                            }
                        }
                    ?>
                </form>
                <div class="div link">
                    <class class="text">填寫問卷網址:<input type="text" name="text" placeholder="請輸入網址"></class>
                    <input type="submit" value="送出" name="submit">
                </div>
            </div>
        </div>
    </body>
</html>