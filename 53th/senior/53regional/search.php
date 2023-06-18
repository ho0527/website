<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>一般會員專區</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="navigationbar">
            <form class="navigationbardiv">
                <?php
                    include("link.php");
                    if($_SESSION["permission"]=="管理者"){
                        ?>
                        咖啡商品展示系統-&nbsp&nbsp查詢&nbsp&nbsp
                        <input type="button" class="adminbutton" onclick="location.href='signupedit.php'" value="新增">
                        <input type="button" class="adminbutton" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="adminbutton" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="adminbutton selectbut" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
                        <input type="submit" class="adminbutton" name="logout" value="登出">
                        <?php
                    }else{
                        ?>
                        咖啡商品展示系統-&nbsp&nbsp查詢&nbsp&nbsp
                        <input type="button" class="adminbutton" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="adminbutton" value="上架商品">
                        <input type="button" class="adminbutton selectbut" onclick="location.href='search.php'" value="查詢">
                        <input type="submit" class="adminbutton" name="logout" value="登出">
                        <?php
                    }
                    ?>
            </form>
        </div>
        <div class="searchtd1">
            <form>
                <div class="radiobox">
                    數字範圍:<input type="radio" class="radio" name="but" id="numb" value="num">
                    關鍵字:<input type="radio" class="radio" name="but" id="text" value="text">
                </div>
                <div class="radiosearchtext" id="radiosearchtext"></div>
            </form>
        </div>
        <table class="maintable">
            <?php
                if(isset($_GET["submit"])){
                    if($_GET["but"]=="num"){
                        $start=$_GET["start"];
                        $end=$_GET["end"];
                        product(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost` AND `cost`<='$end'"),1,$db);
                    }else{
                        $text=$_GET["maintext"];
                        product(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$text%' or `introduction`LIKE'%$text%' or `cost`LIKE'%$text%' or `date`LIKE'%$text%' or `link`LIKE'%$text%'"),1,$db);
                    }
                }else{
                    product(query($db,"SELECT*FROM `coffee`"),1,$db);
                }
            ?>
        </table>
        <script src="usersearch.js"></script>
    </body>
</html>