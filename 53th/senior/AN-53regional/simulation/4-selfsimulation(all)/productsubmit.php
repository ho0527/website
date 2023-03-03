<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewp or t" content="width=device-width, initial-scale=1.0">
    <title>上架產品精靈</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="head">
            <div class="title">咖啡商品展示系統-確定送出</div>
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
                <input type="button" class="headbut" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="headbut" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="headbut" onclick="location.href='productperview.php'" value="預覽">
                <input type="button" class="headbut selt" onclick="location.href='productsubmit.php'" value="確定送出">
                <div style="float:right;">
                    <input type="button" class="headbut" onclick="location.href='newproduct.php'" value="新增版型">
                </div>
            </form>
        </div>
        <div class="main" style="text-align:center;">
            <form>
                確定?<br>
                <input type="submit" name="submit" value="取消">
                <input type="submit" name="submit" value="確定">
            </form>
        </div>
        <?php
            if(isset($_GET["submit"])){
                if($_GET["submit"]=="確定"){
                    $name=$_SESSION["name"];
                    $cost=$_SESSION["cost"];
                    $link=$_SESSION["link"];
                    $intr=$_SESSION["intr"];
                    $picture=$_SESSION["picture"];
                    $val=$_SESSION["val"];
                    query($db,"INSERT INTO `coffee`(`picture`, `name`, `link`, `cost`, `date`, `intr`, `product`) VALUES ('$picture','$name','$link','$cost','$time','$intr','$val')");
                }
                unset($_SESSION["name"]);
                unset($_SESSION["cost"]);
                unset($_SESSION["link"]);
                unset($_SESSION["intr"]);
                unset($_SESSION["picture"]);
                ?><script>alert("完成");location.href="main.php"</script><?php
            }
        ?>
        <script src="product.js"></script>
</body>
</html>