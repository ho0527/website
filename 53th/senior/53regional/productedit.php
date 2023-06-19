<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>管理者專區</title>
      <link rel="stylesheet" href="index.css">
   </head>
   <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
            if(isset($_GET["id"])){
                $_SESSION["id"]=$_GET["id"];
            }
            $id=$_SESSION["id"];
            $row=query($db,"SELECT*FROM `coffee` WHERE `id`='$id'");
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">咖啡商品展示系統-編輯商品</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查詢">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
            </div>
        </div>
        <div class="main">
            <form id="form" enctype="multipart/form-data">
                商品名稱: <input type="text" class="input" name="name" value="<?= @$row[2] ?>"><br>
                費用: <input type="number" class="input" name="cost" placeholder="只能是數字" value="<?= @$row[4] ?>"><br>
                相關連結: <input type="text" class="input" name="link" placeholder="" value="<?= @$row[6] ?>"><br>
                <textarea name="introduction" cols="30" rows="2" placeholder="商品簡介"><?= @$row[3] ?></textarea><br>
                <input type="file" name="picture" accept="image/*" style="width:200px" value="上傳圖片"><br>
                版型: <input type="text" class="input" name="val" placeholder="1or2" value="<?= @$row[7] ?>"><br>
                <input type="button" onclick="location.href='productedit.php'" class="button" value="重設">
                <input type="button" onclick="location.href='main.php'" class="button" value="返回">
                <input type="submit" class="button" name="submit" value="完成"><br>
            </form>
        </div>
        <?php
            if(isset($_GET["submit"])){
                @$name=$_GET["name"];
                @$introduction=$_GET["introduction"];
                @$cost=$_GET["cost"];
                @$link=$_GET["link"];
                @$picture=$_GET["picture"];
                @$val=$_GET["val"];
                if($name==""){
                    ?><script>alert("請輸入商品!");location.href="productedit.php"</script><?php
                }else{
                    if(!empty($_FILES["picture"]["name"])){
                        move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                        $picture="image/".$_FILES["picture"]["name"];
                        query($db,"UPDATE `coffee` SET `picture`='$picture',`name`='$name',`introduction`='$introduction',`cost`='$cost',`link`='$link',`version`='$val' WHERE `id`='$id'");
                    }else{
                        query($db,"UPDATE `coffee` SET `name`='$name',`introduction`='$introduction',`cost`='$cost',`link`='$link',`version`='$val' WHERE `id`='$id'");
                    }
                    ?><script>alert("修改完成!");location.href="main.php"</script><?php
                }
            }
        ?>
   </body>
</html>