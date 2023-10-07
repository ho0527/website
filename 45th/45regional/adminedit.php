<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>重設帳密</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <div class="main">
            <form>
                <?php
                    include("link.php");
                    if(isset($_GET["number"])){
                        $number=$_GET["number"];
                        $user=query("SELECT*FROM `user` WHERE `usernumber`='$number'");
                        $admin=query("SELECT*FROM `admin` WHERE `adminnumber`='$number'");
                        if($row=fetch($user)){
                            ?>
                            編號: <input type="text" class="input" name="number" value="<?php echo($number); ?>" readonly><br><br>
                            帳號: <input type="text" class="input" name="username" value="<?php echo($row[1]); ?>"><br><br>
                            用戶名: <input type="text" class="input" name="name" value="<?php echo($row[3]); ?>"><br><br>
                            密碼: <input type="text" class="input" name="code" value="<?php echo($row[2]); ?>"><br><br>
                            <input type="button" class="button" onclick="location.href='adminWelcome.php'" value="返回">
                            <input type="submit" class="button" name="submit" value="確定">
                            <?php
                        }elseif($row=fetch($admin)){
                            ?>
                            編號: <input type="text" name="number" value="<?php echo($number); ?>" readonly><br><br>
                            帳號: <input type="text" name="username" value="<?php echo($row[1]); ?>"><br><br>
                            用戶名: <input type="text" name="name" value="<?php echo($row[3]); ?>"><br><br>
                            密碼: <input type="text" name="code" value="<?php echo($row[2]); ?>"><br><br>
                            <input type="button" class="button" onclick="location.href='adminWelcome.php'" value="返回">
                            <input type="submit" class="button" name="submit" value="確定">
                            <?php
                        }else{
                            ?><script>alert("帳號已被刪除!");location.href="adminWelcome.php"</script><?php
                        }
                    }
                ?>
            </form>
        </div>
        <?php
            if(isset($_GET["submit"])){
                $username=$_GET["username"];
                $code=$_GET["code"];
                $name=$_GET["name"];
                $user=query("SELECT*FROM `user` WHERE `usernumber`='$number'");
                $admin=query("SELECT*FROM `admin` WHERE `adminnumber `='$number'");
                if($username==""&&$code==""){
                    ?><script>alert("請填寫帳密!");location.href="adminWelcome.php"</script><?php
                }elseif($row&&$row[0]!=$number){
                    ?><script>alert("帳號已存在");location.href="adminWelcome.php"</script><?php
                }else{
                    if($row=fetch($user)){
                        query("UPDATE `user` SET `name`='$name',`usercode`='$code',`username`='$username' WHERE `usernumber`='$number'");
                        $row=fetch(query("SELECT*FROM `user` WHERE `usernumber`='$number'"));
                        query("INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)
                        VALUES('$number','$row[1]','$row[2]','$row[3]','一般使用者','-','-','管理員編輯','$time')");
                        ?><script>alert("更改成功!");location.href="adminWelcome.php"</script><?php
                    }elseif($row=fetch($admin)){
                        query("UPDATE `admin` SET `name`='$name',`admincode`='$code',`adminname`='$username' WHERE `adminnumber`='$number'");
                        $row=fetch(query("SELECT*FROM `admin` WHERE `adminnumber`='$number'"));
                        query("INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`move`,`movetime`)VALUES('$number','$row[1]','$row[2]','$row[3]','管理者','管理員編輯','$time')");
                        ?><script>alert("更改成功!");location.href="adminWelcome.php"</script><?php
                    }
                }
            }
        ?>
    </body>
</html>