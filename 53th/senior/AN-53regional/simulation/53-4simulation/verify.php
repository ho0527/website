<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 25%;
        }
        table{
            width: 80px;
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
        <p>請點選方塊來連成水平或垂直線</p>
        <table>
            <tr>
                <td class="verifytd"></td>
                <td class="verifytd"></td>
            </tr>
            <tr>
                <td class="verifytd"></td>
                <td class="verifytd"></td>
            </tr>
        </table><br>
        <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
        <input type="button" class="button" onclick="location.reload()" value="重設">
        <input type="button" class="button" onclick="check()" value="確定">
    </div>
    <script src="verify.js"></script>
</body>
</html>