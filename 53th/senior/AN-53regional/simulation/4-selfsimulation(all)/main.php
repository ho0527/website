<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
                <form action="">
                    <div class="title">咖啡商品展示系統-首頁</div>
                    <div class="hbut">
                        <input type="button" class="headbut" onclick="location.href='edit.php'" value="新增使用者">
                        <input type="button" class="headbut selt" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="headbut" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="headbut" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="headbut" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="headbut" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <table class="productmain">
                <?php product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,0); ?>
            </table>
            <?php
        }else{
            ?>
            <div class="head">
                <form action="">
                    <div class="title">咖啡商品展示系統-首頁</div>
                    <div class="hbut">
                        <input type="button" class="headbut selt" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="headbut" value="上架商品">
                        <input type="button" class="headbut" onclick="location.href='search.php'" value="查詢">
                        <input type="submit" class="headbut" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <table class="productmain">
                <?php product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,1); ?>
            </table>
            <?php
        }
    ?>
</body>
</html>