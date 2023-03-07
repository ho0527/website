<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品管理系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 25%;
        }
        table{
            margin: 0px auto;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <h1>咖啡商品管理系統</h1>
    <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="mainbutton selt" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="mainbutton" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查詢">
    <input type="button" class="logout" onclick="location.href='link.php?logout='" value="登出">
    <hr><br>
    <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="選擇版型">
    <input type="button" class="mainbutton selt" onclick="location.href='productinput.php'" value="填寫資料">
    <input type="button" class="mainbutton" onclick="sub()" value="預覽">
    <input type="button" class="mainbutton" onclick="sub()" value="確定送出"><br><br>
    <div class="main">
        <h2>填寫資料</h2>
        <form id="form" method="post" enctype="multipart/form-data">
            商品名稱: <input type="text" name="name"><br>
            費用: <input type="text" name="cost"><br>
            相關連結: <input type="text" name="link"><br>
            商品簡介: <input type="text" name="intr"><br>
            圖片: <input type="file" name="picture"><br>
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
            ?><script>alert("填寫成功");location.href='productperview.php'</script><?php
        }
        if(isset($_POST["clear"])){
            unset($_SESSION["name"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["link"]);
            unset($_SESSION["intr"]);
            unset($_SESSION["picture"]);
            ?><script>location.href='productperview.php'</script><?php
        }
        if(isset($_GET["val"])){
            if($_GET["val"]=="no"){
                if(!isset($_SESSION["val"])){
                    ?><script>alert("請先選擇版型");location.href='productindex.php'</script><?php
                }
            }else{
                $_SESSION["val"]=$_GET["val"];
            }
        }
    ?>
    <script src="product.js"></script>
</body>
</html>