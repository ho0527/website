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
            <div class="head">
                <div class="title">咖啡商品展示系統-編輯版型</div>
                <div class="hbutdiv">
                    <input type="button" class="hbut" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="hbut selt" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbut" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
                    <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                </div>
            </div>
            <div class="main">
                <form id="form" method="POST" enctype="multipart/form-data">
                    商品id: <input type="text" name="id" value="<?= @$row[0] ?>" readonly><br>
                    商品名稱: <input type="text" name="name" value="<?= @$row[2] ?>"><br>
                    費用: <input type="text" name="cost" value="<?= @$row[3] ?>"><br>
                    相關連結: <input type="text" name="link" value="<?= @$row[4] ?>"><br>
                    商品簡介: <textarea name="intr" cols="30" rows="3"><?= @$row[6] ?></textarea><br>
                    圖片: <input type="file" name="picture" style="width:175px;"><br>
                    版型: <input type="text" name="val" value="<?= @$row[7] ?>"><br>
                    <input type="button" onclick="location.href='main.php'" value="清除">
                    <input type="submit" name="pedits" value="送出">
                </form>
            </div>
            <?php
        }
        if(isset($_POST["pedits"])){
            $name=$_POST["name"];
            $cost=$_POST["cost"];
            $link=$_POST["link"];
            $intr=$_POST["intr"];
            $val=$_POST["val"];
            $id=$_POST["id"];
            if(!empty($_FILES["picture"]["name"])){
                move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                $picture="image/".$_FILES["picture"]["name"];
                query($db,"UPDATE `coffee` SET `name`='$name',`cost`='$cost',`link`='$link',`intr`='$intr',`val`='$val',`picture`='$picture' WHERE `id`='$id'");
            }else{
                query($db,"UPDATE `coffee` SET `name`='$name',`cost`='$cost',`link`='$link',`intr`='$intr',`val`='$val' WHERE `id`='$id'");
            }
            ?><script>alert("修改成功");location.href="main.php"</script><?php
        }
    ?>
</body>
</html>