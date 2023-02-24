<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>上架商品精靈</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <form>
            <div class="nbar">
                <div class="title">咖啡商品管理系統-填寫資料</div>
                <div class="divbut">
                    <input type="button" class="hbutton" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbutton selt" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="hbutton" onclick="location.href='serch.php'" value="查詢">
                    <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="hbutton" name="logout" value="登出">
                </div>
            </div>
            <div class="pbar">
                <div class="pbut">
                    <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="選擇版型">
                    <input type="button" class="hbutton selt" onclick="location.href='productinput.php'" value="填寫資料">
                    <input type="button" class="hbutton" onclick="location.href='productpreview.php'" value="預覽">
                    <input type="button" class="hbutton" onclick="location.href='productsubmit.php'" value="確定送出">
                        <div style="float:right">
                            <input type="button" onclick="location.href='newproduct.php'" class="hbutton" value="新增版型">
                        </div>
                </div>
            </div>
        </form>
        <div class="main">
        <form>
            商品名稱: <input type="text" name="name" id="name"><br>
            費用: <input type="text" name="cost" id="name"><br>
            相關連結: <input type="text" name="link" id="name"><br>
            商品簡介:<br> <textarea name="intr" id="" cols="30" rows="3"></textarea><br>
            <input type="file" name="" id="" style="width:175px">
            <input type="submit" name="clear" onclick="location.reload()" value="清除">
            <input type="submit" name="new" value="送出">   
        </form>
    </div>
    <?php
        include("link.php");
        if(isset($_GET["new"])){
            $_SESSION["name"]=$_GET["name"];
            $_SESSION["cost"]=$_GET["cost"];
            $_SESSION["link"]=$_GET["link"];
            $_SESSION["intr"]=$_GET["intr"];
            header("location:productpreview.php");
        }
    ?>
    <script src="product.js"></script>
    </body>
</html>