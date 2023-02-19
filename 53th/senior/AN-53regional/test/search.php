<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if($_SESSION["permission"]=="管理者"){
            ?>
            <div class="header">
                <form action="" class="headerform">
                    <div class="headtitle">咖啡商品展示系統-查詢</div>
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
                <form action="" class="headerform">
                    咖啡商品展示系統-查詢
                    <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbutton" value="上架商品">
                    <input type="button" class="hbutton selectbut" onclick="location.href='search.php'" value="查詢">
                    <input type="submit" class="hbutton" name="logout" value="登出">
                </form>
            </div>
            <?php
        }
    ?>
    <div class="search1">
        <form action="" class="radiobox">
            <div class="searchdiv">
                數字範圍:
                <input type="text" name="start" id="">~<input type="text" name="end" id="">
                <input type="submit" name="num" value="送出">
            </div>
            <div class="searchdiv">
                關鍵字:
                <input type="text" name="tex" id="">
                <input type="submit" name="text" value="送出">
            </div>
        </form>
    </div>
    <table class="maintable">
            <?php
                if(isset($_GET["num"])){
                    $start=$_GET["start"];
                    $end=$_GET["end"];
                    product(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost` AND `cost`<='$end'"),1,$db);
                }elseif(isset($_GET["text"])){
                    $text=$_GET["tex"];
                    product(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$text%' or `introduction`LIKE'%$text%' or `cost`LIKE'%$text%' or `date`LIKE'%$text%' or `link`LIKE'%$text%'"),1,$db);
                }else{
                    product(query($db,"SELECT*FROM `coffee`"),1,$db);
                }
            ?>
    </table>
</body>
</html>