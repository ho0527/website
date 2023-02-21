<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="verify">
            <table class="table">
                <tr>
                    <td class="verifytd"></td>
                    <td class="verifytd"></td>
                </tr>
                <tr>
                    <td class="verifytd"></td>
                    <td class="verifytd"></td>
                </tr>
            </table><br>
            <form class="gamebar">
                <input type="submit" class="verifybutton" name="logout" value="登出">
                <input type="button" class="verifybutton" onclick="location.reload()" value="清除">
                <input type="button" class="verifybutton" onclick="check()" value="確定">
            </form>
        </div>
        <?php include("link.php"); ?>
        <script src="verify.js"></script>
    </body>
</html>