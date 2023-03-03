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
                    <input type="button" class="hbut selt" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbut" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
                    <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                </div>
            </div>
            <table class="producttable">
                <?php product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,0) ?>
            </table>
            <?php
        }else{
            ?>
            <div class="head">
                <div class="title">咖啡商品展示系統-首頁</div>
                <div class="but">
                    <input type="button" class="hbut selt" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbut" value="上架商品">
                    <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                </div>
            </div>
            <table class="producttable">
                <?php product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,1) ?>
            </table>
            <?php
        }
    ?>
</body>
</html>