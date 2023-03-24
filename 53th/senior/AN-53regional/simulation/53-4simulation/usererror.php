<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>網站前台登入頁面</title>
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
        if(isset($_SESSION["data"])){ header("location:verify.php"); }
    ?>
    <h1>咖啡商品展示系統</h1>
    <hr>
    <div class="main">
        <h2>登入失敗</h2>
        <p>連續誤錯3次</p>
        <input type="button" onclick="location.href='index.php'" value="返回">
    </div>
    <script src="verifycode.js"></script>
</body>
</html>