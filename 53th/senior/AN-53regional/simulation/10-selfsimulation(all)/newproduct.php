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
        }
        table{
            width: 35%;
            margin: 0px auto;
        }
        td{
            border: 1px black solid;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <h1>咖啡商品管理系統</h1>
    <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="mainbutton selt" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="mainbutton" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查詢">
    <input type="button" class="logout" onclick="location.href='link.php?logout='" value="登出">
    <hr><br>
    <input type="button" class="mainbutton selt" onclick="location.href='productindex.php'" value="選擇版型">
    <input type="button" class="mainbutton" onclick="location.href='productinput.php'" value="填寫資料">
    <input type="button" class="mainbutton" onclick="location.href='productperview.php'" value="預覽">
    <input type="button" class="mainbutton" onclick="location.href='productsubmit.php'" value="確定送出"><br><br>
    <div class="main">
        <h2>新增版型</h2>
        <table>
            <tr>
                <td>1</td>
                <td>2</td>
            </tr>
            <tr>
                <td>3</td>
                <td>4</td>
            </tr>
            <tr>
                <td>5</td>
                <td>6</td>
            </tr>
            <tr>
                <td>7</td>
                <td>8</td>
            </tr>
        </table>
        <form action="">
            圖片: <input type="number" name="picture" placeholder="1~4(會往下佔2格)"><br>
            商品名稱: <input type="number" name="name"><br>
            費用: <input type="number" name="cost"><br>
            相關連結: <input type="number" name="link"><br>
            發佈日期: <input type="number" name="date"><br>
            商品簡介: <input type="number" name="intr"><br>
            <input type="submit" name="submit" value="送出">
        </form>
    </div>
    <?php
        if(isset($_GET["submit"])){
            $picture=$_GET["picture"];
            $name=$_GET["name"];
            $cost=$_GET["cost"];
            $link=$_GET["link"];
            $date=$_GET["date"];
            $intr=$_GET["intr"];
            query($db,"INSERT INTO `product`(`$picture`,`$name`,`$cost`,`$link`,`$date`,`$intr`)VALUES('picture','name','cost','link','date','intr')");
            ?><script>alert("新增成功");location.href='productindex.php'</script><?php
        }
    ?>
</body>
</html>