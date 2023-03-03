<!DOCTYPE html>
<html>
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
        if($_SESSION["permission"]=="管理者"){
            ?>
            <div class="head">
                <form>
                    <div class="title">咖啡商品展示系統-查詢</div>
                    <div class="hbut">
                        <input type="button" class="headbut" onclick="location.href='edit.php'" value="新增使用者">
                        <input type="button" class="headbut" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="headbut" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="headbut selt" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="headbut" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="headbut" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <?php
        }else{
            ?>
            <div class="head">
                <form>
                    <div class="title">咖啡商品展示系統-查詢</div>
                    <div class="hbut">
                        <input type="button" class="headbut" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="headbut" value="上架商品">
                        <input type="button" class="headbut selt" onclick="location.href='search.php'" value="查詢">
                        <input type="submit" class="headbut" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <?php
        }
    ?>
    <div class="search">
        <form style="display:inline-block">
            數字範圍
            <input type="text" name="start">~
            <input type="text" name="end">
            <input type="submit" name="nsubmit" value="送出">
        </form>
        <form style="display:inline-block">
            關鍵字
            <input type="text" name="text">
            <input type="submit" name="tsubmit" value="送出">
        </form>
    </div>
    <table class="productmain">
        <?php
        if(isset($_GET["nsubmit"])){
            $start=$_GET["start"];
            $end=$_GET["end"];
            product(fetchall(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost`AND`cost`<='$end'")),$db,1);
        }elseif(isset($_GET["tsubmit"])){
            $type=$_GET["text"];
            product(fetchall(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$type%' or `cost`LIKE'%$type%' or `link`LIKE'%$type%' or `date`LIKE'%$type%' or `intr`LIKE'%$type%'")),$db,1);
        }else{
            product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,1);
        }
        ?>
    </table>
</body>
</html>