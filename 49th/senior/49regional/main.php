<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>翻牌配對驗證模組</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="main">
            <input type="button" class="button" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
        </div>
        <script src="verify.js"></script>
    </body>
</html>