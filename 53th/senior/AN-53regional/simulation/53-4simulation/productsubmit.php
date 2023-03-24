<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 25%;
            font-size: 25px;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:main.php"); }
        ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="button selt" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button" onclick="location.href='productinput.php'" value="填寫資料">
        <input type="button" class="button" onclick="location.href='productperview.php'" value="預覽">
        <input type="button" class="button selt" onclick="location.href='productsubmit.php'" value="確定送出">
        <br><br>
        <div class="main">
            <h2>確定送出</h2>
            <form>
                請編輯者再確認是否要送出<br>
                <input type="submit" class="button" name="submit" value="取消">
                <input type="submit" class="button" name="submit" value="確認">
            </form>
        </div>
    <?php
        if(isset($_GET["submit"])){
            if($_GET["submit"]=="確認"){
                $name=$_SESSION["name"];
                $link=$_SESSION["link"];
                $cost=$_SESSION["cost"];
                $intr=$_SESSION["intr"];
                $picture=$_SESSION["picture"];
                $val=$_SESSION["val"];
                query($db,"INSERT INTO `coffee`(`picture`,`name`,`cost`,`link`,`date`,`intr`,`val`)VALUES('$picture','$name','$cost','$link','$time','$intr','$val')");
            }
            unset($_SESSION["name"]);
            unset($_SESSION["link"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["intr"]);
            unset($_SESSION["picture"]);
            unset($_SESSION["val"]);
            ?><script>alert("完成:)");location.href="main.php"</script><?php
        }
        if(isset($_GET["val"])){
            if($_GET["val"]=="1"||$_GET["val"]=="2"){
                $_SESSION["val"]=$_GET["val"];
            }
            ?><script>location.href="productperview.php"</script><?php
        }
    ?>
</body>
</html>