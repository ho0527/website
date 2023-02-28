<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewp or t" content="width=device-width, initial-scale=1.0">
    <title>上架產品精靈</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="head">
            <div class="title">咖啡商品展示系統-選擇版型</div>
            <div class="hbut">
                <form action="">
                    <input type="button" class="headbut" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="headbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="headbut selt" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="headbut" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="headbut" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="headbut" name="logout" value="登出">
                </form>
            </div>
        </div>
        <div class="pbar">
            <form action="">
                <input type="button" class="headbut" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="headbut selt" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="headbut" onclick="sub()" value="預覽">
                <input type="button" class="headbut" onclick="nono()" value="確定送出">
                <div style="float:right;">
                    <input type="button" class="headbut" onclick="location.href='newproduct.php'" value="新增版型">
                </div>
            </form>
        </div>
        <div class="main">
            <form id="form" method="POST" enctype="multipart/form-data">
                商品名稱: <input type="text" name="name" id="" value="<?= @$_SESSION["name"] ?>"><br>
                費用: <input type="text" name="cost" id="" value="<?= @$_SESSION["cost"] ?>"><br>
                相關連結: <input type="text" name="link" id="" value="<?= @$_SESSION["link"] ?>"><br>
                商品簡介: <textarea name="intr" id="" cols="30" rows="3"><?= @$_SESSION["intr"] ?></textarea><br>
                <input type="file" name="picture" id="" style="width:175px;">
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
                ?><script>alert("完成");location.href="productperview.php"</script><?php
            }
            if(isset($_POST["clear"])){
                unset($_SESSION["name"]);
                unset($_SESSION["cost"]);
                unset($_SESSION["link"]);
                unset($_SESSION["intr"]);
                unset($_SESSION["picture"]);
            }
            if(!isset($_SESSION["val"])){
                if(isset($_GET["val"])){
                    if($_GET["val"]=="no"){
                        ?><script>alert("請先選擇版型");location.href="productindex.php"</script><?php
                    }else{
                        $_SESSION["val"]=$_GET["val"];
                        ?><script>location.href="productinput.php"</script><?php
                    }
                }
                ?><script>location.href="productinput.php"</script><?php
            }
        ?>
        <script src="product.js"></script>
</body>
</html>