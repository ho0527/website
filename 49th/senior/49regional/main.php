<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="center">
            <table class="table">
                <tr>
                    <td class="td" id="td1"></td>
                    <td class="td" id="td2"></td>
                </tr>
                <tr>
                    <td class="td" id="td3"></td>
                    <td class="td" id="td4"></td>
                </tr>
            </table>
            <input type="button" class="button" onclick="location.href='link.php?logout='" value="返回">
            <input type="button" class="button" onclick="location.reload()" value="清除">
            <input type="button" class="button" onclick="check()" value="確定">
        </div>
        <script src="verify.js"></script>
    </body>
</html>