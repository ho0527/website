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
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <div class="head">
        <div class="title">咖啡商品展示系統-選擇版型</div>
        <div class="hbutdiv">
            <input type="button" class="hbut" onclick="" value="新增使用者">
            <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="hbut selt" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="hbut" onclick="" value="會員管理">
            <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
        </div>
    </div>
    <div class="pbut">
            <input type="button" class="hbut selt" onclick="location.href='productindex.php'" value="選擇版型">
            <input type="button" class="hbut" onclick="location.href='productinput.php'" value="填寫資料">
            <input type="button" class="hbut" onclick="location.href='productpreview.php'" value="預覽">
            <input type="button" class="hbut" onclick="location.href='productsubmit.php'" value="確定送出">
            <div style="float:right;">
                <input type="button" class="hbut" onclick="location.href='newproduct.php'" value="新增版型">
            </div>
        </div>
    <table class="newproducttable">
        <?php
        for($i=1;$i<8;$i+=2){
            ?>
            <tr>
                <td class="coffeetd"><?= $i ?></td>
                <td class="coffeetd"><?= $i+1 ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <div class="main" style="top:600px">
        <form action="">
            圖片: <input type="text" name="picture" placeholder="1~4(會往下佔2格)"><br>
            商品名稱: <input type="text" name="name"><br>
            費用: <input type="text" name="cost"><br>
            相關連結: <input type="text" name="link"><br>
            發佈日期: <input type="text" name="date"><br>
            商品簡介: <input type="text" name="intr"><br>
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
    </body>
</html>