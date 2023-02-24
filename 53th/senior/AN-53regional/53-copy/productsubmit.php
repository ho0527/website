<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>上架商品精靈</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <form>
            <div class="nbar">
                <div class="title">咖啡商品管理系統-確定送出</div>
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
                <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="hbutton" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="hbutton" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="hbutton selt" onclick="location.href='productsubmit.php'" value="確定送出">
                <div style="float:right">
                    <input type="button" onclick="location.href='newproduct.php'" class="hbutton" value="新增版型">
                </div>
            </div>
            </div>
        </form>
        <div class="main">
            <form>
                確定?
                <input type="submit" name="submit" value="取消">
                <input type="submit" name="submit" value="送出">
            </form>
        </div>
        <?php
            include("link.php");
            if(isset($_GET["submit"])){
                if($_GET["submit"]=="送出"){
                    $name=$_SESSION["name"];
                    $cost=$_SESSION["cost"];
                    $link=$_SESSION["link"];
                    $intr=$_SESSION["intr"];
                    $val=$_SESSION["val"];
                    $picture=$_SESSION["picture"];
                    query($db,"INSERT INTO `coffee`(`picture`, `name`, `intr`, `link`, `cost`, `date`, `product`) VALUES ('$picture','$name','$intr','$link','$cost','$time','$val')");
                }
                unset($name);
                unset($cost);
                unset($link);
                unset($intr);
                unset($val);
                ?><script>alert("完成");location.href="main.php"</script><?php
            }
        ?>
        <script src="product.js"></script>
    </body>
</html>