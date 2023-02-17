<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>網站前台登入頁面</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <img src="" alt="" class="mainimage">
        <img src="" alt="" class="mainlogo">
        <div class="navigationbar">
            <div class="navigationbardiv">
                <div class="maintitle">chatcom</div>
                <div class="navigationbarbuttondiv">
                    <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="首頁">
                    <input type="button" class="navigationbarbutton" onclick="location.href='chat/index.php'" value="chatcom">
                    <input type="button" class="navigationbarbutton" onclick="location.href='product.php'" value="產品">
                    <input type="button" class="navigationbarbutton selectbut" onclick="location.href='log.php'" value="製作日誌">
                    <input type="button" class="navigationbarbutton" onclick="location.href='about.php'" value="關於我們">
                    <input type="button" class="navigationbarbutton" onclick="location.href='connection.php'" value="聯絡我們">
                    <input type="button" class="navigationbarbutton" onclick="location.href='ads.php'" value="廣告">
                    <input type="submit" class="navigationbarbuttonlogin" name="logout" value="登入">
                </div>
            </div>
        </div>
        <div class="logmain">
            <div class="log">
                <div class="version">0</div>
                <div class="logtitle">首頁版型製作</div>
                <div class="date">2023/02/16</div>
                <div class="depiction">將首頁框架完成</div>
            </div>
            <div class="log">
                <div class="version">0</div>
                <div class="logtitle">首頁 廣告基本版型</div>
                <div class="date">2023/02/17</div>
                <div class="depiction">將首頁基本導覽列更新 廣告基本版型</div>
            </div>
        </div>
        <div class="footer">
            我也不知道:)
        </div>
    </body>
</html>