<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
        <div class="header">
            <div class="pdiv">
                    <input type="button" class="pbutton" onclick="location.href='productindex.php'" value="選擇版型">
                    <input type="button" class="pbutton" onclick="location.href='productinput.php'" value="填寫資料">
                    <input type="button" class="pbutton" onclick="location.href='productpreview.php'" value="預覽">
                    <input type="button" class="pbutton selectbut" onclick="location.href='productsubmit.php'" value="確定送出">
                    <div style="float:right;">
                        <input type="button" class="pbutton" onclick="location.href='newproduct.php'" value="新增版型">
                    </div>
            </div>
        </div>
        <div class="maindiv">
            <form>
                確定?
                <input type="submit" name="submit" value="取消">
                <input type="submit" name="submit" value="送出">
            </form>
        </div>
        <?php
            include("link.php");
            if(isset($_GET["submit"])){
                $name=$_SESSION["name"];
                $link=$_SESSION["link"];
                $cost=$_SESSION["cost"];
                $intr=$_SESSION["intr"];
                $picture=$_SESSION["picture"];
                $val=$_SESSION["val"];
                if($_GET["submit"]=="送出"){
                    query($db,"INSERT INTO `coffee`(`picture`, `name`, `introduction`, `cost`, `date`, `link`, `version`) VALUES ('$picture','$name','$intr','$cost','$time','$link','$val')");
                }
                unset($_SESSION["name"]);
                unset($_SESSION["link"]);
                unset($_SESSION["cost"]);
                unset($_SESSION["intr"]);
                unset($_SESSION["picture"]);
                ?><script>alert("完成!");location.href="main.php"</script><?php
            }
        ?>
        <script src="productindex.js"></script>
    </body>
</html>