<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <form class="verify">
        <table class="verifytable">
            <tr>
                <td class="verifytd" id="td1"></td>
                <td class="verifytd" id="td2"></td>
            </tr>
            <tr>
                <td class="verifytd" id="td3"></td>
                <td class="verifytd" id="td4"></td>
            </tr>
        </table><br>
        <input type="submit" name="logout" value="登出">
        <input type="button" onclick="lcoation.reload()" value="重製">
        <input type="button" onclick="check()" value="送出">
    </form>
    <script src="verify.js"></script>
</body>
</html>