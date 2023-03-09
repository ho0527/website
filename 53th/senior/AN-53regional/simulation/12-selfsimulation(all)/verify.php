<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>第二層驗證</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 20%;
        }
        table{
            display: inline-block;
            width: auto;
        }
        h1{
            margin-top: 200px;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <h1>咖啡商品展示系統</h1>
    <hr>
    <div class="main">
        <h2>第二層驗證</h2>
        <p>請連成垂直或水平線</p>
        <table class="mag">
            <tr>
                <td class="verifytd"></td>
                <td class="verifytd"></td>
            </tr>
            <tr>
                <td class="verifytd"></td>
                <td class="verifytd"></td>
            </tr>
        </table><br>
        <input type="button" class="mainbutton" onclick="location.href='link.php?logout='" value="登出">
        <input type="button" class="mainbutton" onclick="location.reload()" value="重設">
        <input type="button" class="mainbutton" onclick="check()" value="確定">
    </div>
    <script src="verify.js"></script>
</body>
</html>