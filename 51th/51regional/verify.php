<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="verifymaindiv">
            請點擊驗證碼讓三字母相同<br>
            <div class="verifydiv" id="verifydiva"></div>
            <div class="verifydiv" id="verifydivb"></div>
            <div class="verifydiv" id="verifydivc"></div>
            <input type="button" onclick="location.href='login.php'" value="登出">
            <input type="button" onclick="location.href='verify.php'" value="更新">
            <input type="button" onclick="verifysubmit()" value="送出">
        <div>
        <script src="verify.js"></script>
    </body>
</html>