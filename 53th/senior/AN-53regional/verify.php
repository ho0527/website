<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
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
            <form class="gamebar">
                <input type="submit" class="verifybutton" name="logout" value="返回">
                <input type="button" class="verifybutton" onclick="location.reload()" value="清除">
                <input type="button" class="verifybutton" onclick="check()" value="確定">
            </form>
        </div>
        <script src="verify.js"></script>
    </body>
</html>