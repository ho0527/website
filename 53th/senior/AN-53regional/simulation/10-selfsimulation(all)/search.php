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
            <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mainbutton" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="mainbutton selt" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="logout" onclick="location.href='link.php?logout='" value="登出">
            <?php
        }else{
            ?>
            <h1>咖啡商品管理系統</h1>
            <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mainbutton" onclick="" value="上架商品">
            <input type="button" class="mainbutton selt" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="logout" onclick="location.href='link.php?logout='" value="登出">
            <?php
        }
    ?>
    <hr><br><br>
    <div class="main">
        <h2>查詢</h2>
        <div class="mag">
            <form action="">
                數字範圍
                <input type="text" name="start" id="" placeholder="最高價位">~
                <input type="text" name="end" id="" placeholder="最低價位">
                <input type="submit" name="nums" value="送出">
            </form>
            <form action="">
                關鍵字
                <input type="text" name="text" id="" placeholder="關鍵字">
                <input type="submit" name="tex" value="送出">
            </form>
        </div>
        <table class="producttable">
            <?php
                if(isset($_GET["nums"])){
                    $start=$_GET["start"];
                    $end=$_GET["end"];
                    product(fetchall(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost`AND`cost`<='$end'")),$db,1);
                }elseif(isset($_GET["tex"])){
                    $type=$_GET["text"];
                    product(fetchall(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$type%'or`cost`LIKE'%$type%'or`link`LIKE'%$type%'or`intr`LIKE'%$type%'or`date`LIKE'%$type%'")),$db,1);
                }else{
                    product(fetchall(query($db,"SELECT*FROM `coffee`")),$db,1);
                }
            ?>
        </table>
    </div>
</body>
</html>