<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
        <?php
            include("link.php");
            if(isset($_GET["number"])){
                $number=$_GET["number"];
                if($row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"))){
                    ?>
                    <div class="header">
                        <form class="headerform">
                            <div class="headtitle">咖啡商品展示系統-編輯使用者</div>
                            <div class="headbut">
                                <input type="button" class="hbutton selectbut" onclick="location.href='signupedit.php'" value="編輯">
                                <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                                <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="上架商品">
                                <input type="button" class="hbutton" onclick="location.href='search.php'" value="查詢">
                                <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                                <input type="submit" class="hbutton" name="logout" value="登出">
                            </div>
                        </form>
                    </div>
                    <div class="signupdiv">
                        <form class="text">
                            編號: <input type="text" name="number" value="<?= ($number); ?>" readonly><br><br>
                            帳號: <input type="text" name="username" value="<?= ($row[1]); ?>"><br><br>
                            用戶名: <input type="text" name="name" value="<?= ($row[3]); ?>"><br><br>
                            密碼: <input type="text" name="code" value="<?= ($row[2]); ?>"><br><br>
                            <?php
                            if($row[5]=="管理者"){
                                ?>管理員權限: <input type="checkbox" name="adminbox" checked><br><br><?php
                            }else{
                                ?>管理員權限: <input type="checkbox" name="adminbox"><br><br><?php
                            }
                            ?>
                            <input type="button" onclick="location.href='admin.php'" class="button" value="返回">
                            <input type="submit" name="edit" class="button" value="送出"><br>
                        </form>
                    </div>
                    <?php
                }else{
                    ?><script>alert("帳號已被刪除!");location.href="admin.php"</script><?php
                }
            }else{
                ?>
                <div class="header">
                    <form class="headerform">
                        <div class="headtitle">咖啡商品展示系統-新增使用者</div>
                        <div class="headbut">
                            <input type="button" class="hbutton selectbut" onclick="location.href='signupedit.php'" value="新增">
                            <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                            <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="上架商品">
                            <input type="button" class="hbutton" onclick="location.href='search.php'" value="查詢">
                            <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                            <input type="submit" class="hbutton" name="logout" value="登出">
                        </div>
                    </form>
                </div>
                <div class="signupdiv">
                    <form class="text">
                        用戶帳號: <input type="text" class="input" name="username"><br><br>
                        密碼: <input type="text" class="input" name="code"><br><br>
                        用戶名: <input type="text" class="input" name="name"><br><br>
                        管理員權限: <input type="checkbox" name="adminbox"><br><br>
                        <input type="button" onclick="location.href='main.php'" class="button" value="返回">
                        <input type="submit" name="signup" class="button" value="送出"><br>
                    </form>
                </div>
                <?php
            }
            if(isset($_GET["signup"])){
                $username=$_GET["username"];
                $name=$_GET["name"];
                $code=$_GET["code"];
                $row=fetch(query($db,"SELECT*FROM `user` WHERE username='$username'"));
                if($username==""&&$code==""){
                    ?><script>alert("請填寫帳密!")</script><?php
                }elseif($row){
                    ?><script>alert("帳號已被註冊")</script><?php
                }else{
                    if(isset($_GET["adminbox"])){
                        query($db,"INSERT INTO `user`(`username`, `password`, `name`,`permission`) VALUES('$username','$code','$name','管理者')");
                        $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                        $number=str_pad(($row[0]-1),4,"0",STR_PAD_LEFT);
                        query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                        header("location:main.php");
                    }else{
                        query($db,"INSERT INTO `user`(`username`, `password`, `name`, `permission`) VALUES('$username','$code','$name','一般使用者')");
                        $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                        $number=str_pad(($row[0]-1),4,"0",STR_PAD_LEFT);
                        query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                        header("location:main.php");
                    }
                }
            }
            if(isset($_GET["edit"])){
                $username=$_GET["username"];
                $code=$_GET["code"];
                $name=$_GET["name"];
                $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                if($username==""&&$code==""){
                    ?><script>alert("請填寫帳密!")</script><?php
                }elseif($row&&$row[4]!=$number){
                    ?><script>alert("帳號已被註冊")</script><?php
                }else{
                    if($_GET["adminbox"]){
                        query($db,"UPDATE `user` SET `username`='$username' ,`name`='$name',`password`='$code',`permission`='管理者' WHERE `number`='$number'");
                        ?><script>alert("更改成功!");location.href="admin.php"</script><?php
                    }else{
                        query($db,"UPDATE `user` SET `username`='$username' ,`name`='$name',`password`='$code',`permission`='一般使用者' WHERE `number`='$number'");
                        ?><script>alert("更改成功!");location.href="admin.php"</script><?php
                    }
                }
            }
        ?>
</body>
</html>