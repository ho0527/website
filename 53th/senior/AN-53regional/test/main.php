<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>網站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="div">
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
            if($_SESSION["permission"]=="管理者"){
                ?>
                <div class="head mag">
                        <input type="button" class="hbut" onclick="location.href='main.php'" value="咖啡商品展示系統" style="position: absolute;top: 10px;">
                        <div class="but">
                            <input type="button" class="hbut" onclick="location.href='productindex.php'" value="上架商品">
                            <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
                            <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
                            <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                        </div>
                </div>
                <div class="main mag">
                    <table class="producttable">
                        <?php product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,0) ?>
                    </table>
                </div>
                <?php
            }else{
                ?>
                <div class="head">
                    <input type="button" class="hbut" onclick="location.href='main.php'" value="咖啡商品展示系統">
                    <div class="but">
                        <input type="button" class="hbut" value="上架商品">
                        <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                    </div>
                </div>
                <div class="main">
                <table class="producttable">
                    <?php product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,1) ?>
                </table>
                </div>
                <?php
            }
        ?>
    </div>
</body>
</html>