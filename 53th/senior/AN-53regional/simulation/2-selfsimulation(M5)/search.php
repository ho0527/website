<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if($_SESSION["permission"]=="管理者"){
            ?>
            <div class="header">
                <form class="headerform">
                    <div class="headtitle">咖啡商品展示系統-首頁</div>
                    <div class="headbut">
                        <input type="button" class="hbutton" onclick="location.href='signupedit.php'" value="新增">
                        <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="hbutton selectbut" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="hbutton" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <?php
        }else{
            ?>
            <div class="header">
                <form class="headerform">
                    <div class="headtitle">咖啡商品展示系統-首頁</div>
                    <div class="headbut">
                        <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="hbutton" value="上架商品">
                        <input type="button" class="hbutton selectbut" onclick="location.href='search.php'" value="查詢">
                        <input type="submit" class="hbutton" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <?php
        }
    ?>
    <div class="search1">
        <div class="searchdiv">
            <form>
                <input type="number" name="start" placeholder="開始值">~
                <input type="number" name="end" placeholder="結束值">
                <input type="submit" name="se" value="送出">
            </form>
        </div>
        <div class="searchdiv">
            <form>
                <input type="text" name="text" placeholder="關鍵字">~
                <input type="submit" name="t" value="送出">
            </form>
        </div>
    </div>
    <table class="maintable">
        <?php
            if(isset($_GET["se"])){
                $start=$_GET["start"];
                $end=$_GET["end"];
                product(fetchall(query($db,"SELECT*FROM `coffee` WHERE `cost`>='$start' AND '$end'>=`cost`")),$db,1);
            }elseif(isset($_GET["t"])){
                $text=$_GET["text"];
                product(fetchall(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$text%'or`link`LIKE'%$text%'or`date`LIKE'%$text%'or`introduction`LIKE'%$text%'or`cost`LIKE'%$text%'or`picture`LIKE'%$text%'")),$db,1);
            }else{
                product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,1);
            }
        ?>
    </table>
</body>
</html>