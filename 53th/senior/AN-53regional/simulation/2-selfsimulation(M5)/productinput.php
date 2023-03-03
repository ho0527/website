<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>上架商品精靈</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
        <div class="header">
            <form class="headerform">
                <div class="headtitle">咖啡商品展示系統-填寫資料</div>
                <div class="headbut">
                    <input type="button" class="hbutton" onclick="location.href='signupedit.php'" value="新增">
                    <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbutton selectbut" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="hbutton" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="hbutton" name="logout" value="登出">
                </div>
            </form>
        </div>
        <div class="header">
            <div class="pdiv">
                <input type="button" class="pbutton" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="pbutton selectbut" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="pbutton" onclick="sub()" value="預覽">
                <input type="button" class="pbutton" onclick="nono()" value="確定送出">
                    <div style="float:right;">
                        <input type="button" class="pbutton" onclick="location.href='newproduct.php'" value="新增版型">
                    </div>
            </div>
        </div>
        <div class="maindiv">
            <form id="form" method="post" enctype="multipart/form-data">
                商品名稱: <input type="input" name="name" value="<?= @$_SESSION["name"] ?>"><br>
                費 用: <input type="input" name="cost" value="<?= @$_SESSION["cost"] ?>"><br>
                相關連結: <input type="input" name="link" value="<?= @$_SESSION["link"] ?>"><br>
                商品簡介: <textarea name="intr" cols="30" rows="3"></textarea><br>
                <input type="file" name="picture"><br>
                <input type="submit" name="clear" value="重設">
                <input type="submit" name="submit" value="送出">
            </form>
        </div>
        <?php
            include("link.php");
            if(isset($_POST["submit"])){
                $_SESSION["name"]=$_POST["name"];
                $_SESSION["link"]=$_POST["link"];
                $_SESSION["cost"]=$_POST["cost"];
                $_SESSION["intr"]=$_POST["intr"];
                if($_SESSION["name"]==""){
                    ?><script>alert("請輸入商品!");location.href="productinput.php"</script><?php
                }else{
                    if(!empty($_FILES["pictures"]["name"])){
                        move_uploaded_file($_FILES["pictures"]["tem_name"],"image/".$_FILES["picture"]["name"]);
                        $_SESSION["picture"]="image/".$_FILES["picture"]["name"];
                    }
                    header("location:productpreview.php");
                }
            }
            if(isset($_POST["clear"])){
                unset($_SESSION["name"]);
                unset($_SESSION["link"]);
                unset($_SESSION["cost"]);
                unset($_SESSION["intr"]);
                unset($_SESSION["picture"]);
                header("location:productinput.php");
            }
        ?>
        <script src="productindex.js"></script>
    </body>
</html>