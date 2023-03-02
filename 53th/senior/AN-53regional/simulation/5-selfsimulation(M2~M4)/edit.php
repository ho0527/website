<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>網站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if(isset($_GET["edit"])){
            $number=$_GET["edit"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"));
            ?>
            <div class="headbut">
                <div class="title">咖啡商品管理系統-編輯使用者</div>
                <div class="but">
                    <input type="button" class="hbut selt" onclick="location.href='edit.php'" value="編輯使用者">
                    <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbut" onclick="location.href=''" value="上架商品">
                    <input type="button" class="hbut" onclick="location.href=''" value="查詢">
                    <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
                    <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                </div>
            </div>
            <div class="main">
                <form action="">
                    邊號: <input type="text" name="number" id="name" value="<?= $row[4] ?>"><br>
                    姓名: <input type="text" name="name" id="name" value="<?= $row[3] ?>"><br>
                    帳號: <input type="text" name="username" id="username" value="<?= $row[1] ?>"><br>
                    密碼: <input type="text" name="code" id="code"  value="<?= $row[2] ?>"><br>
                    <?php
                    if($row[5]=="管理者"){
                        ?>
                        管理員權限 <input type="checkbox" name="admin" id="" checked>
                        <?php
                    }else{
                        ?>
                        管理員權限 <input type="checkbox" name="admin" id="">
                        <?php
                    }
                    ?>
                    <input type="button" onclick="location.href='admin.php'" value="取消">
                    <input type="submit" name="es" value="送出">
                </form>
            </div>
            <?php
        }else{
            ?>
            <div class="headbut">
                <div class="title">咖啡商品管理系統-新增使用者</div>
                <div class="but">
                    <input type="button" class="hbut selt" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbut" onclick="location.href=''" value="上架商品">
                    <input type="button" class="hbut" onclick="location.href=''" value="查詢">
                    <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
                    <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                </div>
            </div>
            <div class="main">
                <form action="">
                    姓名: <input type="text" name="name" id="name"><br>
                    帳號: <input type="text" name="username" id="username"><br>
                    密碼: <input type="text" name="code" id="code" ><br>
                    管理員權限 <input type="checkbox" name="admin" id="">
                    <input type="button" onclick="location.href='admin.php'" value="取消">
                    <input type="submit" name="news" value="送出">
                </form>
            </div>
            <?php
        }
        if(isset($_GET["news"])){
            $name=$_GET["name"];
            $username=$_GET["username"];
            $code=$_GET["code"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
            if($username==""||$code==""){
                ?><script>alert("請輸入帳密");location.href="edit.php"</script><?php
            }elseif($row){
                ?><script>alert("帳號已被註冊");location.href="edit.php"</script><?php
            }else{
                if(isset($_GET["admin"])){
                    query($db,"INSERT INTO `user`(`username`,`password`,`name`,`permission`)VALUES('$username','$code','$name','管理者')");
                }else{
                    query($db,"INSERT INTO `user`(`username`,`password`,`name`,`permission`)VALUES('$username','$code','$name','一般使用者')");
                }
                $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                $number=str_pad($row[0]-1,4,"0",STR_PAD_LEFT);
                query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                ?><script>alert("新增成功");location.href="admin.php"</script><?php
            }
        }
        if(isset($_GET["es"])){
            $number=$_GET["number"];
            $name=$_GET["name"];
            $username=$_GET["username"];
            $code=$_GET["code"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
            if($username==""||$code==""){
                ?><script>alert("請輸入帳密");location.href="admin.php"</script><?php
            }elseif($row&&$row[4]!=$number){
                ?><script>alert("帳號已被註冊");location.href="admin.php"</script><?php
            }else{
                if(isset($_GET["admin"])){
                    query($db,"UPDATE `user` SET `username`='$username',`name`='$name',`password`='$code',`permission`='管理者' WHERE `number`='$number'");
                }else{
                    query($db,"UPDATE `user` SET `username`='$username',`name`='$name',`password`='$code',`permission`='一般使用者' WHERE `number`='$number'");
                }
                ?><script>alert("更改成功");location.href="admin.php"</script><?php
            }
        }
        if(isset($_GET["del"])){
            $number=$_GET["del"];
            $row=fetch(query($db,"DELETE FROM `user` WHERE `number`='$number'"));
            ?><script>alert("刪除成功");location.href="admin.php"</script><?php
        }
    ?>

</body>
</html>