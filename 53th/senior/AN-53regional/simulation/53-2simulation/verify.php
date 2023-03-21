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
            width: 25%;
        }
        table{
            width: 80px;
            margin: 0px auto;
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
        <p>點選方塊來連成水平或垂直線</p>
        <table>
            <tr>
                <td class="vertd"></td>
                <td class="vertd"></td>
            </tr>
            <tr>
                <td class="vertd"></td>
                <td class="vertd"></td>
            </tr>
        </table><br>
        <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
        <input type="button" class="but" onclick="location.reload()" value="重設">
        <input type="button" class="but" onclick="check()" value="確定">
    </div>
    <script src="verify.js"></script>
</body>
</html>