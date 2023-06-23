<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>signup</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
            if(isset($_GET["edit"])){
                $id=$_GET["edit"];
                $_SESSION["id"]=$id;
                $row=query($db,"SELECT*FROM `user` WHERE `id`='$id'")[0];
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft">
                        <div class="navigationbartitle">專案討論系統</div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='signupedit.php'" value="修改">
                        <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='project.php'" value="專案管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='teamleader.php'" value="組長功能管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
                    </div>
                </div>
                <div class="main">
                    <form method="POST">
                        帳號: <input type="text" class="input" name="username" value="<?php echo($row[1]); ?>"><br><br>
                        密碼: <input type="password" class="input" name="password" value="<?php echo($row[2]); ?>"><br><br>
                        姓名: <input type="text" class="input" name="name" value="<?php echo($row[3]); ?>"><br><br>
                        <input type="button" class="button" onclick="location.href='admin.php'" value="返回">
                        <input type="submit" class="button" name="edit" value="送出"><br>
                    </form>
                </div>
                <?php
            }else{
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft">
                        <div class="navigationbartitle">專案討論系統</div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='signupedit.php'" value="新增">
                        <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='project.php'" value="專案管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='teamleader.php'" value="組長功能管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
                    </div>
                </div>
                <div class="main">
                    <form method="POST">
                        帳號: <input type="text" class="input" name="username"><br><br>
                        密碼: <input type="password" class="input" name="password"><br><br>
                        姓名: <input type="text" class="input" name="name"><br><br>
                        <input type="button" class="button" onclick="location.href='admin.php'" value="返回">
                        <input type="submit" class="button" name="signup" value="送出"><br>
                    </form>
                </div>
                <?php
            }
        ?>
    <?php
        if(isset($_POST["signup"])){
            $username=$_POST["username"];
            $password=$_POST["password"];
            $name=$_POST["name"];
            $row=query($db,"SELECT*FROM `user` WHERE `username`='$username'")[0];
            if($row){
                ?><script>alert("帳號已被註冊");location.href="signupedit.php"</script><?php
            }elseif($username==""||$password==""){
                ?><script>alert("請輸入帳密");location.href="signupedit.php"</script><?php
            }else{
                query($db,"INSERT INTO `user`(`username`,`password`,`name`)VALUES(?,?,?)",[$username,$password,$name]);
                $row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0];
                query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$row[0]','新增使用者','$time','')");
                ?><script>alert("新增成功");location.href="admin.php"</script><?php
            }
        }

        if(isset($_POST["edit"])){
            $id=$_SESSION["id"];
            $username=$_POST["username"];
            $password=$_POST["password"];
            $name=$_POST["name"];
            $row=query($db,"SELECT*FROM `user` WHERE `username`='$username'")[0];
            if($row&&$row[0]!=$id){
                ?><script>alert("帳號已被註冊");location.href="signupedit.php"</script><?php
            }elseif($username==""||$password==""){
                ?><script>alert("請輸入帳密");location.href="signupedit.php"</script><?php
            }else{
                query($db,"UPDATE`user`SET `username`=?,`password`=?,`name`=? WHERE `id`='$id'",[$username,$password,$name]);
                $row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0];
                query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$row[0]','註冊使用者','$time','')");
                ?><script>alert("新增成功");location.href="admin.php"</script><?php
            }
        }

        if(isset($_GET["del"])){
            $id=$_GET["del"];
            if($row=query($db,"SELECT*FROM `user` WHERE `id`='$id'")[0]){
                query($db,"DELETE FROM `user` WHERE `id`='$id'");
                query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$row[0]','刪除使用者','$time','')");
                ?><script>alert("刪除成功!");location.href="admin.php"</script><?php
            }else{ ?><script>alert("帳號已被刪除!");location.href="admin.php"</script><?php }
        }
    ?>
    </body>
</html>