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
        if($_SESSION["permission"]=="管理者"){
            ?>
            <div class="head">
                <div class="title">咖啡商品展示系統-首頁</div>
                <div class="but">
                    <input type="button" class="hbut" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbut" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="hbut selt" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
                    <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class="head">
                <div class="title">咖啡商品展示系統-首頁</div>
                <div class="but">
                    <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbut" value="上架商品">
                    <input type="button" class="hbut selt" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                </div>
            </div>
            <?php
        }
    ?>
    
    <div class="pbut">
        <div class="ppbut">
            <form>
                數字範圍<input type="text" name="start" placeholder="最高價位">~
                <input type="text" name="end" placeholder="最低價位">
                <input type="submit" name="num" value="送出">
            </form>
            <form>
                關鍵字<input type="text" name="text">
                <input type="submit" name="texts" value="送出">
            </form>
        </div>
    </div>
    <table class="producttable">
        <?php
            if(isset($_GET["num"])){
                $start=$_GET["start"];
                $end=$_GET["end"];
                product(fetchall(query($db,"SELECT*FROM `coffee` WHERE `cost`>='$start'AND`cost`<='$end'")),$db,1);
            }elseif(isset($_GET["texts"])){
                $type=$_GET["text"];
                product(fetchall(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$type%'or`cost`LIKE'%$type%'or`link`LIKE'%$type%'or`intr`LIKE'%$type%'or`date`LIKE'%$type%'")),$db,1);
            }else{
                product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,1);
            }
        ?>
    </table>
</body>
</html>