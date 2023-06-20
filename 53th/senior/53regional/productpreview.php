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
                <div class="navigationbartitle">咖啡商品展示系統-預覽</div>
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
                <input type="button" class="navigationbarbutton selectbut" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="navigationbarbutton" onclick="location.href='productsubmit.php'" value="確定送出">
            </div>
        </div>
        <?php
            if(isset($_SESSION["val"])){
                $val=$_SESSION["val"];
                $row=query($db,"SELECT*FROM `product` WHERE `id`='$val'")[0];
                $count=0;
                ?>
                <div class="productmain">
                    <div class="productdiv">
                        <div class="productmid product">
                            <div class="name macossectiondiv" style="<?php echo($row[1]) ?>">商品名稱: <?php echo($_SESSION["name"]); ?></div>
                            <div class="cost macossectiondiv" style="<?php echo($row[2]) ?>">費用: <?php echo($_SESSION["cost"]); ?></div>
                            <div class="date macossectiondiv" style="<?php echo($row[3]) ?>">發布日期: 發布後產生</div>
                            <div class="link macossectiondiv" style="<?php echo($row[4]) ?>">相關連結: <?php echo($_SESSION["link"]); ?></div>
                            <div class="introduction macossectiondiv" style="<?php echo($row[5]) ?>">
                                商品簡介
                                <br><?php echo($_SESSION["introduction"]); ?>
                            </div>
                            <div class="picture macossectiondiv" style="<?php echo($row[6]) ?>"><img src="<?php echo($_SESSION["picture"]); ?>" width="175px" height="150px"></div>
                        </div>
                    </div>
                </div>
                <?php
            }else{
                ?><script>alert("請選擇版型!");location.href="productindex.php"</script><?php
            }
        ?>
   </body>
</html>