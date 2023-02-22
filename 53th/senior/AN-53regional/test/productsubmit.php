<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>管理者專區</title>
        <link rel="stylesheet" href="index.css">
   </head>
   <body>
        <div class="header">
            <form class="headerform">
                <div class="headtitle">咖啡商品展示系統-確定送出</div>
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
                <input type="button" class="pbut" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="pbut" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="pbut selectbut" onclick="location.href='productsubmit.php'" value="確定送出">
                <div style="float:right">
                    <button onclick="location.href='newproduct.php'">新增版型</button>
                </div>
            </div>
        </div>
        <div class="check" id="version1">
            <form>
                確定?<br>
                <input type="submit" name="check" value="確定">
                <input type="submit" name="nono" value="取消">
            </form>
        </div>
        <?php
            include("link.php");
            @$name=$_SESSION["name"];
            @$introduction=$_SESSION["introduction"];
            @$cost=$_SESSION["cost"];
            @$link=$_SESSION["link"];
            @$picture=$_SESSION["picture"];
            @$val=$_SESSION["val"];
            if(isset($_GET["check"])){
                query($db,"INSERT INTO `coffee`(`picture`, `name`, `introduction`, `cost`, `date`, `link`, `version`) VALUES('$picture','$name','$introduction','$cost','$time','$link','$val')");
                unset($_SESSION["name"]);
                unset($_SESSION["introduction"]);
                unset($_SESSION["cost"]);
                unset($_SESSION["link"]);
                unset($_SESSION["val"]);
                unset($_SESSION["picture"]);
                ?><script>alert("完成!");location.href="main.php"</script><?php
            }
            if(isset($_GET["nono"])){
                unset($_SESSION["name"]);
                unset($_SESSION["introduction"]);
                unset($_SESSION["cost"]);
                unset($_SESSION["link"]);
                unset($_SESSION["val"]);
                unset($_SESSION["picture"]);
                ?><script>alert("完成!");location.href="main.php"</script><?php
            }
        ?>
   </body>
</html>