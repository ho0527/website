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
            if(isset($_SESSION["login"])){ header("location:verify.php"); }
        ?>
        <div class="main">
            <form method="POST">
                <div class="maintitle">網路問卷調查系統</div><hr><br>
                帳號: <input type="text" class="input" name="username"><br><br>
                密碼: <input type="text" class="input" name="password"><br><br>
                <input type="reset" class="button" value="清除">
                <input type="submit" class="button" name="login" value="登入">
                <?php
                    if(isset($_POST["login"])){
                        $username=$_POST["username"];
                        $password=$_POST["password"];
                        if($row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"))){
                            print_r($row);
                            if($row[2]==$password){
                                ?><script>alert("登入成功");location.href="verify.php"</script><?php
                                session_unset();
                                $_SESSION["login"]="true";
                            }else{
                                ?><script>alert("密碼有誤");location.href="login.php"</script><?php
                            }
                        }else{
                            ?><script>alert("帳號有誤");location.href="login.php"</script><?php
                        }
                    }
                ?>
            </form><br>
            <form method="POST">
                填寫問卷網址:<input type="text" class="input" name="text" placeholder="請輸入網址">
                <input type="submit" class="button" name="submit" value="送出">
            </form>
        </div>
    </body>
</html>