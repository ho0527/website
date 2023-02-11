<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>管理者專區</title>
      <link href="index.css" rel="stylesheet">
   </head>
   <body>
        <div class="navigationbar">
            <div class="navigationbardiv">
                <form>
                咖啡商品展示系統-確定送出
                <input type="button" class="adminbutton" onclick="location.href='signup.php'" value="新增">
                <input type="button" class="adminbutton" onclick="location.href='adminWelcome.php'" value="首頁">
                <input type="button" class="adminbutton selectbut" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
                <input type="submit" class="adminbutton" name="logout" value="登出">
                </form>
            </div>
        </div>
        <div class="productbar">
           <div class="productbardiv">
                <input type="button" class="productbutton" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="productbutton" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="productbutton" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="productbutton selectbut" onclick="location.href='productsubmit.php'" value="確定送出">
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
            @$val=$_SESSION["val"];
            @$picture=$_SESSION["picture"];
            if(isset($_GET["check"])){
                query($db,"INSERT INTO `coffee`(`picture`, `name`, `introduction`, `cost`, `date`, `link`, `version`) VALUES('$picture','$name','$introduction','$cost','$time','$link','$val')");
                unset($_SESSION["name"]);
                unset($_SESSION["introduction"]);
                unset($_SESSION["cost"]);
                unset($_SESSION["link"]);
                unset($_SESSION["val"]);
                unset($_SESSION["picture"]);
                ?><script>alert("完成!");location.href="adminWelcome.php"</script><?php
            }
            if(isset($_GET["nono"])){
                unset($_SESSION["name"]);
                unset($_SESSION["introduction"]);
                unset($_SESSION["cost"]);
                unset($_SESSION["link"]);
                unset($_SESSION["val"]);
                unset($_SESSION["picture"]);
                ?><script>alert("完成!");location.href="adminWelcome.php"</script><?php
            }
        ?>
   </body>
</html>