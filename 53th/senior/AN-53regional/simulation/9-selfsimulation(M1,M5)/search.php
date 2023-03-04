<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>咖啡商品管理系統</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if($_SESSION["permission"]=="管理者"){
            ?>
            <div class="head">
                <div class="title">咖啡商品管理系統-首頁</div>
                <div class="hbutdiv">
                    <input type="button" class="hbut" onclick="location.href=''" value="新增使用者">
                    <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbut" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="hbut selt" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="hbut" onclick="location.href=''" value="會員管理">
                    <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class="head">
                <div class="title">咖啡商品管理系統-首頁</div>
                <div class="hbutdiv">
                    <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbut selt" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                </div>
            </div>
            <?php
        }
    ?>
    <div class="pbut" style="font-size: 30px;">
        <form action="">
            數字範圍: <input type="text" name="start" id="" placeholder="最高價位">~
            <input type="text" name="end" id="" placeholder="最低價位">
            <input type="submit" value="nums">
        </form>
        <form action="">
            關鍵字: <input type="text" name="text">
            <input type="submit" value="texts">
        </form>
    </div>
    <table class="producttable" style="top:150px">
        <?php
            if(isset($_GET["nums"])){
                $start=$_GET["start"];
                $end=$_GET["end"];
                product(fetchall(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost`AND`cost`>='$end'")),0,$db);
            }elseif(isset($_GET["tests"])){
                $type=$_GET["text"];
                product(fetchall(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$type%'or`link`LIKE'%$type%'or`cost`LIKE'%$type%'or`intr`LIKE'%$type%'or`date`LIKE'%$type%'")),0,$db);
            }else{
                product(fetchall(query($db,"SELECT*FROM `coffee`")),0,$db);
            }
        ?>
    </table>
</body>
</html>