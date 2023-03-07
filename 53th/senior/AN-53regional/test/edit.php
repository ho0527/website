<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>網站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if(isset($_GET["pedit"])){
            $id=$_GET["pedit"];
            $row=fetch(query($db,"SELECT*FROM `coffee` WHERE `id`='$id'"))
            ?>
            <div class="div">
                <div class="head">
                    <div class="title">咖啡商品展示系統-編輯版型</div>
                    <div class="but">
                        <input type="button" class="hbut" onclick="location.href='edit.php'" value="新增使用者">
                        <input type="button" class="hbut selt" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="hbut" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
                        <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                    </div>
                </div>
            </div>
            <div class="maindiv">
                <div class="main">
                    <form id="form" method="post" enctype="multipart/form-data">
                        商品id: <input type="text" name="id" value="<?= @$row[0] ?>" readonly><br>
                        商品名稱: <input type="text" name="name" value="<?= @$row[2] ?>"><br>
                        費用: <input type="text" name="cost" value="<?= @ $row[3]?>"><br>
                        相關連結: <input type="text" name="link" value="<?= @$row[4] ?>"><br>
                        商品簡介: <textarea name="intr" cols="30" rows="3"><?= @$row[6] ?></textarea><br>
                        照片: <input type="file" name="picture" style="width:175px;"><br>
                        版型: <input type="text" name="val" value="<?= $row[7] ?>">
                        <input type="button" onclick="location.reload()" value="重設">
                        <input type="submit" name="psubmit" value="送出">
                    </form>
                </div>
            </div>
            <?php
        }elseif(isset($_GET["edit"])){
            $number=$_GET["edit"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"));
            ?>
            <div class="div">
                <div class="head">
                    <div class="title">咖啡商品展示系統-編輯使用者</div>
                    <div class="but">
                        <input type="button" class="hbut selt" onclick="location.href='edit.php'" value="編輯使用者">
                        <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="hbut" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
                        <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                    </div>
                </div>
            </div>
            <div class="maindiv">
                <div class="main">
                    <form>
                        編號: <input type="text" name="number" value="<?= $row[1] ?>" readonly><br>
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
                        <input type="button" onclick="location.href='admin.php'" value="返回">
                        <input type="submit" name="editsubmit" value="送出">
                    </form>
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class="div">
                <div class="head">
                    <div class="title">咖啡商品展示系統-新增使用者</div>
                    <div class="but">
                        <input type="button" class="hbut selt" onclick="location.href='edit.php'" value="新增使用者">
                        <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="hbut" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
                        <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                    </div>
                </div>
            </div>
            <div class="maindiv">
                <div class="main">
                    <form>
                        姓名: <input type="text" name="name"><br>
                        帳號: <input type="text" name="username"><br>
                        密碼: <input type="text" name="code"><br>
                        管理員權限 <input type="checkbox" name="admin">
                        <input type="button" onclick="location.href='admin.php'" value="返回">
                        <input type="submit" name="newsubmit" value="送出">
                    </form>
                </div>
            </div>
            <?php
        }
        if(isset($_GET["newsubmit"])){
            $name=$_GET["name"];
            $username=$_GET["username"];
            $code=$_GET["code"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
            if($name==""||$code==""){
                ?><script>alert("請輸入帳/密");location.href="edit.php"</script><?php
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
                query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'")
                ?><script>alert("新增成功");location.href="admin.php"</script><?php
            }
        }
        if(isset($_GET["editsubmit"])){
            $number=$_GET["number"];
            $name=$_GET["name"];
            $username=$_GET["username"];
            $code=$_GET["code"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"));
            if($name==""||$code==""){
                ?><script>alert("請輸入帳/密");location.href="edit.php"</script><?php
            }elseif($row&&$row[1]!=$number){
                ?><script>alert("帳號已被註冊");location.href="edit.php"</script><?php
            }else{
                if(isset($_GET["admin"])){
                    query($db,"UPDATE `user` SET `username`='$username',`code`='$code',`name`='$name',`permission`='管理者' WHERE `number`='$number'");
                }else{
                    query($db,"UPDATE `user` SET `username`='$username',`code`='$code',`name`='$name',`permission`='一般使用者' WHERE `number`='$number'");
                }
                ?><script>alert("更改成功");location.href="admin.php"</script><?php
            }
        }
        if(isset($_POST["psubmit"])){
            $name=$_POST["name"];
            $cost=$_POST["cost"];
            $link=$_POST["link"];
            $intr=$_POST["intr"];
            $val=$_POST["val"];
            $id=$_POST["id"];
            if(!empty($_FILES["picture"]["name"])){
                move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                $picture="image/".$_FILES["picture"]["name"];
                query($db,"UPDATE `coffee` SET  `name`='$name',`cost`='$cost',`link`='$link',`intr`='$intr',`val`='$val',`picture`='$picture' WHERE `id`='$id'");
            }else{
                query($db,"UPDATE `coffee` SET  `name`='$name',`cost`='$cost',`link`='$link',`intr`='$intr',`val`='$val' WHERE `id`='$id'");
            }
            ?><script>alert("修改成功");location.href="main.php"</script><?php
        }
    ?>
</body>
</html>