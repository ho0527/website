<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>望站前台登入頁面</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <form>
            <div class="nbar">
                <div class="title">咖啡商品管理系統-選擇版型</div>
                <div class="divbut">
                    <input type="button" class="hbutton" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbutton selt" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="hbutton" onclick="location.href='serch.php'" value="查詢">
                    <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="hbutton" name="logout" value="登出">
                </div>
            </div>
            <div class="pbar">
                <div class="pbut">
                    <div style="float:right">
                        <input type="button" onclick="location.href='newproduct.php'" class="hbutton" value="返回">
                    </div>
                </div>
            </div>
        </form>
        <table class="table2">
            <tr>
                <td class="td">1</td>
                <td class="td">2</td>
            </tr>
            <tr>
                <td class="td">3</td>
                <td class="td">4</td>
            </tr>
            <tr>
                <td class="td">5</td>
                <td class="td">6</td>
            </tr>
            <tr>
                <td class="td">7</td>
                <td class="td">8</td>
            </tr>
        </table>
        <div class="div2">
            <form>
                圖片: <input type="text" name="picture" placeholder="1~4(會往下戰2格)"><br>
                商品名稱: <input type="text" name="name"><br>
                商品簡介: <input type="text" name="intr"><br>
                費用: <input type="text" name="cost"><br>
                日期: <input type="text" name="date"><br>
                相關連結: <input type="text" name="link"><br>
                <input type="submit" name="s" value="送出">
            </form>
        </div>
        <?php
            include("link.php");
            if(isset($_GET["s"])){
                $picture=$_GET["picture"];
                $name=$_GET["name"];
                $cost=$_GET["cost"];
                $date=$_GET["date"];
                $link=$_GET["link"];
                $intr=$_GET["intr"];
                query($db,"INSERT INTO `product`(`$picture`, `$name`, `$cost`, `$date`, `$link`, `$intr`) VALUES ('picture','name','cost','date','link','intr')");
                ?><script>alert("完成");location.href="productindex.php"</script><?php
            }
        ?>
        <script src="product.js"></script>
    </body>
</html>