<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>網站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <div class="head">
        <div class="title">咖啡商品展示系統-確定送出</div>
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
            <input type="button" class="hbut" onclick="location.href='productindex.php'" value="選擇版型">
            <input type="button" class="hbut" onclick="location.href='productinput.php'" value="填寫資料">
            <input type="button" class="hbut" onclick="location.href='productpreview.php'" value="預覽">
            <input type="button" class="hbut selt" onclick="location.href='productsubmit.php'" value="確定送出">
            <div style="float:right;">
                <input type="button" class="hbut" onclick="location.href='newproduct.php'" value="新增版型">
            </div>
        </div>
    </div>
    <div class="main" style="text-align:center; ">
        <form>
            確定送出?<br>
            <input type="submit" name="submit" value="取消">
            <input type="submit" name="submit" value="確認送出">
        </form>
    </div>
    <?php
        if(isset($_GET["submit"])){
            $name=$_SESSION["name"];
            $cost=$_SESSION["cost"];
            $link=$_SESSION["link"];
            $intr=$_SESSION["intr"];
            $picture=$_SESSION["picture"];
            $val=$_SESSION["val"];
            if($_GET["submit"]=="確認送出"){
                query($db,"INSERT INTO `coffee`(`picture`,`name`,`cost`,`link`,`intr`,`date`,`val`)VALUES('$picture','$name','$cost','$link','$intr','$time','$val')");
            }
            unset($_SESSION["name"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["link"]);
            unset($_SESSION["intr"]);
            unset($_SESSION["picture"]);
            unset($_SESSION["val"]);
            ?><script>alert("完成");location.href="main.php"</script><?php
        }
    ?>    
    <script src="product.js"></script>
</body>
</html>