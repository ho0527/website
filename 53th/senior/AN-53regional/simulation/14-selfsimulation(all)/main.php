<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>登入失敗</title>
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
            if(isset($_SESSION["data"])){ header("main.php"); }
        ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="button selt" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <div class="main">
            
        </div>
    </body>
</html>