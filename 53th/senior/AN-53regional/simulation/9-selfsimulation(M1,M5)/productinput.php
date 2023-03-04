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
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <div class="head">
        <div class="title">咖啡商品展示系統-選擇版型</div>
        <div class="hbutdiv">
            <input type="button" class="hbut" onclick="" value="新增使用者">
            <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="hbut selt" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="hbut" onclick="" value="會員管理">
            <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
        </div>
    </div>
    <div class="pbut">
        <input type="button" class="hbut" onclick="location.href='productindex.php'" value="選擇版型">
        <input type="button" class="hbut selt" onclick="location.href='productinput.php'" value="填寫資料">
        <input type="button" class="hbut" onclick="sub()" value="預覽">
        <input type="button" class="hbut" onclick="nono()" value="確定送出">
        <div style="float:right;">
            <input type="button" class="hbut" onclick="location.href='newproduct.php'" value="新增版型">
        </div>
    </div>
    <div class="main">
        <form id="form" method="POST" enctype="multipart/form-data">
            商品名稱: <input type="text" name="name" value="<?= @$_SESSION["name"] ?>"><br>
            費用: <input type="text" name="cost" value="<?= @$_SESSION["cost"] ?>"><br>
            相關連結: <input type="text" name="link" value="<?= @$_SESSION["link"] ?>"><br>
            商品簡介: <textarea name="intr" cols="30" rows="3"><?= @$_SESSION["intr"] ?></textarea><br>
            圖片: <input type="file" name="picture" style="width:175px;"><br>
            <input type="submit" name="clear" value="清除">
            <input type="submit" name="submit" value="送出">
        </form>
    </div>
    <?php
        if(isset($_POST["submit"])){
            $_SESSION["name"]=$_POST["name"];
            $_SESSION["cost"]=$_POST["cost"];
            $_SESSION["link"]=$_POST["link"];
            $_SESSION["intr"]=$_POST["intr"];
            if(!empty($_FILES["picture"]["name"])){
                move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                $_SESSION["picture"]="image/".$_FILES["picture"]["name"];
            }
            ?><script>alert("送出成功");location.href="productpreview.php"</script><?php
        }
        if(isset($_POST["clear"])){
            unset($_SESSION["picture"]);
            unset($_SESSION["name"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["link"]);
            unset($_SESSION["intr"]);
            ?><script>location.href="productinput.php"</script><?php
        }
        if(isset($_GET["val"])){
            if($_GET["val"]=="no"){
                if(!isset($_SESSION["val"])){
                    ?><script>alert("請先選擇版型");location.href="productindex.php"</script><?php
                }
            }else{
                $_SESSION["val"]=$_GET["val"];
            }
        }
    ?>
    <script src="product.js"></script>
   </body>
</html>


