<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if($_GET["id"]){
            $id=$_GET["id"];
            $row=fetch(query($db,"SELECT*FROM `coffee` WHERE `id`='$id'"));
            ?>
            <div class="header">
                <form class="headerform">
                    <div class="headtitle">咖啡商品展示系統-編輯商品</div>
                    <div class="headbut">
                        <input type="button" class="hbutton" onclick="location.href='signupedit.php'" value="新增">
                        <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="hbutton selectbut" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="hbutton" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="hbutton" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <div class="maindiv">
                <form id="form" method="post" enctype="multipart/form-data">
                    商品名稱: <input type="input" name="name" value="<?= @$row["name"] ?>"><br>
                    費 用: <input type="input" name="cost" value="<?= @$row["cost"] ?>"><br>
                    相關連結: <input type="input" name="link" value="<?= @$row["link"] ?>"><br>
                    商品簡介: <textarea name="intr" cols="30" rows="3"></textarea><br>
                    <input type="file" name="picture"><br>
                    版型: <input type="input" name="link" value="<?= @$row["link"] ?>"><br>
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="submit" name="submit" value="返回">
                    <input type="submit" name="submit" value="送出">
                </form>
            </div>
            <?php
        }
        if(isset($_POST["submit"])){
            if($_POST["submit"]=="送出"){
                $name=$_POST["name"];
                $link=$_POST["link"];
                $cost=$_POST["cost"];
                $intr=$_POST["intr"];
                $val=$_POST["val"];
                $id=$_POST["id"];
                if(!empty($_FILES["pictures"]["tmp_ name"])){
                    move_uploaded_file($_FILES["pictures"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                    $picture="image/".$_FILES["picture"]["name"];
                }
                query($db,"UPDATE `coffee` SET `picture`='$picture', `name`='$name', `introduction`='$intr', `cost`='$cost',`link`='$link', `version`='$val' WHERE `id`='$id')");
            }
        }
    ?>
</body>
</html>