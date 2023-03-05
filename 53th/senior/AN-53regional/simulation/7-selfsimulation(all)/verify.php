<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <div class="main">
        <table class="verifytable">
            <tr>
                <td class="verifytd"></td>
                <td class="verifytd"></td>
            </tr>
            <tr>
                <td class="verifytd"></td>
                <td class="verifytd"></td>
            </tr>
        </table>
        <input type="button" onclick="location.href='link.php?logout='" value="登出">
        <input type="button" onclick="location.reload()" value="重設">
        <input type="button" onclick="check()" value="確定">
    </div>
    <script src="verify.js"></script>
</body>
</html>