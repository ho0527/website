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
            width: 25%;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="but" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="but selt" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <input type="button" class="but" onclick="location.href='productindex.php'" value="選擇版型">
        <input type="button" class="but" onclick="location.href='productinput.php'" value="填寫資料">
        <input type="button" class="but" onclick="location.href='productperview.php'" value="預覽">
        <input type="button" class="but selt" onclick="location.href='productsubmit.php'" value="確定送出"><br><br>
        <div class="main">
            <form action="">
                <h2>確定送出</h2>
                <p>請使用者再確認是否要送出</p>
                <input type="submit" class="but" name="submit" value="取消">
                <input type="submit" class="but" name="submit" value="確認">
            </form>
    </div>
    <?php
        if(isset($_GET["submit"])){
            if($_GET["submit"]=="確認"){
                $name=$_SESSION["name"];
                $cost=$_SESSION["cost"];
                $link=$_SESSION["link"];
                $intr=$_SESSION["intr"];
                $val=$_SESSION["val"];
                $picture=$_SESSION["picture"];
                $picturemain=$_SESSION["picturemain"];
                query($db,"INSERT INTO `coffee`(`name`,`picture`,`cost`,`link`,`intr`,`time`,`val`,`picturemain`)VALUES('$name','$picture','$cost','$link','$intr','$time','$val','$picturemain')");
            }
            unset($_SESSION["name"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["link"]);
            unset($_SESSION["intr"]);
            unset($_SESSION["val"]);
            unset($_SESSION["picture"]);
            unset($_SESSION["picturemain"]);
            ?><script>alert("完成");location.href="main.php"</script><?php
        }
        if(isset($_GET["val"])){
            $_SESSION["val"]=$_GET["val"];
            ?><script>location.href="productsubmit.php"</script><?php
        }
    ?>
</body>
</html>