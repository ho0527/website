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
                <div class="navigationbartitle">咖啡商品展示系統-確定送出</div>
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
                <input type="button" class="navigationbarbutton" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="navigationbarbutton" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="navigationbarbutton selectbut" onclick="location.href='productsubmit.php'" value="確定送出">
            </div>
        </div>
        <div class="main" id="version1">
            <form>
                是否確定送出?<br>
                <input type="submit" class="button" name="submit" value="確定">
                <input type="submit" class="button" name="submit" value="取消">
            </form>
        </div>
        <?php
            if(!isset($_SESSION["name"])){ $_SESSION["name"]=""; }
            if(!isset($_SESSION["introduction"])){ $_SESSION["introduction"]=""; }
            if(!isset($_SESSION["cost"])){ $_SESSION["cost"]=""; }
            if(!isset($_SESSION["link"])){ $_SESSION["link"]=""; }
            if(!isset($_SESSION["val"])){ $_SESSION["val"]=""; }
            if(!isset($_SESSION["picture"])){ $_SESSION["picture"]=""; }
            $name=$_SESSION["name"];
            $introduction=$_SESSION["introduction"];
            $cost=$_SESSION["cost"];
            $link=$_SESSION["link"];
            $val=$_SESSION["val"];
            $picture=$_SESSION["picture"];
            if(isset($_GET["submit"])){
                if($_GET["submit"]=="確定"){
                    query($db,"INSERT INTO `coffee`(`picture`,`name`,`introduction`,`cost`,`date`,`link`,`product`)VALUES(?,?,?,?,?,?,?)",[$picture,$name,$introduction,$cost,$time,$link,$val]);
                }
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