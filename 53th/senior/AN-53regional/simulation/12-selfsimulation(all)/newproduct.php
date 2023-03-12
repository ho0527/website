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
        table{
            display: inline-block;
            width: 50%;
        }
        td{
            border: 1px black solid;
            width: 900px;
        }
        .newproducttable{
            width: 50%;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <h1>咖啡商品展示系統</h1>
    <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="mainbutton selt" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="mainbutton" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查尋">
    <input type="button" class="mainbutton logout" onclick="location.href='link.php?logout='" value="登出">
    <hr>
    <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="選擇版型">
    <input type="button" class="mainbutton" onclick="location.href='productinput.php'" value="填寫資料">
    <input type="button" class="mainbutton" onclick="location.href='productpreview.php'" value="預覽">
    <input type="button" class="mainbutton" onclick="location.href='productsubmit.php'" value="確定送出">
    <div class="mag"></div>
    <div class="main">
        <h2>新增版型</h2>
        <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="返回"><br>
        <table class="newproducttable">
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
        <br>
        請選擇對應的格子 圖片會向下佔2格(不用選那兩格)
        <form action="">
            <div>
                <?php
                    for($i=1;$i<=8;$i++){
                        echo($i);
                        ?>
                        <select name="<?= $i ?>" id="">
                            <option value="">請選擇</option>
                            <option value="picture">圖片</option>
                            <option value="name">商品名稱</option>
                            <option value="date">發佈日期</option>
                            <option value="cost">費用</option>
                            <option value="link">相關連結</option>
                            <option value="intr">商品簡介</option>
                        </select>
                        <?php
                    }
                ?>
                <input type="submit" name="submit" value="送出">
            </div>
        </form>
    </div>
    <?php
        if(isset($_GET["submit"])){
            $i1=$_GET["1"];
            $i2=$_GET["2"];
            $i3=$_GET["3"];
            $i4=$_GET["4"];
            $i5=$_GET["5"];
            $i6=$_GET["6"];
            $i7=$_GET["7"];
            $i8=$_GET["8"];
            query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('$i1','$i2','$i3','$i4','$i5','$i6','$i7','$i8')");
            ?><script>alert("新增成功");location.href="productindex.php"</script><?php
        }
    ?>
    <script src="product.js"></script>
</body>
</html>