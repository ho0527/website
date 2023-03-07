<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>第二層驗證</title>
    <link rel="stylesheet" href="index.css">
    <style>
        h1{
            margin-top: 300px;
        }
        .main{
            width: 25%;
        }
        table{
            width: auto;
            margin: 0px auto;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <h1>咖啡商品管理系統</h1>
    <hr><br><br>
    <div class="main">
        <h2>第二層驗證</h2>
        <p>請連成垂直或水平線</p>
        <table>
            <tr>
                <td class="verifytd"></td>
                <td class="verifytd"></td>
            </tr>
            <tr>
                <td class="verifytd"></td>
                <td class="verifytd"></td>
            </tr>
        </table>
        <input type="button" class="button" onclick="location.href='link.php'" value="登出">
        <input type="button" class="button" onclick="location.reload()" value="重設">
        <input type="button" class="button" onclick="check()" value="送出">
    </div>
    <script src="verify.js"></script>
</body>
</html>