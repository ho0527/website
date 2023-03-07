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
    <div class="maindiv">
        <h1 class="hometitle">第二層驗證</h1>
        <p class="hometitle">請連成垂直或水平線</p>
        <div class="main">
            <table class="verifytable center">
                <tr>
                    <td class="verifytd"></td>
                    <td class="verifytd"></td>
                </tr>
                <tr>
                    <td class="verifytd"></td>
                    <td class="verifytd"></td>
                </tr>
            </table><br>
            <form class="center" style="width:150px;">
                <!-- <input type="submit" name="logout" value="取消"> -->
                <input type="button" onclick="location.reload()" value="重設">
                <input type="button" onclick="check()" value="確定">
            </form>
        </div>
    </div>
    <script src="verify.js"></script>
</body>
</html>