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
                    <input type="button" class="navigationbarbutton" onclick="location.href='log.php'" value="製作日誌">
                    <input type="button" class="navigationbarbutton" onclick="location.href='about.php'" value="關於我們">
                    <input type="button" class="navigationbarbutton" onclick="location.href='connection.php'" value="聯絡我們">
                    <input type="button" class="navigationbarbutton selectbut" onclick="location.href='ads.php'" value="廣告">
                    <input type="submit" class="navigationbarbuttonlogin" name="logout" value="登入">
                </div>
            </div>
        </div>
        <table class="adstable">
            <tr>
                <td class="adstd">
                    <img src="ads1.png" alt="" class="adsimage"><br><br>
                    <input type="button" class="adsbutton" value="觀看">
                </td>
                <td class="adstd">
                    <img src="ads2.png" alt="" class="adsimage"><br><br>
                    <input type="button" class="adsbutton" value="觀看">
                </td>
                <td class="adstd">
                    <img src="ads3.png" alt="" class="adsimage"><br><br>
                    <input type="button" class="adsbutton" value="觀看">
                </td>
            </tr>
            <tr>
                <td class="adstd">
                    <img src="" alt="" class="adsimage"><br><br>
                    <input type="button" class="adsbutton" value="觀看">
                </td>
                <td class="adstd">
                    <img src="" alt="" class="adsimage"><br><br>
                    <input type="button" class="adsbutton" value="觀看">
                </td>
                <td class="adstd">
                    <img src="" alt="" class="adsimage"><br><br>
                    <input type="button" class="adsbutton" value="觀看">
                </td>
            </tr>
            <tr>
                <td class="adstd">
                    <img src="" alt="" class="adsimage"><br><br>
                    <input type="button" class="adsbutton" value="觀看">
                </td>
                <td class="adstd">
                    <img src="" alt="" class="adsimage"><br><br>
                    <input type="button" class="adsbutton" value="觀看">
                </td>
                <td class="adstd">
                    <img src="" alt="" class="adsimage"><br><br>
                    <input type="button" class="adsbutton" value="觀看">
                </td>
            </tr>
        </table>
        <div class="lightboxdiv" id="lightbox"></div>
        <div class="footer">
            我也不知道:)
        </div>
        <script src="ads.js"></script>
    </body>
</html>