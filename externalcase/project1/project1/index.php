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
                    <input type="button" class="navigationbarbutton" onclick="location.href='signupedit.php'" value="新增">
                    <input type="button" class="navigationbarbutton selectbut" onclick="location.href='index.php'" value="首頁">
                    <input type="button" class="navigationbarbutton" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="navigationbarbutton" onclick="location.href='log.php'" value="製作日誌">
                    <input type="submit" class="navigationbarbutton" name="logout" value="登入">
                </div>
            </div>
        </div>
        <div class="footer">
            我也不知道:)
        </div>
    </body>
</html>