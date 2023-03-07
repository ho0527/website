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
            width: 25%;
        }
        table{
            margin: 0px auto;
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
    <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="選擇版型">
    <input type="button" class="mainbutton" onclick="location.href='productinput.php'" value="填寫資料">
    <input type="button" class="mainbutton" onclick="location.href='productperview.php'" value="預覽">
    <input type="button" class="mainbutton selt" onclick="location.href='productsubmit.php'" value="確定送出"><br><br>
    <div class="main">
        <h2>確定送出</h2>
        <form action="">
            請您再次確定是否送出?<br>
            <input type="submit" class="mainbutton" name="submit" value="取消">
            <input type="submit" class="mainbutton" name="submit" value="確定">
        </form>
    </div>
    <?php
        if(isset($_GET["submit"])){
            if($_GET["submit"]=="確定"){
                $name=$_SESSION["name"];
                $cost=$_SESSION["cost"];
                $link=$_SESSION["link"];
                $intr=$_SESSION["intr"];
                $picture=$_SESSION["picture"];
                $val=$_SESSION["val"];
                query($db,"INSERT INTO `coffee`(`picture`, `name`, `cost`, `link`, `date`, `intr`, `val`) VALUES ('$picture','$name','$cost','$link','$time','$intr','$val')");
            }
            unset($_SESSION["name"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["link"]);
            unset($_SESSION["intr"]);
            unset($_SESSION["picture"]);
            ?><script>alert("完成");location.href='main.php'</script><?php
        }
    ?>
</body>
</html>