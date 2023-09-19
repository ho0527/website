<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>重設帳密</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){ header("location:check.php"); }
        ?>
        <?php
            if(isset($_SESSION["edit"])){
                $number=$_SESSION["edit"];
                $row=fetch(query($dbuser,"SELECT*FROM `user` WHERE `number`='$number'"));
                if($row){
                    ?>
                    <div class="main">
                        <form>
                            <h2>編輯使用者</h2>
                            <hr>
                            編號: <input type="text" class="input" name="number" value="<?php echo($row[1]); ?>" readonly><br><br>
                            帳號: <input type="text" class="input" name="username" value="<?php echo($row[2]); ?>" maxlength="1250"><br><br>
                            密碼: <input type="text" class="input" name="password" value="<?php echo($row[3]); ?>" maxlength="1250"><br><br>
                            <?php
                                if($row[5]=="管理者"){
                                    ?>管理員權限<input type="checkbox" class="checkbox" name="admin" checked><?php
                                }else{
                                    ?>管理員權限<input type="checkbox" class="checkbox" name="admin"><?php
                                }
                            ?>
                            <button type="button" class="button" onclick="location.href='index.php'">返回主頁</button>
                            <input type="submit" class="button" name="editsubmit" value="送出">
                        </form>
                    </div>
                    <?php
                }else{
                    ?><script>alert("找不到此使用者");location.href="index.php"</script><?php
                }
            }else{
                ?>
                <div class="main">
                    <form method="POST">
                        <h2>新增使用者</h2>
                        <hr>
                        帳號: <input type="text" class="input" name="username" maxlength="1250"><br><br>
                        密碼: <input type="text" class="input" name="password" maxlength="1250"><br><br>
                        管理員權限<input type="checkbox" class="checkbox" name="admin" disabled>
                        <input type="button" class="button" onclick="location.href='index.php'" value="返回主頁">
                        <input type="submit" class="button" name="signupsubmit" value="送出">
                    </form>
                </div>
                <?php
            }
        ?>
        <?php
            if(isset($_POST["signupsubmit"])){
                $username=$_POST["username"];
                $password=$_POST["password"];
                if(!(block($username))&&!(block($password))){
                    $row=fetch(query($dbuser,"SELECT*FROM `user` WHERE `username`='$username'"));
                    if($username==""||$password==""){
                        ?><script>alert("請填寫帳密!");location.href="signupedit.php"</script><?php
                    }elseif($row){
                        ?><script>alert("帳號已存在");location.href="signupedit.php"</script><?php
                    }else{
                        // if(isset($_POST["admin"])){
                        if(false){
                            query($dbuser,"INSERT INTO `user`(`username`,`password`,`permission`)VALUES('$username','$password','admin')");
                        }else{
                        }
                        query($dbuser,"INSERT INTO `user`(`username`,`password`,`permission`)VALUES('$username','$password','user')");
                        $row=fetch(query($dbuser,"SELECT*FROM `user` WHERE `username`='$username'"));
                        $number=str_pad($row[0]-1,8,"0",STR_PAD_LEFT);
                        query($dbuser,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                        ?><script>alert("新增成功!");location.href="index.php"</script><?php
                    }
                }else{
                    ?><script>alert("禁止輸入特殊字元!");location.href="signupedit.php"</script><?php
                }
            }

            if(isset($_POST["edit"])){
                if($_POST["edit"]=="a0000"){
                    ?><script>alert("有人說你可以改網址嗎?????");location.href="index.php"</script><?php
                }else{
                    $_SESSION["edit"]=$_POST["edit"];
                    ?><script>location.href="signupedit.php"</script><?php
                }
            }

            if(isset($_POST["del"])){
                if($_POST["del"]=="a0000"){
                    ?><script>alert("有人說你可以改網址嗎?????");location.href="index.php"</script><?php
                }else{
                    $number=$_POST["del"];
                    query($dbuser,"DELETE FROM `user` WHERE `number`='$number'");
                    ?><script>alert("刪除成功");location.href="index.php"</script><?php
                }
            }

            if(isset($_POST["editsubmit"])){
                $number=$_POST["number"];
                $username=$_POST["username"];
                $password=$_POST["password"];
                $name=$_POST["name"];
                if(!(block($name))&&!(block($username))&&!(block($password))){
                    $row=fetch(query($dbuser,"SELECT*FROM `user` WHERE `username`='$username'"));
                    if($number=="a0000"){
                        ?><script>alert("有人說你可以改編號嗎?????");location.href="index.php"</script><?php
                    }elseif($username==""||$password==""){
                        ?><script>alert("請填寫帳密!");location.href="signupedit.php"</script><?php
                    }elseif($row&&$row[1]!=$number){
                        ?><script>alert("帳號已存在");location.href="signupedit.php"</script><?php
                    }else{
                        if(isset($_POST["admin"])){
                            query($dbuser,"UPDATE `user` SET `username`='$username',`password`='$password',`name`='$name',`permission`='管理者' WHERE `number`='$number'");
                        }else{
                            query($dbuser,"UPDATE `user` SET `username`='$username',`password`='$password',`name`='$name',`permission`='一般使用者' WHERE `number`='$number'");
                        }
                        ?><script>alert("更改成功!");location.href="index.php"</script><?php
                    }
                }else{
                    ?><script>alert("禁止輸入特殊字元!");location.href="signupedit.php"</script><?php
                }
            }
        ?>
    </body>
</html>