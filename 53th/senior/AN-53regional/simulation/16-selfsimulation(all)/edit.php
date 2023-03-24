<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if(isset($_SESSION["pedit"])){
            $id=$_SESSION["pedit"];
            $row=fetch(query($db,"SELECT*FROM `coffee` WHERE `id`='$id'"))
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="but selt" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="but" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <form id="form" method="POST" enctype="multipart/form-data">
                    <h2>編輯商品</h2><br>
                    商品名稱 <input type="text" name="name" value="<?= @$row["name"] ?>"><br><br>
                    費用 <input type="text" name="cost" value="<?= @$row["cost"] ?>"><br><br>
                    相關連結<input type="text" name="link" value="<?= @$row["link"] ?>"><br><br>
                    商品簡介 <textarea name="intr" cols="25" rows="3"><?= @$row["intr"] ?></textarea><br><br>
                    圖片 <input type="file" name="picture" accept="image/*" style="width:175px;"><br>
                    已上傳: <?= $row["picturemain"] ?><br><br>
                    版型 <input type="text" name="val" value="<?= @$row["val"] ?>"><br><br>
                    <input type="button" class="but" onclick="location.href='main.php'" value="返回">
                    <input type="submit" class="but" name="ps" value="送出">
                </form>
            </div>
            <?php
        }elseif(isset($_SESSION["edit"])){
            $number=$_SESSION["edit"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"))
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="but" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="but" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="but selt" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <form>
                    <h2>編輯使用者</h2><br>
                    編號: <input type="text" name="number" value="<?= $row[1] ?>" readonly><br><br>
                    姓名: <input type="text" name="name" value="<?= $row[4] ?>"><br><br>
                    帳號: <input type="text" name="username" value="<?= $row[2] ?>"><br><br>
                    密碼: <input type="text" name="code" value="<?= $row[3] ?>"><br><br>
                    <?php
                        if($row[5]=="管理者"){
                            ?>管理員權限<input type="checkbox" name="admin" checked><?php
                        }else{
                            ?>管理員權限<input type="checkbox" name="admin"><?php
                        }
                    ?>
                    <input type="button" class="but" onclick="location.href='admin.php'" value="返回">
                    <input type="submit" class="but" name="es" value="送出">
                </form>
            </div>
            <?php
        }else{
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="but" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="but" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="but selt" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <form>
                    <h2>新增使用者</h2><br>
                    姓名: <input type="text" name="name"><br><br>
                    帳號: <input type="text" name="username"><br><br>
                    密碼: <input type="text" name="code"><br><br>
                    管理員權限<input type="checkbox" name="admin">
                    <input type="button" class="but" onclick="location.href='admin.php'" value="返回">
                    <input type="submit" class="but" name="news" value="送出">
                </form>
            </div>
            <?php
        }
    ?>
    <?php
        if(isset($_GET["news"])){
            $username=$_GET["username"];
            $name=$_GET["name"];
            $code=$_GET["code"];
            if(block($username)||block($name)||block($code)){
                ?><script>alert("禁止輸入特殊字元");location.href="edit.php"</script><?php
            }else{
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
                    $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                    $number=str_pad($row[0]-1,4,"0",STR_PAD_LEFT);
                    query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                    ?><script>alert("新增成功");location.href="admin.php"</script><?php
                }
            }
        }
        if(isset($_GET["edit"])){
            if($_GET["edit"]=="0000"){
                ?><script>alert("禁止修改管理者帳號");location.href="admin.php"</script><?php
            }else{
                $_SESSION["edit"]=$_GET["edit"];
                ?><script>location.href="edit.php"</script><?php
            }
        }
        if(isset($_GET["es"])){
            $number=$_GET["number"];
            $username=$_GET["username"];
            $name=$_GET["name"];
            $code=$_GET["code"];
            if(block($username)||block($name)||block($code)){
                ?><script>alert("禁止輸入特殊字元");location.href="edit.php"</script><?php
            }else{
                $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
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
        if(isset($_GET["del"])){
            if($_GET["del"]=="0000"){
                ?><script>alert("禁止刪除管理者帳號");location.href="admin.php"</script><?php
            }else{
                $number=$_GET["del"];
                query($db,"DELETE FROM `user` WHERE `number`='$number'");
                ?><script>alert("刪除成功");location.href="admin.php"</script><?php
            }
        }
        if(isset($_GET["pedit"])){
            $_SESSION["pedit"]=$_GET["pedit"];
            ?><script>location.href="edit.php"</script><?php
        }
        if(isset($_POST["ps"])){
            if(block($_POST["name"])||block($_POST["link"])||block($_POST["intr"])){
                ?><script>alert("禁止輸入特殊字元");location.href="edit.php"</script><?php
            }else{
                if(preg_match("/^[0-9]+(\.[0-9]+)?$/",$_POST["cost"])){
                    $val=$_POST["val"];
                    if($row=fetch(query($db,"SELECT*FROM `product` WHERE `id`='$val'"))){
                        $name=$_POST["name"];
                        $link=$_POST["link"];
                        $cost=$_POST["cost"];
                        $intr=$_POST["intr"];
                        $id=$_SESSION["pedit"];
                        if(!empty($_FILES["picture"]["name"])){
                            $rand=rand(0,999999999);
                            $number=str_pad($rand,9,"0",STR_PAD_LEFT);
                            move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$number);
                            $picture="image/".$number;
                            $picturemain="image/".$_FILES["picture"]["name"];
                            query($db,"UPDATE `coffee` SET `name`='$name',`cost`='$cost',`link`='$link',`intr`='$intr',`val`='$val',`picturemain`='$picturemain',`picture`,'$picture' WHERE `id`='$id'");
                        }else{
                            query($db,"UPDATE `coffee` SET `name`='$name',`cost`='$cost',`link`='$link',`intr`='$intr',`val`='$val' WHERE `id`='$id'");
                        }
                        ?><script>alert("修改成功");location.href="main.php"</script><?php
                    }else{
                        ?><script>alert("無效版型");location.href="edit.php"</script><?php
                    }
                }else{
                    ?><script>alert("無效費用");location.href="edit.php"</script><?php
                }
            }
        }
    ?>
</body>
</html>