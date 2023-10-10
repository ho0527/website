<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>管理者專區</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <script src="plugin/js/macossection.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["val"])){ $_SESSION["val"]=1; }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">咖啡商品展示系統-選擇版型</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
            </div>
        </div>
        <div class="productbar">
            <div class="productbardiv center">
                <input type="button" class="navigationbarbutton" onclick="location.href='newproduct.php'" value="新增版型">
                <input type="button" class="navigationbarbutton selectbut" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="navigationbarbutton" onclick="data()" value="填寫資料">
                <input type="button" class="navigationbarbutton" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="navigationbarbutton" onclick="location.href='productsubmit.php'" value="確定送出">
            </div>
        </div>
        <div class="productindexmain macossectiondiv">
            <?php
                $row=query($db,"SELECT*FROM `product`");
                $count=0;
                for($i=0;$i<count($row);$i=$i+1){
                    $data="productleft";
                    if($count%2==0){ ?><div class="productdiv"><?php }
                    if($count%2==1){ $data="productright"; }
                    ?>
                    <div class="<?php echo($data); ?> product macossectiondiv" id="<?= $row[$i][0] ?>">
                        <div class="id">版型: <?= $row[$i][0] ?></div>
                        <div class="name" style="<?php echo($row[$i][1]) ?>">商品名稱</div>
                        <div class="cost" style="<?php echo($row[$i][2]) ?>">費用</div>
                        <div class="date" style="<?php echo($row[$i][3]) ?>">發布日期</div>
                        <div class="link" style="<?php echo($row[$i][4]) ?>">相關連結</div>
                        <div class="introduction" style="<?php echo($row[$i][5]) ?>">商品簡介</div>
                        <div class="picture" style="<?php echo($row[$i][6]) ?>">圖片</div>
                    </div>
                    <?php
                    if($count%2==1||count($row)-1==$i){ ?></div><?php }
                    $count=$count+1;
                }

                if(isset($_GET["val"])){
                    if(isset($_SESSION["val"])){
                    ?><script>location.href="productinput.php"</script><?php
                    }else{
                    ?><script>alert("請先選擇版型!");location.href="productindex.php"</script><?php
                    }
                }
            ?>
        </div>
        <script src="productindex.js"></script>
        <script>
            document.getElementById("<?= $_SESSION["val"] ?>").style.backgroundColor="yellow"
        </script>
    </body>
</html>