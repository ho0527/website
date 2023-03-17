<!DOCTYPE html>
<html lang="en">
    <head>
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
            if(isset($_SESSION["data"])){ header("main.php"); }
            if(isset($_SESSION["pedit"])){
                $number=$_SESSION["pedit"];
                $row=fetch(query($db,"SELECT*FROM `coffee` WHERE `id`='$number'"));
                ?>
                <h1>咖啡商品展示系統</h1>
                <input type="button" class="button" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="button selt" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
                <hr>
                <div class="main">
                    <form id="form" method="POST" enctype="multipart/form-data">
                        <h2>修改商品</h2>
                        商品id <input type="text" name="id" value="<?= @$row[0] ?>" readonly><br><br>
                        商品名稱 <input type="text" name="name" value="<?= @$row["name"] ?>"><br><br>
                        費用 <input type="number" name="cost" value="<?= @$row["cost"] ?>"><br><br>
                        相關連結 <input type="text" name="link" value="<?= @$row["link"] ?>"><br><br>
                        商品簡介 <textarea name="intr" id="" cols="25" rows="3"><?= @$row["intr"] ?></textarea><br><br>
                        圖片<input type="file" name="picture" style="width:175px"><br><br>
                        已上傳:<?php
                            echo($row["picture"]);
                        ?><br><br>
                        版型(可至上架商品看板型id) <input type="text" name="val" value="<?= @$row[7] ?>"><br><br>
                        <input type="button" class="button" onclick="location.href='main.php'" value="返回">
                        <input type="submit" class="button" name="ps" value="送出">
                    </form>
                </div>
                <?php
            }elseif(isset($_SESSION["edit"])){
                $number=$_SESSION["edit"];
                $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"));
                ?>
                <h1>咖啡商品展示系統</h1>
                <input type="button" class="button" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="button selt" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
                <hr>
                <div class="main">
                    <form action="">
                        <h2>修改使用者</h2>
                        編號: <input type="text" name="number" value="<?= $row[1] ?>" readonly><br><br>
                        姓名: <input type="text" name="name" value="<?= $row[4] ?>"><br><br>
                        帳號: <input type="text" name="username" value="<?= $row[2] ?>"><br><br>
                        密碼: <input type="text" name="code" value="<?= $row[3] ?>"><br><br>
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
                        <input type="button" class="button" onclick="location.href='admin.php'" value="返回">
                        <input type="submit" class="button" name="es" value="送出">
                    </form>
                </div>
                <?php
            }else{
                ?>
                <h1>咖啡商品展示系統</h1>
                <input type="button" class="button" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="button selt" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
                <hr>
                <div class="main">
                    <form action="">
                        <h2>新增使用者</h2>
                        姓名: <input type="text" name="name" id=""><br><br>
                        帳號: <input type="text" name="username" id=""><br><br>
                        密碼: <input type="text" name="code" id=""><br><br>
                        管理員權限 <input type="checkbox" name="admin" id="">
                        <input type="button" class="button" onclick="location.href='admin.php'" value="返回">
                        <input type="submit" class="button" name="news" value="送出">
                    </form>
                </div>
                <?php
            }
            if(isset($_GET["news"])){
                $name=$_GET["name"];
                $username=$_GET["username"];
                $code=$_GET["code"];
                if(block($username)||block($code)||block($name)){
                    ?><script>alert("禁止輸入特殊符號");location.href="edit.php"</script><?php
                }else{
                    $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
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
                if($_GET["edit"]=="0000"){
                    ?><script>alert("禁止修改管理者");location.href="admin.php"</script><?php
                }else{
                    $_SESSION["edit"]=$_GET["edit"];
                    ?><script>location.href="edit.php"</script><?php
                }
            }
            if(isset($_GET["del"])){
                if($_GET["del"]=="0000"){
                    ?><script>alert("禁止修改管理者");location.href="admin.php"</script><?php
                }else{
                    $_SESSION["del"]=$_GET["del"];
                    ?><script>location.href="edit.php"</script><?php
                }
            }
            if(isset($_SESSION["del"])){
                $number=$_SESSION["del"];
                query($db,"DELETE FROM `user` WHERE `number`='$number'");
                ?><script>alert("刪除成功");location.href="admin.php"</script><?php
            }
            if(isset($_GET["es"])){
                $number=$_GET["number"];
                $name=$_GET["name"];
                $username=$_GET["username"];
                $code=$_GET["code"];
                if(block($username)||block($code)||block($name)){
                    ?><script>alert("禁止輸入特殊符號");location.href="edit.php"</script><?php
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
            if(isset($_GET["pedit"])){
                $_SESSION["pedit"]=$_GET["pedit"];
                ?><script>location.href="edit.php"</script><?php
            }

            if(isset($_POST["ps"])){
                $id=$_POST["id"];
                $name=$_POST["name"];
                $link=$_POST["link"];
                $cost=$_POST["cost"];
                $intr=$_POST["intr"];
                $val=$_POST["val"];
                echo("in");
                if(block($name)||block($link)||block($cost)||block($intr)){
                    ?><script>alert("禁止輸入特殊符號");location.href="edit.php"</script><?php
                }elseif(!$row=fetch(query($db,"SELECT*FROM `product` WHERE `id`='$val'"))){
                    ?><script>alert("找不到此版型");location.href="edit.php"</script><?php
                }else{
                    if(!empty($_FILES["picture"]["name"])){
                        if(block($_FILES["picture"]["name"])){
                            ?><script>alert("檔名禁止輸入特殊符號");location.href="edit.php"</script><?php
                        }else{
                            move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                            $picture="image/".$_FILES["picture"]["name"];
                            query($db,"UPDATE `coffee` SET `name`='$name',`link`='link',`cost`='$cost',`intr`='$intr',`val`='$val',`picture`='$picture' WHERE `id`='$id'");
                        }
                    }else{
                        query($db,"UPDATE `coffee` SET `name`='$name',`link`='link',`cost`='$cost',`intr`='$intr',`val`='$val' WHERE `id`='$id'");
                    }
                    ?><script>alert("修改成功");location.href="main.php"</script><?php
                }
            }
        ?>
    </body>
</html>