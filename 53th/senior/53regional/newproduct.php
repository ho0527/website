<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>管理者專區</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
        ?>
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
        <div class="version" id="version1" style="top: 300px;left:225px;">
            <table class="producttable">
                <tr>
                <td class="coffeedata">1</td>
                <td class="coffeedata">2</td>
                </tr>
                <tr>
                <td class="coffeedata">3</td>
                <td class="coffeedata">4</td>
                </tr>
                <tr>
                <td class="coffeedata">5</td>
                <td class="coffeedata">6</td>
                </tr>
                <tr>
                    <td class="coffeedata">7</td>
                <td class="coffeedata">8</td>
                </tr>
            </table>
        </div>
        <form class="version" style="background: none;top: 300px;right:225px;">
            圖片: <input type="number" name="picture" placeholder="1~4(會往下佔3格)"><br><br>
            名稱: <input type="number" name="name" placeholder="1~8"><br><br>
            連結: <input type="number" name="link" placeholder="1~8"><br><br>
            金額: <input type="number" name="cost" placeholder="1~8"><br><br>
            日期: <input type="number" name="date" placeholder="1~8"><br><br>
            敘述: <input type="number" name="introduction" placeholder="1~8"><br>
            <input type="submit" name="submit" value="送出">
        </form>
        <div style="float:right">
            <button onclick="location.href='productindex.php'">返回</button>
        </div>
        <?php
            if(isset($_GET["submit"])){
                $picture=$_GET["picture"];
                $name=$_GET["name"];
                $link=$_GET["link"];
                $cost=$_GET["cost"];
                $date=$_GET["date"];
                $introduction=$_GET["introduction"];
                query($db,"INSERT INTO `product`(`$picture`, `$name`, `$link`, `$cost`, `$date`, `$introduction`) VALUES ('picture','name','link','cost','date','introduction')");
                header("location:productindex.php");
            }
        ?>
    </body>
</html>