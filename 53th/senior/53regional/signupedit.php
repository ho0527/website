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
            if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <?php
                if(isset($_GET["edit"])){
                    ?>
                        <div class="navigationbartitle">咖啡商品展示系統-編輯使用者</div>
                    </div>
                    <?php
                }else{
                    ?>
                        <div class="navigationbartitle">咖啡商品展示系統-新增使用者</div>
                    </div>
                    <?php
                }
                ?>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查詢">
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
            </div>
        </div>
        <div class="main">
            <form method="POST">
                <?php
                    if(isset($_GET["edit"])){
                        $number=$_GET["edit"];
                        $_SESSION["edit"]=$number;
                        if($number!="0000"){
                            if($row=query($db,"SELECT*FROM `user` WHERE `number`='$number'")[0]){
                                ?>
                                編號: <input type="text" class="input" name="number" value="<?= ($number); ?>" disabled><br><br>
                                帳號: <input type="text" class="input" name="username" value="<?= ($row[1]); ?>" disabled><br><br>
                                密碼: <input type="text" class="input" name="password" value="<?= ($row[3]); ?>"><br><br>
                                姓名: <input type="text" class="input" name="name" value="<?= ($row[2]); ?>"><br><br>
                                <?php
                                if($row[5]=="管理者"){
                                    ?>管理員權限: <input type="checkbox" class="checkbox" name="adminbox" checked><?php
                                }else{
                                    ?>管理員權限: <input type="checkbox" class="checkbox" name="adminbox"><?php
                                }
                                ?>
                                <input type="button" class="button" onclick="location.href='admin.php'" value="返回">
                                <input type="submit" class="button" name="edit" value="送出">
                                <?php
                            }else{ ?><script>alert("帳號不存在!");location.href="admin.php"</script><?php }
                        }else{ ?><script>alert("禁止編輯管理者帳號");location.href="admin.php"</script><?php }
                    }else{
                        ?>
                        帳號: <input type="text" class="input" name="username"><br><br>
                        密碼: <input type="text" class="input" name="password"><br><br>
                        姓名: <input type="text" class="input" name="name"><br><br>
                        管理員權限: <input type="checkbox" class="checkbox" name="adminbox">
                        <input type="button" class="button" onclick="location.href='admin.php'" value="返回">
                        <input type="submit" class="button" name="signup" value="送出">
                        <?php
                    }
                ?>
            </form>
        </div>
        <?php
            if(isset($_POST["signup"])){
                $username=$_POST["username"];
                $password=$_POST["password"];
                $name=$_POST["name"];
                $row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0];
                if($username==""&&$password==""){
                    ?><script>alert("請填寫帳密!")</script><?php
                }elseif($row){
                    ?><script>alert("帳號已被註冊")</script><?php
                }else{
                    if(isset($_POST["adminbox"])){
                        query($db,"INSERT INTO `user`(`username`,`password`,`name`,`permission`)VALUES(?,?,?,'管理者')",[$username,$password,$name]);
                        $row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0];
                        $number=str_pad(($row[0]-1),5,"0",STR_PAD_LEFT);
                        query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                        ?><script>alert("新增成功!");location.href="admin.php"</script><?php
                    }else{
                        query($db,"INSERT INTO `user`(`username`,`password`,`name`,`permission`)VALUES(?,?,?,'一般使用者')",[$username,$password,$name]);
                        $row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0];
                        $number=str_pad(($row[0]-1),5,"0",STR_PAD_LEFT);
                        query($db,"UPDATE `user` SET `number`='$number' WHERE `username`=?",[$username]);
                        ?><script>alert("新增成功!");location.href="admin.php"</script><?php
                    }
                }
            }
            if(isset($_POST["edit"])){
                $password=$_POST["password"];
                $name=$_POST["name"];
                $number=$_SESSION["edit"];
                $row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0];
                if($username==""&&$password==""){
                    ?><script>alert("請填寫帳密!")</script><?php
                }elseif($row&&$row[4]!=$number){
                    ?><script>alert("帳號已被註冊")</script><?php
                }else{
                    if($_POST["adminbox"]){
                        query($db,"UPDATE `user` SET `name`=?,`password`=?,`permission`='管理者' WHERE `number`='$number'",[$password,$name]);
                        ?><script>alert("更改成功!");location.href="admin.php"</script><?php
                    }else{
                        query($db,"UPDATE `user` SET `name`=?,`password`=?,`permission`='一般使用者' WHERE `number`='$number'",[$password,$name]);
                        ?><script>alert("更改成功!");location.href="admin.php"</script><?php
                    }
                }
            }
            if(isset($_GET["del"])){
                $number=$_GET["del"];
                if($number!="0000"){
                    if(query($db,"SELECT*FROM `user` WHERE `number`='$number'")){
                        query($db,"DELETE FROM `user` WHERE `number`='$number'");
                        ?><script>alert("刪除成功!");location.href="admin.php"</script><?php
                    }else{ ?><script>alert("帳號不存在!");location.href="admin.php"</script><?php }
                }else{ ?><script>alert("禁止刪除管理者帳號");location.href="admin.php"</script><?php }
            }
        ?>
    </body>
</html>