<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品展示系統    </title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 25%;
            max-height: 500px;
            height: 500px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if($_SESSION["permission"]=="管理者"){
            ?>
            <h1>網站前台登入頁面</h1>
            <input type="button" class="mbutton selt" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mbutton" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="mbutton" onclick="location.href='search.php'" value="查尋">
            <input type="button" class="mbutton logout" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <table class="producttable">
                </table>
            </div>
            <?php
        }else{
            ?>
            <h1>網站前台登入頁面</h1>
            <input type="button" class="mbutton selt" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mbutton" onclick="" value="上架商品">
            <input type="button" class="mbutton" onclick="location.href='search.php'" value="查尋">
            <input type="button" class="mbutton logout" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <table class="producttable">
                    <?php product(fetchall(query($db,"SELECT*FROM `coffee`")),$db); ?>
                </table>
            </div>
            <?php
        }
    ?>
</body>
</html>