<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品管理系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 75%;
            height: 700px;
            max-height: 700px;
            overflow-y: auto;
        }
        table{
            width: 100%;
            margin: 0px auto;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if($_SESSION["permission"]=="管理者"){
            ?>
            <h1>咖啡商品管理系統</h1>
            <input type="button" class="mainbutton selt" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mainbutton" onclick="" value="會員管理">
            <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="logout" onclick="location.href='link.php?logout='" value="登出">
            <hr><br><br>
            <div class="main">
                <h2>首頁</h2>
                <table class="producttable">
                    <?php product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,0); ?>
                </table>
            </div>
            <?php
        }else{
            ?>
            <h1>咖啡商品管理系統</h1>
            <input type="button" class="mainbutton selt" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="logout" onclick="location.href='link.php?logout='" value="登出">
            <hr><br><br>
            <div class="main">
                <h2>首頁</h2>
                <table class="producttable">
                    <?php product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,1); ?>
                </table>
            </div>
            <?php
        }
    ?>
</body>
</html>