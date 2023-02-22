<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <input type="button" class="hbutton selectbut" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="hbutton" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="hbutton" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <table class="maintable">
                <?php  ?>
            </table>
            <?php
        }else{
            ?>
            <div class="header">
                <form class="headerform">
                    <div class="headtitle">咖啡商品展示系統-首頁</div>
                    <div class="headbut">
                        <input type="button" class="hbutton selectbut" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="hbutton" value="上架商品">
                        <input type="button" class="hbutton" onclick="location.href='search.php'" value="查詢">
                        <input type="submit" class="hbutton" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <table class="maintable">
                <?php  ?>
            </table>
            <?php
        }
    ?>
</body>
</html>
</body>
</html>