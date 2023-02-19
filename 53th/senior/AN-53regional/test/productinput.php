<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php include("link.php");?>
    <div class="header">
        <form action="" class="headerform">
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
    <div class="pbar">
        <div class="pber2">
            <input type="button" class="pbut" onclick="location.href='productindex.php'" value="選擇版型">
            <input type="button" class="pbut selectbut" onclick="location.reload()" value="填寫資料">
            <input type="button" class="pbut" onclick="sub()" value="預覽">
            <input type="button" class="pbut" onclick="no()" value="確定送出">
            <div style="float:right">
               <button onclick="location.href='newproduct.php'">新增版型</button>
            </div>
        </div>
    </div>
    <div class="productinput">
        <form id="form" method="POST" enctype="multipart/form-data">
            商品名稱: <input type="text" class="input" name="name" value="<?= @$_SESSION["name"] ?>"><br>
            費用: <input type="number" class="input" name="cost" placeholder="只能是數字" value="<?= @$_SESSION["cost"] ?>"><br>
            相關連結: <input type="text" class="input" name="link" value="<?= @$_SESSION["link"] ?>"><br>
            <textarea name="introduction" cols="30" rows="4" placeholder="商品簡介"><?= @$_SESSION["introduction"] ?></textarea><br>
            <input type="file" name="picture" accept="image/*" ><br>
            <input type="button" onclick="location.href='productinput.php?clear='" class="button" value="重設">
            <input type="submit" class="button" name="submit" value="完成"><br>
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