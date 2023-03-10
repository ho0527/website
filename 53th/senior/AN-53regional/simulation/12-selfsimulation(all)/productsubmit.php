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
            font-size: 20px;
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
    <input type="button" class="mainbutton" onclick="location.href='productinput.php'" value="填寫資料">
    <input type="button" class="mainbutton" onclick="location.href='productpreview.php'" value="預覽">
    <input type="button" class="mainbutton selt" onclick="location.href='productsubmit.php'" value="確定送出">
    <div class="mag"></div>
    <div class="main">
        <form action="">
            <h2>確定送出</h2>
            請您再次確定是否要送出<br>
            <input type="submit" class="mainbutton" name="submit" value="取消">
            <input type="submit" class="mainbutton" name="submit" value="確定">
        </form>
    </div>
    <?php
        if(isset($_GET["submit"])){
            if($_GET["submit"]=="確定"){
                $name=$_SESSION["name"];
                $cost=$_SESSION["cost"];
                $link=$_SESSION["link"];
                $intr=$_SESSION["intr"];
                $picture=$_SESSION["picture"];
                $val=$_SESSION["val"];
                query($db,"INSERT INTO `coffee`(`name`,`cost`,`link`,`intr`,`picture`,`date`,`val`)VALUES('$name','$cost','$link','$intr','$picture','$time','$val')");
            }
            unset($_SESSION["name"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["link"]);
            unset($_SESSION["intr"]);
            unset($_SESSION["picture"]);
            unset($_SESSION["val"]);
            ?><script>alert("完成");location.href="main.php"</script><?php
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