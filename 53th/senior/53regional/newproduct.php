<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>管理者專區</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <link rel="stylesheet" href="plugin/css/sort.css">
        <script src="plugin/js/macossection.js"></script>
        <script src="plugin/js/sort.js"></script>
    </head>
    <body>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">咖啡商品展示系統-選擇版型</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查詢">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
            </div>
        </div>
        <div class="productbar">
            <div class="productbardiv center">
                <input type="button" class="navigationbarbutton selectbut" onclick="location.href='newproduct.php'" value="新增版型">
                <input type="button" class="navigationbarbutton" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="navigationbarbutton" onclick="data()" value="填寫資料">
                <input type="button" class="navigationbarbutton" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="navigationbarbutton" onclick="nono()" value="確定送出">
            </div>
        </div>
        <div class="main">
            <div class="grid">
                <div class="newproductleft newproduct">
                    <div class="list small cost" id="cost">費用</div>
                    <div class="list mid introduction" id="introduction">商品簡介</div>
                    <div class="list small date" id="date">發布日期</div>
                    <div class="list small link" id="link">相關連結</div>
                </div>
                <div class="newproductright newproduct">
                    <div class="list small name" id="name">商品名稱</div>
                    <div class="list large picture" id="picture">圖片</div>
                </div>
            </div>
            <input type="button" class="button" onclick="location.href='productindex.php'" value="返回">
            <input type="button" class="button" id="submit" value="送出">
        </div>
        <?php
            include("link.php");
            if(isset($_GET["key"])){
                $cost=$_GET["cost"];
                $introduction=$_GET["introduction"];
                $date=$_GET["date"];
                $link=$_GET["link"];
                $name=$_GET["name"];
                $picture=$_GET["picture"];
                query($db,"INSERT INTO `product`(`name`,`cost`,`date`,`link`,`introduction`,`picture`)VALUES('$name','$cost','$date','$link','$introduction','$picture')");
                ?><script>alert("上傳成功");location.href="productindex.php"</script><?php
            }
        ?>
        <script src="newproduct.js"></script>
    </body>
</html>