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
            width: 25%;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
        if(isset($_SESSION["edit"])){
            $number=$_SESSION["edit"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"))
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="mbutton" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mbutton selt" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="mbutton" onclick="location.href='search.php'" value="查尋">
            <input type="button" class="mbutton logout" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main mag">
                <form action="">
                    <h2>編輯使用者</h2>
                    編號: <input type="text" name="number" value="<?= $row[1] ?>" readonly><br><br>
                    姓名: <input type="text" name="name" value="<?= $row[4] ?>"><br><br>
                    帳號: <input type="text" name="username" value="<?= $row[2] ?>"><br><br>
                    密碼: <input type="text" name="code" value="<?= $row[3] ?>"><br><br>
                    <?php
                    if($row[5]=="管理者"){
                        ?>管理員權限 <input type="checkbox" name="admin" id="" checked><?php
                    }else{
                        ?>管理員權限 <input type="checkbox" name="admin" id=""><?php
                    }
                    ?>
                    <input type="button" onclick="location.href='admin.php'" value="取消">
                    <input type="submit" name="es" value="送出">
                </form>
            </div>
            <?php
        }else{
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="mbutton" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mbutton selt" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="mbutton" onclick="location.href='search.php'" value="查尋">
            <input type="button" class="mbutton logout" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main mag">
                <form action="">
                    <h2>新增使用者</h2>
                    姓名: <input type="text" name="name" id="name"><br><br>
                    帳號: <input type="text" name="username" id="username"><br><br>
                    密碼: <input type="text" name="code" id="code"><br><br>
                    管理員權限 <input type="checkbox" name="admin" id="">
                    <input type="button" onclick="location.href='admin.php'" value="取消">
                    <input type="submit" name="news" value="送出">
                </form>
            </div>
            <?php
        }

        if(isset($_GET["news"])){
            $username=$_GET["username"];
            $name=$_GET["name"];
            $code=$_GET["code"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
            if(block($username)||block($code)||block($name)){
                ?><script>alert("帳密姓名不得有特殊字元");location.href="edit.php"</script><?php
            }else{
                if($username==""||$code==""){
                    ?><script>alert("請輸入帳密");location.href="edit.php"</script><?php
                }elseif($row){
                    ?><script>alert("帳號已被註冊");location.href="edit.php"</script><?php
                }else{
                    if(isset($_GET["admin"])){
                        query($db,"INSERT INTO `user`(`username`,`code`,`name`,`permission`,`timer`)VALUES('$username','$code','$name','管理者','60')");
                    }else{
                        query($db,"INSERT INTO `user`(`username`,`code`,`name`,`permission`,`timer`)VALUES('$username','$code','$name','一般使用者','60')");
                    }
                    $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                    $number=str_pad($row[0]-1,4,"0",STR_PAD_LEFT);
                    query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                    ?><script>alert("新增成功");location.href="admin.php"</script><?php
                }
            }
        }

        if(isset($_GET["edit"])){
            $_SESSION["edit"]=$_GET["edit"];
            header("location:edit.php");
        }
        
        if(isset($_GET["del"])){
            $_SESSION["del"]=$_GET["del"];
            header("location:edit.php");
        }

        if(isset($_SESSION["del"])){
            $number=$_SESSION["del"];
            query($db,"DELETE FROM `user` WHERE `number`='$number'");
            ?><script>alert("刪除成功");location.href="admin.php"</script><?php
        }

        if(isset($_GET["es"])){
            $number=$_GET["number"];
            $username=$_GET["username"];
            $name=$_GET["name"];
            $code=$_GET["code"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
            if(block($username)||block($code)||block($name)){
                ?><script>alert("帳密姓名不得有特殊字元");location.href="edit.php"</script><?php
            }else{
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
                    ?><script>alert("修改成功");location.href="admin.php"</script><?php
                }
            }
        }
    ?>
</body>
</html>