<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>二重驗證</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbartitle center">咖啡商品展示系統-二重驗證</div>
        </div>
        <div class="main">
            <h3 class="context" id="context"></h3>
            <table class="table">
                <tr>
                    <td class="td"></td>
                    <td class="td"></td>
                    <td class="td"></td>
                </tr>
                <tr>
                    <td class="td"></td>
                    <td class="td"></td>
                    <td class="td"></td>
                </tr>
                <tr>
                    <td class="td"></td>
                    <td class="td"></td>
                    <td class="td"></td>
                </tr>
            </table><br>
            <form class="gamebar">
                <input type="button" class="button" onclick="location.href='api.php?logout='" value="返回">
                <input type="button" class="button" onclick="location.reload()" value="清除">
                <input type="button" class="button" id="change" value="切換">
                <input type="button" class="button" onclick="check()" value="確定">
            </form>
        </div>
        <script src="verify.js"></script>
    </body>
</html>