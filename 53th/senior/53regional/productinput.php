<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>管理者專區</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">咖啡商品展示系統-填寫資料</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查詢">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
            </div>
        </div>
        <div class="productbar">
            <div class="productbardiv center">
                <input type="button" class="navigationbarbutton" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="navigationbarbutton selectbut" onclick="data()" value="填寫資料">
                <input type="button" class="navigationbarbutton" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="navigationbarbutton" onclick="nono()" value="確定送出">
            </div>
        </div>
        <div class="main">
            <form id="form" method="POST" enctype="multipart/form-data">
                商品名稱: <input type="text" class="input" name="name" value="<?= @$_SESSION["name"] ?>"><br><br>
                費用: <input type="number" class="input" name="cost" placeholder="只能是數字" value="<?= @$_SESSION["cost"] ?>"><br><br>
                相關連結: <input type="text" class="input" name="link" value="<?= @$_SESSION["link"] ?>"><br><br>
                <textarea name="introduction" cols="30" rows="4" placeholder="商品簡介"><?= @$_SESSION["introduction"] ?></textarea><br><br>
                <input type="button" onclick="document.getElementById('file').click()" class="button" value="重設">
                <input type="button" onclick="location.href='productinput.php?clear='" class="button" value="重設">
                <input type="submit" class="button" name="submit" value="完成">
                <input type="file" class="file" name="picture" id="file" accept="image/*" >
            </form>
        </div>
        <?php
            if(isset($_POST["submit"])){
                @$_SESSION["name"]=$_POST["name"];
                @$_SESSION["introduction"]=$_POST["introduction"];
                @$_SESSION["cost"]=$_POST["cost"];
                @$_SESSION["link"]=$_POST["link"];
                if($_SESSION["name"]==""){
                    ?><script>alert("請輸入商品!");location.href="productinput.php"</script><?php
                }else{
                    if(!empty($_FILES["picture"]["name"])){
                        move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                        $_SESSION["picture"]="image/".$_FILES["picture"]["name"];
                    }
                    header("location:productpreview.php");
                }
            }
            if(isset($_GET["clear"])){
                unset($_SESSION["name"]);
                unset($_SESSION["introduction"]);
                unset($_SESSION["cost"]);
                unset($_SESSION["link"]);
                unset($_SESSION["val"]);
                unset($_SESSION["picture"]);
                header("location:productinput.php");
            }
            if(isset($_GET["val"])){
                $_SESSION["val"]=$_GET["val"];
                header("location:productinput.php");
            }
        ?>
        <script src="productindex.js"></script>
   </body>
</html>