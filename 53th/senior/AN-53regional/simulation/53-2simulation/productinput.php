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
            width: 75%;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
    ?>
    <h1>咖啡商品展示系統</h1>
    <input type="button" class="but" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="but selt" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
    <hr>
    <input type="button" class="but" onclick="location.href='productindex.php'" value="選擇版型">
    <input type="button" class="but selt" onclick="location.href='productinput.php'" value="填寫資料">
    <input type="button" class="but" onclick="location.href='productperview.php'" value="預覽">
    <input type="button" class="but" onclick="location.href='productsubmit.php'" value="確定送出">
    <input type="button" class="but" onclick="location.href='productindex.php?clear='" value="取消">
    <br><br>
    <div class="main">
        <h2>填寫資料</h2>
    </div>
    <?php
    ?>
</body>
</html>