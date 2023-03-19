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
            if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
        ?>
        <h1>電子競技網站管理</h1>
        <input type="button" class="button" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button selectbutton" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="button logout" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <?php
            if(isset($_SESSION["edit"])){
                $number=$_SESSION["edit"];
                $user=query($db,"SELECT*FROM `user` WHERE `number`='$number'");
                ?>
                <div class="main">
                    <form>
                        <h2>編輯使用者</h2>
                        <hr>
                        編號: <input type="text" name="number" value="<?php echo($row[1]); ?>" readonly><br><br>
                        姓名: <input type="text" name="name" value="<?php echo($row[4]); ?>"><br><br>
                        帳號: <input type="text" name="username" value="<?php echo($row[2]); ?>"><br><br>
                        密碼: <input type="text" name="password" value="<?php echo($row[3]); ?>"><br><br>
                        <?php
                            if($row[5]=="管理者"){
                                ?><input type="checkbox" name="admin" checked><?php
                            }else{
                                ?><input type="checkbox" name="admin"><?php
                            }
                        ?>
                        <button name="enter">更改帳號</button>
                        <button type="button" onclick="location.href='admin.php'">返回主頁</button>
                    </form>
                </div>
                <?php
            }else{
                ?>
                <div class="main">
                    <form>
                        <h2>新增使用者</h2>
                        <hr>
                        姓名: <input type="text" class="input" name="name"><br><br>
                        帳號: <input type="text" class="input" name="username"><br><br>
                        密碼: <input type="text" class="input" name="password"><br><br>
                        管理員權限<input type="checkbox" class="checkbox" name="admin">
                        <input type="button" class="button" onclick="location.href='admin.php'" value="返回主頁">
                        <input type="submit" class="button" name="signupsubmit" value="送出">
                    </form>
                </div>
                <?php
            }
        ?>
        <?php
            if(isset($_GET["signupsubmit"])){

            }

            if(isset($_GET["enter"])){
                $number=$_GET["number"];
                $username=$_GET["username"];
                $password=$_GET["password"];
                $name=$_GET["name"];
                $user=query($db,"SELECT*FROM `user` WHERE `number`='$number'");
                if(block($username)||block($password)||block($name)){
                    ?><script>alert("禁止輸入特殊字元!");location.href="admin.php"</script><?php
                }else{
                    if($username==""||$password==""){
                        ?><script>alert("請填寫帳密!");location.href="admin.php"</script><?php
                    }elseif($row&&$row[1]!=$number){
                        ?><script>alert("帳號已存在");location.href="admin.php"</script><?php
                    }else{
                        if(isset($_GET["admin"])){
                            query($db,"UPDATE `user` SET `username`='$username',`password`='$password',`name`='$name',`permission`='管理者' WHERE `number`='$number'");
                        }else{
                            query($db,"UPDATE `user` SET `username`='$username',`password`='$password',`name`='$name',`permission`='一般使用者' WHERE `number`='$number'");
                        }
                        ?><script>alert("更改成功!");location.href="admin.php"</script><?php
                    }
                }
            }
        ?>
    </body>
</html>