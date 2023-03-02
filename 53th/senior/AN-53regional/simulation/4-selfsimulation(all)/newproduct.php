<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewp or t" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="head">
            <div class="title">咖啡商品展示系統-新增版型</div>
            <div class="hbut">
                <form>
                    <input type="button" class="headbut" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="headbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="headbut selt" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="headbut" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="headbut" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="headbut" name="logout" value="登出">
                </form>
            </div>
        </div>
        <div class="pbar">
            <form>
                <div style="float:right;">
                    <input type="button" class="headbut" onclick="location.href='productindex.php'" value="返回">
                </div>
            </form>
        </div>
        <table class="newprodcuttable">
            <tr>
                <td class="newcoffeetd">1</td>
                <td class="newcoffeetd">2</td>
            </tr>
            <tr>
                <td class="newcoffeetd">3</td>
                <td class="newcoffeetd">4</td>
            </tr>
            <tr>
                <td class="newcoffeetd">5</td>
                <td class="newcoffeetd">6</td>
            </tr>
            <tr>
                <td class="newcoffeetd">7</td>
                <td class="newcoffeetd">8</td>
            </tr>
        </table>
        <form class="newform">
            圖片: <input type="text" name="picture" placeholder="1~4會往下佔3格"><br>
            商品名稱: <input type="text" name="name"><br>
            相關連結: <input type="text" name="link"><br>
            商品簡介: <input type="text" name="intr"><br>
            發佈日期: <input type="text" name="date"><br>
            費用: <input type="text" name="cost"><br>
            <input type="submit" name="submit" value="送出">
        </form>
        <?php
            if(isset($_GET["submit"])){
                $picture=$_GET["picture"];
                $name=$_GET["name"];
                $link=$_GET["link"];
                $intr=$_GET["intr"];
                $date=$_GET["date"];
                $cost=$_GET["cost"];
                query($db,"INSERT INTO `product`(`$picture`,`$name`,`$link`,`$intr`,`$date`,`$cost`)VALUES('picture','name','link','intr','date','cost')");
                ?><script>alert("新增成功");location.href="productindex.php"</script><?php
            }
        ?>
</body>
</html>