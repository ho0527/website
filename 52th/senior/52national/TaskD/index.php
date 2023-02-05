<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TaskD-圖片分享平台首頁</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="navigationbar">
            <input type="button" id="index" value="首頁" class="indexbutton" onclick="location.href='index.php'">
            <input type="button" id="view" value="瀏覽貼文" class="indexbutton" onclick="location.href='post.php'">
            <input type="button" id="signup" value="註冊" class="indexbutton">
            <input type="button" id="login" value="登入" class="indexbutton">
        </div>
        <?php
            include("link.php");
            loginlightbox();
        ?>
        <script src="index.js"></script>
    </body>
</html>