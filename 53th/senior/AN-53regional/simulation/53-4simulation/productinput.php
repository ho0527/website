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
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:main.php"); }
        if(!isset($_SESSION["picture"])){ $_SESSION["picture"]="無"; }
        ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="button selt" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button selt" onclick="location.href='productinput.php'" value="填寫資料">
        <input type="button" class="button" onclick="sub()" value="預覽">
        <input type="button" class="button" onclick="location.href='productsubmit.php'" value="確定送出">
        <br><br>
        <div class="main">
            <h2>填寫資料</h2><br>
            <form id="form" method="POST" enctype="multipart/form-data">
                商品名稱 <input type="text" name="name" value="<?= @$_SESSION["name"] ?>"><br><br>
                費用 <input type="text" name="cost" value="<?= @$_SESSION["cost"] ?>"><br><br>
                相關連結<input type="text" name="link" value="<?= @$_SESSION["link"] ?>"><br><br>
                商品簡介 <textarea name="intr" cols="25" rows="3"><?= @$_SESSION["intr"] ?></textarea><br><br>
                圖片 <input type="file" name="picture" accept="image/*" style="width:175px;"><br>
                已上傳: <?= $_SESSION["picture"] ?><br><br>
                <input type="submit" class="button" name="clear" value="清除">
                <input type="submit" class="button" name="submit" value="送出">
            </form>
        </div>
    <?php
        if(isset($_POST["submit"])){
            if(block($_POST["name"])||block($_POST["link"])||block($_POST["intr"])){
                ?><script>alert("禁止輸入特殊字元");location.href="productinput.php"</script><?php
            }else{
                if(preg_match("/^[0-9]+(\.[0-9]+)?$/",$_POST["cost"])){
                    if(!empty($_FILES["picture"]["name"])){
                        move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                        $_SESSION["picture"]="image/".$_FILES["picture"]["name"];
                    }
                    $_SESSION["name"]=$_POST["name"];
                    $_SESSION["link"]=$_POST["link"];
                    $_SESSION["cost"]=$_POST["cost"];
                    $_SESSION["intr"]=$_POST["intr"];
                    ?><script>location.href="productperview.php"</script><?php
                }else{
                    ?><script>alert("無效費用");location.href="productinput.php"</script><?php
                }
            }
        }
        if(isset($_POST["clear"])){
            unset($_SESSION["name"]);
            unset($_SESSION["link"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["intr"]);
            unset($_SESSION["picture"]);
            unset($_SESSION["val"]);
            ?><script>location.href="productindex.php"</script><?php
        }
        if(isset($_GET["val"])){
            if($_GET["val"]=="1"||$_GET["val"]=="2"){
                $_SESSION["val"]=$_GET["val"];
            }
            ?><script>location.href="productinput.php"</script><?php
        }
    ?>
    <script src="product.js"></script>
</body>
</html>