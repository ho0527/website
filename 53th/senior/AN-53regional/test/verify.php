<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
        </table><br>
        <div>
            <form>
                <input type="submit" name="logout" value="登出">
                <input type="button" onclick="location.reload()" value="重設">
                <input type="button" onclick="check()" value="確定">
            </form>
        </div>
    </div>
    <script src="verify.js"></script>
</body>
</html>