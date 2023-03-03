<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品管理系統</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if(isset($_GET["edit"])){
            ?>
            <div class="head">
                <div class="title">咖啡商品管理系統-編輯使用者</div>
                <div class="hbutdiv">
                    <input type="button" class="hbut selt" onclick="location.href='edit.php'" value="編輯使用者">
                    <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbut" onclick="location.href=''" value="上架商品">
                    <input type="button" class="hbut" onclick="location.href=''" value="查詢">
                    <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
                    <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class="head">
                <div class="title">咖啡商品管理系統-新增使用者</div>
                <div class="hbutdiv">
                    <input type="button" class="hbut selt" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbut" onclick="location.href=''" value="上架商品">
                    <input type="button" class="hbut" onclick="location.href=''" value="查詢">
                    <input type="button" class="hbut" onclick="location.href='admin.php'" value="會員管理">
                    <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
                </div>
            </div>
            <?php
        }
    ?>
</body>
</html>