<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 75%;
            max-height: 400px;
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
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mainbutton" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="mainbutton selt" onclick="location.href='search.php'" value="查尋">
            <input type="button" class="mainbutton logout" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <?php
        }else{
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mainbutton" onclick="" value="上架商品">
            <input type="button" class="mainbutton selt" onclick="location.href='search.php'" value="查尋">
            <input type="button" class="mainbutton logout" onclick="location.href='link.php?logout='" value="登出">
            <?php
        }
    ?>
    <hr>
    <div class="main">
        <form class="mag">
            數字範圍 <input type="text" name="start" placeholder="最低價位">~
            <input type="text" name="end" placeholder="最高價位">
            <input type="submit" name="num" value="送出">
        </form>
        <form class="mag">
            關鍵字 <input type="text" name="tex" placeholder="關鍵字">
            <input type="submit" name="text" value="送出">
        </form>
        <table class="producttable">
            <?php
                if(isset($_GET["num"])){
                    $start=$_GET["start"];
                    $end=$_GET["end"];
                    product(fetchall(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost`AND`cost`<='$end'")),$db);
                }elseif(isset($_GET["text"])){
                    $type=$_GET["tex"];
                    product(fetchall(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$type%'or`cost`LIKE'%$type%'or`link`LIKE'%$type%'or`intr`LIKE'%$type%'or`date`LIKE'%$type%'")),$db);
                }else{
                    product(fetchall(query($db,"SELECT*FROM `coffee`")),$db);
                }
            ?>
        </table>
    </div>
</body>
</html>