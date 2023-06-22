<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>signup</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="main">
            <form>
                帳號: <input type="text" class="input" name="username"><br><br>
                密碼: <input type="text" class="input" name="code"><br><br>
                用戶名: <input type="text" class="input" name="name"><br><br>
                管理員權限: <input type="checkbox" class="checkbox" name="adminbox">
                <input type="button" onclick="location.href='adminWelcome.php'" class="button" value="返回">
                <input type="submit" class="button" value="送出"><br>
            </form>
        </div>
    <?php
        include("link.php");
        if(isset($_GET["username"])){
            $username=$_GET["username"];
            $name=$_GET["name"];
            $code=$_GET["code"];
            $user=query("SELECT*FROM `user` WHERE userName='$username'");
            $admin=query("SELECT*FROM `admin` WHERE adminName='$username'");
            $rowuser=fetch($user);
            $rowadmin=fetch($admin);
            if($rowuser||$rowadmin){
                echo("帳號已被註冊");
            }elseif($username==""||$code==""){
                echo("請輸入帳密");
            }else{
                if(isset($_GET["adminbox"])){
                    query("INSERT INTO `admin`(`adminName`,`adminCode`,`name`)VALUES('$username','$code','$name')");
                    $userdata=query("SELECT*FROM `admin` WHERE `adminName`='$username'");
                    $row=fetch($userdata);
                    $number="a".str_pad($row[0],3,"0",STR_PAD_LEFT);
                    query("UPDATE `admin` SET `adminNumber`='$number' WHERE `adminName`='$username'");
                    $userdata2=query("SELECT*FROM `admin` WHERE `adminName`='$username'");
                    $row2=fetch($userdata2);
                    query("INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)VALUES('$row2[4]','$row[1]','$row[2]','$row[3]','管理者','-','-','註冊','$time')");
                    ?><script>alert("新增成功");location.href="adminWelcome.php"</script><?php
                }else{
                    query("INSERT INTO `user`(`userName`,`userCode`,`name`)VALUES('$username','$code','$name')");
                    $userdata=query("SELECT*FROM `user` WHERE `userName`='$username'");
                    $row=fetch($userdata);
                    $number="u".str_pad($row[0],3,"0",STR_PAD_LEFT);
                    query("UPDATE user SET `userNumber`='$number' WHERE `userName`='$username'");
                    $userdata=query("SELECT*FROM `user` WHERE `userName`='$username'");
                    $row2=fetch($userdata);
                    query("INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)VALUES('$row2[4]','$row[1]','$row[2]','$row[3]','一般使用者','-','-','註冊','$time')");
                    ?><script>alert("新增成功");location.href="adminWelcome.php"</script><?php
                }
            }
        }
    ?>
    </body>
</html>