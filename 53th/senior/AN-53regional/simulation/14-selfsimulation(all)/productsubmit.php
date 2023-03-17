<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>登入失敗</title>
        <link rel="stylesheet" href="index.css">
        <style>
            .main{
                width: 75%;
            }
        </style>
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){ header("main.php"); }
            unset($_SESSION["edit"]);
            unset($_SESSION["del"]);
        ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="button" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="button selt" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <input type="button" class="button" onclick="location.href='productindex.php?clearall='" value="清除">
        <input type="button" class="button" onclick="location.href='productindex.php'" value="選擇版型">
        <input type="button" class="button" onclick="location.href='productinput.php'" value="填寫資料">
        <input type="button" class="button" onclick="location.href='productperview.php'" value="預覽">
        <input type="button" class="button selt" onclick="location.href='productsubmit.php'" value="確定送出"><br><br>
        <div class="main">
            <form action="">
                <h2>確定送出</h2>
                <br>
                <p>請您再確認是否送出</p>
                <input type="submit" name="submit" value="取消">
                <input type="submit" name="submit" value="送出">
            </form>
        </div>
        <?php
            if(isset($_GET["submit"])){
                if($_GET["submit"]=="送出"){
                    $picture=$_SESSION["picture"];
                    $name=$_SESSION["name"];
                    $link=$_SESSION["link"];
                    $cost=$_SESSION["cost"];
                    $intr=$_SESSION["intr"];
                    $val=$_SESSION["val"];
                    query($db,"INSERT INTO `coffee`(`picture`,`name`,`link`,`cost`,`date`,`intr`,`val`)VALUES('$picture','$name','$link','$cost','$time','$intr','$val')");
                }
                ?><script>alert("上傳成功");location.href='productindex.php?clearall='</script><?php
            }
            if(isset($_GET["val"])){
                if($_GET["val"]=="no"){
                    if(!isset($_SESSION["val"])){
                        $_SESSION["val"]="1";
                    }
                }else{
                    $_SESSION["val"]=$_GET["val"];
                }
                ?><script>location.href="productsubmit.php"</script><?php
            }else{
                if(!isset($_SESSION["val"])){
                    $_SESSION["val"]="1";
                    ?><script>location.href="productsubmit.php"</script><?php
                }
            }
        ?>
    </body>
</html>