<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
    <style>
        h1{
            margin-top: 250px;
        }
        .main{
            width: 25%;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(isset($_SESSION["data"])){ header("location:main.php"); }
    ?>
    <h1>咖啡商品管理系統</h1>
    <hr><br><br>
    <div class="main">
        連續誤錯3次<br>
        <input type="button" onclick="location.href='index.php'" value="返回">
    </div>
    <script src="verifycode.js"></script>
</body>
</html>