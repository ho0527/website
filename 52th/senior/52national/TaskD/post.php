<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>使用者專區</title>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="poststyle.css">
    </head>
    <body>
        <div class="navigationbar">
            <input type="button" id="index" value="首頁" class="indexbutton" onclick="location.href='index.php'">
            <input type="button" id="view" value="瀏覽貼文" class="indexbutton" onclick="location.href='post.php'">
            <input type="button" id="signup" value="註冊" class="indexbutton">
            <input type="button" id="login" value="登入" class="indexbutton">
        </div><br>
        <table class="main-table">
            <tr>
                <td class="left">
                </td>
                <td class="right">
                    <div class="acc">
                        <img class="headportrait">
                    </div>
                    <button type="button" id="setting-button" class="setting-button">更改個人資訊</button>
                    <button type="button" class="follower" id="follower">追蹤</button>
                    <button type="submit" id="loggout-button" class="loggout-button" name="logout">logout</button>
                </td>
            </tr>
        </table>
        <?php
            include("link.php");
            loginlightbox();
        ?>
        <script src="index.js"></script>
    </body>
</html>