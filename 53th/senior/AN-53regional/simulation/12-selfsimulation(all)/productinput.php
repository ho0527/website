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
            width: 20%;
            max-height: 400px;
            overflow-y: auto;
        }
        table{
            display: inline-block;
            width: auto;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <h1>咖啡商品展示系統</h1>
    <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="mainbutton selt" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="mainbutton" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查尋">
    <input type="button" class="mainbutton logout" onclick="location.href='link.php?logout='" value="登出">
    <hr>
    <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="選擇版型">
    <input type="button" class="mainbutton selt" onclick="location.href='productinput.php'" value="填寫資料">
    <input type="button" class="mainbutton" onclick="sub()" value="預覽">
    <input type="button" class="mainbutton" onclick="sub()" value="確定送出">
    <div class="mag"></div>
    <div class="main">
        <h2>填寫資料</h2>
        <form id="form" method="post" enctype="multipart/form-data">
            商品名稱: <input type="text" name="name" value="<?= @$_SESSION["name"] ?>"><br><br>
            費用: <input type="text" name="cost" value="<?= @$_SESSION["cost"] ?>"><br><br>
            相關連結: <input type="text" name="link" value="<?= @$_SESSION["link"] ?>"><br><br>
            商品簡介: <input type="text" name="intr" value="<?= @$_SESSION["intr"] ?>"><br><br>
            圖片 <input type="file" name="picture" style="width:175px"><br><br>
            <input type="submit" class="mainbutton" name="clear" value="清除">
            <input type="submit" class="mainbutton" name="submit" value="送出">
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
            ?><script>alert("新增成功");location.href="productpreview.php"</script><?php
        }

        if(isset($_POST["clear"])){
            unset($_SESSION["name"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["link"]);
            unset($_SESSION["intr"]);
            unset($_SESSION["picture"]);
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