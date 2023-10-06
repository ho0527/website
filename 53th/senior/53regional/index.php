<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>網站前台登入頁面</title>
        <link rel="stylesheet" href="index.css">
        <script src="../../../plugin/js/chrisplugin.js"></script>
        <script src="../../../plugin/js/chrisplugin.js"></script>
    </head>
    <body>
        <?php
            if(isset($_SESSION["data"])){ header("location:verify.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="logo.png" class="logo">
            </div>
            <div class="navigationbartitle center">咖啡商品展示系統</div>
        </div>
        <div class="main">
            帳號: <input type="text" class="input" id="username"><br><br>
            密碼: <input type="text" class="input" id="password"><br><br>
            <div class="dragdiv">圖形驗證碼</div>
            <span id="verifycode"></span><br><br>
            <div class="dragdiv">
                請拖動驗證碼圖片
                <span id="key"></span>
            </div>
            <div class="dropbox" id="dropbox"></div><br><br>
            <input type="button" class="button" id="reflash" value="重新產生">
            <input type="button" class="button" id="clear" value="清除">
            <input type="button" class="button" id="login" value="登入">
        </div>
        <script src="index.js"></script>
    </body>
</html>