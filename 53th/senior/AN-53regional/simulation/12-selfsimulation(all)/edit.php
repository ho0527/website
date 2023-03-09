<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 20%;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if(isset($_GET["edit"])){
            $number=$_GET["edit"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"));
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mainbutton selt" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查尋">
            <input type="button" class="mainbutton logout" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <h2>新增使用者</h2>
                <form action="">
                    編號: <input type="text" class="mag" name="number" value="<?= $row[1] ?>"><br>
                    姓名: <input type="text" class="mag" name="name" value="<?= $row[4] ?>"><br>
                    帳號: <input type="text" class="mag" name="username" value="<?= $row[2] ?>"><br>
                    密碼: <input type="text" class="mag" name="code" value="<?= $row[3] ?>"><br>
                    <?php
                    if($row[5]=="管理者"){
                        ?>管理者權限: <input type="checkbox" name="admin" checked><?php
                    }else{
                        ?>管理者權限: <input type="checkbox" name="admin"><?php
                    }
                    ?>
                    <input type="button" class="mainbutton" onclick="location.href='admin.php'" value="返回">
                    <input type="submit" class="mainbutton" name="es" value="送出">
                </form>
            </div>
            <?php
        }else{
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mainbutton selt" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查尋">
            <input type="button" class="mainbutton logout" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <h2>新增使用者</h2>
                <form action="">
                    姓名: <input type="text" class="mag" name="name"><br>
                    帳號: <input type="text" class="mag" name="username"><br>
                    密碼: <input type="text" class="mag" name="code"><br>
                    管理者權限: <input type="checkbox" name="admin">
                    <input type="button" class="mainbutton" onclick="location.href='admin.php'" value="返回">
                    <input type="submit" class="mainbutton" name="news" value="送出">
                </form>
            </div>
            <?php
        }
        if(isset($_GET["news"])){
            $username=$_GET["username"];
            $code=$_GET["code"];
            $name=$_GET["name"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
            if($username==""||$code==""){
                ?><script>alert("請輸入帳密");location.href="edit.php"</script><?php
            }elseif($row){
                ?><script>alert("帳號已被註冊");location.href="edit.php"</script><?php
            }else{
                if(isset($_GET["admin"])){
                    query($db,"INSERT INTO `user`(`username`,`code`,`name`,`permission`)VALUES('$username','$code','$name','管理者')");
                }else{
                    query($db,"INSERT INTO `user`(`username`,`code`,`name`,`permission`)VALUES('$username','$code','$name','一般使用者')");
                }
            }
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
            $number=str_pad($row[0]-1,4,"0",STR_PAD_LEFT);
            query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
            ?><script>alert("新增成功");location.href="admin.php"</script><?php
        }
        if(isset($_GET["es"])){
            $number=$_GET["number"];
            $username=$_GET["username"];
            $code=$_GET["code"];
            $name=$_GET["name"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"));
            if($username==""||$code==""){
                ?><script>alert("請輸入帳密");location.href="edit.php"</script><?php
            }elseif($row&&$row[1]!=$number){
                ?><script>alert("帳號已被註冊");location.href="edit.php"</script><?php
            }else{
                if(isset($_GET["admin"])){
                    query($db,"UPDATE `user` SET `username`='$username',`code`='$code',`name`='$name',`permission`='管理者' WHERE `number`='$number'");
                }else{
                    query($db,"UPDATE `user` SET `username`='$username',`code`='$code',`name`='$name',`permission`='一般使用者' WHERE `number`='$number'");
                }
            }
            ?><script>alert("修改成功");location.href="admin.php"</script><?php
        }
        if(isset($_GET["del"])){
            $number=$_GET["del"];
            query($db,"DELETE FROM `user` WHERE `number`='$number'");
            ?><script>alert("刪除成功");location.href="admin.php"</script><?php
        }
    ?>
</body>
</html>