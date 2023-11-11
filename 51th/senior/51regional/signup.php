<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>signup</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="/website/plugin/css/chrisplugin.css">
        <script src="/website/plugin/js/chrisplugin.js"></script>
    </head>
    <body>
        <div class="main">
            <form>
                帳號: <input type="text" class="input" name="username"><br><br>
                密碼: <input type="password" class="input" name="password"><br><br>
                <input type="button" onclick="location.href='index.php'" class="button" value="返回">
                <input type="submit" class="button" value="送出"><br>
            </form>
        </div>
    <?php
        include("link.php");
        if(isset($_GET["username"])){
            $username=$_GET["username"];
            $password=$_GET["password"];
            if(query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])){
                echo("帳號已被註冊");
            }elseif($username==""||$password==""){
                echo("請輸入帳密");
            }else{
                query($db,"INSERT INTO `user`(`username`,`password`)VALUES(?,?)",[$username,$password]);
                ?><script>alert("新增成功");location.href="index.php"</script><?php
            }
        }
    ?>
    </body>
</html>