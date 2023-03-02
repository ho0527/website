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
        if(isset($_GET["num"])){
            $num=$_GET["num"];
            if($row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$num'"))){
                ?>
                <div class="head">
                    <form class="headf">
                        咖啡商品展示系統-編輯使用者
                        <input type="button" class="ubutton select" onclick="location.href='signupedit.php'" value="編輯使用者">
                        <input type="button" class="ubutton" onclick="location.href='user.php'" value="首頁">
                        <input type="button" class="ubutton" onclick="location.href=''" value="上架商品">
                        <input type="button" class="ubutton" onclick="location.href=''" value="查詢">
                        <input type="button" class="ubutton" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="ubutton" name="logout" value="登出">
                    </form>
                </div>
                <div class="signup">
                    <form>
                        編號: <input type="text" name="number" value="<?= $row[4] ?>" readonly><br>
                        姓名: <input type="text" name="name" value="<?= $row[3] ?>"><br>
                        帳號: <input type="text" name="username" value="<?= $row[1] ?>"><br>
                        密碼: <input type="text" name="code" value="<?= $row[2] ?>"><br>
                        <?php
                        if($row[5]=="管理者"){
                            ?>
                            管理員權限: <input type="checkbox" name="adminbox" checked><br>
                            <?php
                        }else{
                            ?>
                            管理員權限: <input type="checkbox" name="adminbox"><br>
                            <?php
                        }
                        ?>
                        <input type="button" onclick="location.href='user.php'" value="取消">
                        <input type="submit" name="edit" value="送出">
                    </form>
                </div>
                <?php
            }else{
                ?><script>alert("帳號已被刪除");location.href="admin.php"</script><?php
            }
        }else{
            ?>
            <div class="head">
                <form class="headf">
                    咖啡商品展示系統-新增使用者
                    <input type="button" class="ubutton select" onclick="location.href='signupedit.php'" value="新增使用者">
                    <input type="button" class="ubutton" onclick="location.href='user.php'" value="首頁">
                    <input type="button" class="ubutton" onclick="location.href=''" value="上架商品">
                    <input type="button" class="ubutton" onclick="location.href=''" value="查詢">
                    <input type="button" class="ubutton" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="ubutton" name="logout" value="登出">
                </form>
            </div>
            <div class="signup">
                <form>
                    姓名: <input type="text" name="name"><br>
                    帳號: <input type="text" name="username"><br>
                    密碼: <input type="text" name="code"><br>
                    管理員權限: <input type="checkbox" name="adminbox"><br>
                    <input type="button" onclick="location.href='user.php'" value="取消">
                    <input type="submit" name="sign" value="送出">
                </form>
            </div>
            <?php
        }
        if(isset($_GET["sign"])){
            $name=$_GET["name"];
            $username=$_GET["username"];
            $code=$_GET["code"];
            $adminbox=$_GET["adminbox"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
            if($username==""||$code==""){
                ?><script>alert("請輸入帳號密碼");location.href="signupedit.php"</script><?php
            }elseif($row){
                ?><script>alert("帳號已被註冊");location.href="signupedit.php"</script><?php
            }else{
                if(isset($adminbox)){
                    query($db,"INSERT INTO `user`(`username`,`password`,`name`,`permission`) VALUES('$username','$code','$name','管理者')");
                    $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                    $number=str_pad($row[0]-1,4,"0",STR_PAD_LEFT);
                    query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                    ?><script>alert("註冊成功");location.href="user.php"</script><?php
                }else{
                    query($db,"INSERT INTO `user`(`username`,`password`,`name`,`permission`) VALUES('$username','$code','$name','一般使用者')");
                    $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                    $number=str_pad($row[0]-1,4,"2",STR_PAD_LEFT);
                    query($db,"UPDATE `user` SET `number`='$number'");
                    ?><script>alert("註冊成功");location.href="user.php"</script><?php
                }
            }
        }
        if(isset($_GET["edit"])){
            $number=$_GET["number"];
            $name=$_GET["name"];
            $username=$_GET["username"];
            $code=$_GET["code"];
            $adminbox=$_GET["adminbox"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
            if($username==""||$code==""){
                ?><script>alert("請輸入帳號密碼");location.href="signupedit.php"</script><?php
            }elseif($row&&$row[4]!=$number){
                ?><script>alert("帳號已被註冊");location.href="signupedit.php"</script><?php
            }else{
                if(isset($adminbox)){
                    query($db,"UPDATE `user` SET `username`='$username',`password`='$code',`name`='$name',`permission`='管理者' WHERE `number`='$number'");
                    ?><script>alert("修改成功");location.href="user.php"</script><?php
                }else{
                    query($db,"UPDATE `user` SET `username`='$username',`password`='$code',`name`='$name',`permission`='一般使用者' WHERE `number`='$number'");
                    ?><script>alert("修改成功");location.href="user.php"</script><?php
                }
            }
        }
    ?>
</body>
</html>