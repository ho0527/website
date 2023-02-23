<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>上架商品精靈</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
        <div class="header">
            <form class="headerform">
                <div class="headtitle">咖啡商品展示系統-確定送出</div>
                <div class="headbut">
                    <input type="button" class="hbutton" onclick="location.href='signupedit.php'" value="新增">
                    <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbutton selectbut" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="hbutton" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="hbutton" name="logout" value="登出">
                </div>
            </form>
        </div>
        <div style="float:right;">
            <input type="button" class="" onclick="location.href='newproduct.php'" value="返回">
        </div>

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
        <div style="text-align: center;">
            <form>
                商品名稱: <input type="number" name="name" placeholder="1~8"><br>
                費用: <input type="number" name="cost" placeholder="1~8"><br>
                相關連結: <input type="number" name="link" placeholder="1~8"><br>
                商品簡介: <input type="number" name="intr" placeholder="1~8"><br>
                日期: <input type="number" name="date" placeholder="1~8"><br>
                圖片: <input type="number" name="picture" placeholder="1~4(會往下佔2格)"><br>
                <input type="submit" name="submit" value="送出">
            </form>
        </div>
        <?php
            include("link.php");
            if(isset($_GET["submit"])){
                $name=$_GET["name"];
                $link=$_GET["link"];
                $cost=$_GET["cost"];
                $intr=$_GET["intr"];
                $picture=$_GET["picture"];
                $date=$_GET["date"];
                query($db,"INSERT INTO `product`(`$picture`,`$name`,`$intr`,`$cost`,`$link`,`$date`) VALUES ('picture','name','introduction','cost','link','date')");
                ?><script>alert("完成!");location.href="main.php"</script><?php
            }
        ?>
    </body>
</html>