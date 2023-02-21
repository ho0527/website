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
            <div class="head">
                <form class="headf">
                    咖啡商品展示系統-首頁
                    <input type="button" class="ubutton" onclick="location.href='signupedit.php'" value="新增使用者">
                    <input type="button" class="ubutton select" onclick="location.href='user.php'" value="首頁">
                    <input type="button" class="ubutton" onclick="location.href=''" value="上架商品">
                    <input type="button" class="ubutton" onclick="location.href=''" value="查詢">
                    <input type="button" class="ubutton" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="ubutton" name="logout" value="登出">
                </form>
            </div>
            <?php
        }else{
            ?>
            <div class="head">
                <form class="headf">
                    咖啡商品展示系統-首頁
                    <input type="button" class="ubutton select" onclick="location.href='user.php'" value="首頁">
                    <input type="button" class="ubutton" onclick="location.href=''" value="上架商品">
                    <input type="button" class="ubutton" onclick="location.href=''" value="查詢">
                    <input type="submit" class="ubutton" name="logout" value="登出">
                </form>
            </div>
            <?php
        }
    ?>
</body>
</html>