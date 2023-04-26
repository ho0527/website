<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="main">
            請點擊驗證碼讓三字母相同<br><br>
            <div class="verifydiv" id="verifydiva"></div>
            <div class="verifydiv" id="verifydivb"></div>
            <div class="verifydiv" id="verifydivc"></div><br><br>
            <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
            <input type="button" class="button" onclick="location.href='verify.php'" value="更新">
            <input type="button" class="button" onclick="verifysubmit()" value="送出">
        <div>
        <script src="verify.js"></script>
    </body>
</html>