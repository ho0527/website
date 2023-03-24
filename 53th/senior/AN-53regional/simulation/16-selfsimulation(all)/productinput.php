<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if(!isset($_SESSION["picturemain"])){ $_SESSION["picture"]="無"; }
    ?>
    <h1>咖啡商品展示系統</h1>
    <input type="button" class="but" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="but selt" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
    <hr>
    <input type="button" class="but" onclick="location.href='productindex.php'" value="選擇版型">
    <input type="button" class="but selt" onclick="location.href='productinput.php'" value="填寫資料">
    <input type="button" class="but" onclick="sub()" value="預覽">
    <input type="button" class="but" onclick="location.href='productsubmit.php'" value="確定送出"><br><br>
    <div class="main">
        <h2>填寫資料</h2>
        <form method="POST" id="form" enctype="multipart/form-data">
            商品名稱: <input type="text" name="name" value="<?= @$_SESSION["name"] ?>"><br><br>
            費用: <input type="text" name="cost" value="<?= @$_SESSION["cost"] ?>"><br><br>
            相關連結: <input type="text" name="link" value="<?= @$_SESSION["link"] ?>"><br><br>
            商品簡介: <textarea name="intr" id="" cols="25" rows="3"><?= @$_SESSION["intr"] ?></textarea><br><br>
            圖片: <input type="file" name="picture" accpct="image/*"><br><br>
            已上傳: <?= @$_SESSION["picture"] ?><br><br>
            <input type="submit" name="clear" value="重設">
            <input type="submit" name="submit" value="送出">
        </form>
    </div>
    <?php
        if(isset($_POST["submit"])){
            $_SESSION["name"]=$_POST["name"];
            $_SESSION["cost"]=$_POST["cost"];
            $_SESSION["link"]=$_POST["link"];
            $_SESSION["intr"]=$_POST["intr"];
            if(block($_POST["name"])||block($_POST["link"])||block($_POST["intr"])){
                ?><script>alert("禁止輸入特殊字元");location.href="productinput.php"</script><?php
            }else{
                if(!empty($_FILES["picture"]["name"])){
                    $rand=rand(0,999999999);
                    $number=str_pad($rand,9,"0",STR_PAD_LEFT);
                    move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$number);
                    $_SESSION["picture"]="image/".$number;
                    $_SESSION["picturemain"]="image/".$_FILES["picture"]["name"];
                }
                $_SESSION["name"]=$_POST["name"];
                $_SESSION["cost"]=$_POST["cost"];
                $_SESSION["link"]=$_POST["link"];
                $_SESSION["intr"]=$_POST["intr"];
                ?><script>location.href="productperview.php"</script><?php
            }
        }
        if(isset($_POST["clear"])){
            unset($_SESSION["name"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["link"]);
            unset($_SESSION["intr"]);
            unset($_SESSION["val"]);
            unset($_SESSION["picture"]);
            unset($_SESSION["picturemain"]);
            ?><script>location.href="productindex.php"</script><?php
        }
        if(isset($_GET["val"])){
            $_SESSION["val"]=$_GET["val"];
            ?><script>location.href="productinput.php"</script><?php
        }
    ?>
    <script src="product.js"></script>
</body>
</html>