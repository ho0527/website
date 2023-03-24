<!DOCTYPE html>
<html>
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
            if(isset($_SESSION["data"])){ header("location:verify.php"); }
        ?>
        <h1>咖啡商品展示系統</h1><hr>
        <div class="main">
            <h2>登入失敗</h2>
            <p>登入連續誤錯3次</p>
            <input type="button" class="but" onclick="location.href='index.php'" value="返回">
        </div>
    </body>
</html>