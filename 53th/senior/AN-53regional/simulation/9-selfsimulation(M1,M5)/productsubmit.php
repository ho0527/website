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
        <div class="title">咖啡商品展示系統-會員管理</div>
        <div class="hbutdiv">
            <input type="button" class="hbut" onclick="" value="新增使用者">
            <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="hbut" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="hbut selt" onclick="" value="會員管理">
            <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
        </div>
    </div>
    <div class="pbut">
        <input type="button" class="hbut" onclick="location.href='productindex.php'" value="選擇版型">
        <input type="button" class="hbut" onclick="location.href='productinput.php'" value="填寫資料">
        <input type="button" class="hbut" onclick="location.href='productpreview.php'" value="預覽">
        <input type="button" class="hbut selt" onclick="location.href='productsubmit.php'" value="確定送出">
        <div style="float:right;">
            <input type="button" class="hbut" onclick="location.href='newproduct.php'" value="新增版型">
        </div>
    </div>
    <div class="main">
        <form action="">
            確定送出?<br>
            <input type="submit" name="submit" value="取消">
            <input type="submit" name="submit" value="確定">
        </form>
    </div>
    <?php
        if(isset($_GET["submit"])){
            $picture=$_SESSION["picture"];
            $name=$_SESSION["name"];
            $cost=$_SESSION["cost"];
            $link=$_SESSION["link"];
            $intr=$_SESSION["intr"];
            $val=$_SESSION["val"];
            if($_GET["submit"]=="確定"){
                query($db,"INSERT INTO `coffee`(`picture`,`name`,`cost`,`link`,`date`,`intr`,`val`)VALUES('$picture','$name','$cost','$link','$time','$intr','$val')");
            }
            unset($_SESSION["picture"]);
            unset($_SESSION["name"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["link"]);
            unset($_SESSION["date"]);
            unset($_SESSION["intr"]);
            ?><script>alert("玩成");location.href="main.php"</script><?php
        }
    ?>
   </body>
</html>


