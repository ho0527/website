<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if(isset($_GET["pedit"])){
            $number=$_GET["pedit"];
            $row=fetch(query($db,"SELECT*FROM `coffee` WHERE `id`='$number'"));
            ?>
            <div class="head">
                <form action="">
                    <div class="title">咖啡商品展示系統-編輯版型</div>
                    <div class="hbut">
                        <input type="button" class="headbut" onclick="location.href='edit.php'" value="編輯使用者">
                        <input type="button" class="headbut selt" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="headbut" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="headbut" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="headbut" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="headbut" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <div class="main">
                <form id="form" method="POST" enctype="multipart/form-data">
                    編號: <input type="text" name="number" value="<?= $row[0] ?>" readonly><br>
                    商品名稱: <input type="text" name="name" value="<?= @$row[2] ?>"><br>
                    費用: <input type="text" name="cost" value="<?= @$row[4] ?>"><br>
                    相關連結: <input type="text" name="link" value="<?= @$row[3] ?>"><br>
                    商品簡介: <textarea name="intr" cols="30" rows="3"><?= @$row[6] ?></textarea><br>
                    <input type="file" name="picture" style="width:175px;"><br>
                    版型: <input type="text" name="val" value="<?= @$row[7] ?>"><br>
                    <input type="button" onclick="location.href='main.php'" value="取消">
                    <input type="button" onclick="location.reload()" value="重設">
                    <input type="submit" name="peditsubmit" value="送出">
                </form>
            </div>
            <?php
        }elseif(isset($_GET["edit"])){
            $number=$_GET["edit"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"));
            ?>
            <div class="head">
                <form action="">
                    <div class="title">咖啡商品展示系統-編輯使用者</div>
                    <div class="hbut">
                        <input type="button" class="headbut selt" onclick="location.href='edit.php'" value="編輯使用者">
                        <input type="button" class="headbut" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="headbut" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="headbut" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="headbut" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="headbut" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <div class="main">
                <form action="">
                    姓名: <input type="text" name="number" value="<?= $row[1] ?>"><br>
                    姓名: <input type="text" name="name" value="<?= $row[4] ?>"><br>
                    帳號: <input type="text" name="username" value="<?= $row[2] ?>"><br>
                    密碼: <input type="text" name="code" value="<?= $row[3] ?>"><br>
                    <?php
                        if($row[5]=="管理者"){
                            ?>
                            管理員權限 <input type="checkbox" name="admin" checked>
                            <?php
                        }else{
                            ?>
                            管理員權限 <input type="checkbox" name="admin">
                            <?php
                        }
                    ?>
                    <input type="button" onclick="location.href='main.php'" value="取消">
                    <input type="button" onclick="location.reload()" value="重設">
                    <input type="submit" name="editsubmit" value="送出">
                </form>
            </div>
            <?php
        }else{
            ?>
            <div class="head">
                <form action="">
                    <div class="title">咖啡商品展示系統-新增使用者</div>
                    <div class="hbut">
                        <input type="button" class="headbut selt" onclick="location.href='edit.php'" value="新增使用者">
                        <input type="button" class="headbut" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="headbut" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="headbut" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="headbut" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="headbut" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <div class="main">
                <form action="">
                    姓名: <input type="text" name="name"><br>
                    帳號: <input type="text" name="username"><br>
                    密碼: <input type="text" name="code"><br>
                    管理員權限 <input type="checkbox" name="admin">
                    <input type="button" onclick="location.href='main.php'" value="取消">
                    <input type="button" onclick="location.reload()" value="重設">
                    <input type="submit" name="new" value="送出">
                </form>
            </div>
            <?php
        }
        if(isset($_POST["peditsubmit"])){
            $number=$_POST["number"];
            $name=$_POST["name"];
            $cost=$_POST["cost"];
            $link=$_POST["link"];
            $intr=$_POST["intr"];
            $val=$_POST["val"];
            if(!empty($_FILES["picture"]["name"])){
                move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                $picture="image/".$_FILES["picture"]["name"];
                query($db,"UPDATE `coffee` SET `name`='$name',`cost`='$cost',`link`='$link',`intr`='$intr',`picture`='$picture',`product`='$val' WHERE `id`='$number'");
            }else{
                query($db,"UPDATE `coffee` SET `name`='$name',`cost`='$cost',`link`='$link',`intr`='$intr',`product`='$val' WHERE `id`='$number'");
            }
            ?><script>alert("完成");location.href="main.php"</script><?php
        }
        if(isset($_GET["new"])){
            $username=$_GET["username"];
            $code=$_GET["code"];
            $name=$_GET["name"];
            if($username==""||$code==""){
                ?><script>alert("請輸入帳密");location.href="edit.php"</script><?php
            }elseif($row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"))){
                ?><script>alert("帳號已被註冊");location.href="edit.php"</script><?php
            }else{
                if($_GET["admin"]){
                    query($db,"INSERT INTO `user`(`number`, `username`, `password`, `name`, `permission`) VALUES ('','$username','$code','$name','管理者')");
                }else{
                    query($db,"INSERT INTO `user`(`number`, `username`, `password`, `name`, `permission`) VALUES ('','$username','$code','$name','一般使用者')");
                }
                $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                $number=str_pad($row[0]-1,4,"0",STR_PAD_LEFT);
                query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                ?><script>alert("新增成功");location.href="main.php"</script><?php
            }
        }
        if(isset($_GET["editsubmit"])){
            $number=$_GET["number"];
            $username=$_GET["username"];
            $code=$_GET["code"];
            $name=$_GET["name"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
            if($username==""||$code==""){
                ?><script>alert("請輸入帳密");location.href="admin.php"</script><?php
            }elseif($row&&$row[4]!=$number){
                ?><script>alert("帳號已被註冊");location.href="admin.php"</script><?php
            }else{
                if($_GET["admin"]){
                    query($db,"UPDATE `user` SET `username`='$username',`password`='$code',`name`='$name',`permission`='管理者' WHERE `number`='$number'");
                }else{
                    query($db,"UPDATE `user` SET `username`='$username',`password`='$code',`name`='$name',`permission`='一般使用者' WHERE `number`='$number'");
                }
                ?><script>alert("更改成功");location.href="admin.php"</script><?php
            }
        }
    ?>
</body>
</html>