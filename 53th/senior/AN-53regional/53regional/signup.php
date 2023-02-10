<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>signup</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="signupdiv">
            <form>
                用戶帳號: <input type="text" class="input" name="username"><br><br>
                密碼: <input type="text" class="input" name="code"><br><br>
                用戶名: <input type="text" class="input" name="name"><br><br>
                管理員權限: <input type="checkbox" name="adminbox"><br><br>
                <input type="submit" class="button" value="送出">
                <input type="button" onclick="location.href='adminWelcome.php'" class="button" value="返回"><br>
            </form>
        </div>
    <?php
        include("link.php");
        if(isset($_GET["username"])){
            $username=$_GET["username"];
            $name=$_GET["name"];
            $code=$_GET["code"];
            $rowuser=fetch(query($db,"SELECT*FROM `user` WHERE username='$username'"));
            if($rowuser){
                echo("帳號已被註冊");
            }else if($username==""||$code==""){
                echo("請輸入帳密");
            }else{
                if(isset($_GET["adminbox"])){
                    query($db,"INSERT INTO `user`(`username`, `password`, `name`,`permission`) VALUES ('$username','$code','$name','管理者')");
                    $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                    $number=str_pad(($row[0]-1),4,"0",STR_PAD_LEFT);
                    query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                    header("location:adminWelcome.php");
                }else{
                    query($db,"INSERT INTO `user`(`username`, `password`, `name`, `permission`) VALUES ('$username','$code','$name','一般使用者')");
                    $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                    $number=str_pad(($row[0]-1),4,"0",STR_PAD_LEFT);
                    query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                    header("location:adminWelcome.php");
                }
            }
        }
    ?>
    </body>
</html>