<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <div class="head">
        <div class="title">咖啡商品展示系統-選擇版型</div>
        <div class="but">
            <input type="button" class="hbut" onclick="location.href='edit.php'" value="新增使用者">
            <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="hbut selt" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
        </div>
    </div>
    <div class="pbut">
        <div class="ppbut">
            <div style="float:right;">
                <input type="button" class="hbut" onclick="location.href='productindex.php'" value="返回">
            </div>
        </div>
    </div>
    <table class="producttable">
        <?php
            for($i=1;$i<8;$i=$i+2){
                ?>
                <tr>
                    <td class="coffee"><?= $i ?></td>
                    <td class="coffee"><?= $i+1 ?></td>
                </tr>
                <?php
            }
        ?>
    </table>
    <div class="main newproduct">
        <form action="">
            照片: <input type="text" name="picture" id="" placeholder="1~4(會往下佔2格)"><br>
            商品名稱: <input type="text" name="name" id=""><br>
            費用: <input type="text" name="cost" id=""><br>
            相關連結: <input type="text" name="link" id=""><br>
            發佈日期: <input type="text" name="date" id=""><br>
            商品簡介: <input type="text" name="intr" id=""><br>
            <input type="submit" name="submit" value="送出">
        </form>
    </div>
    <?php
        if(isset($_GET["submit"])){
            $picture=$_GET["picture"];
            $name=$_GET["name"];
            $cost=$_GET["cost"];
            $link=$_GET["link"];
            $date=$_GET["date"];
            $intr=$_GET["intr"];
            query($db,"INSERT INTO `product`(`$picture`,`$name`,`$cost`,`$link`,`$date`,`$intr`)VALUES('picture','name','cost','link','date','intr')");
            ?><script>alert("新增成功");location.href="productindex.php"</script><?php
        }
    ?>
    <script src="product.js"></script>
</body>
</html>