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
            if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
            if(isset($_GET["id"])){
                $_SESSION["id"]=$_GET["id"];
            }
            $id=$_SESSION["id"];
            $row=query($db,"SELECT*FROM `coffee` WHERE `id`='$id'")[0];
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">咖啡商品展示系統-編輯商品</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查詢">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
            </div>
        </div>
        <div class="editmain macossectiondiv">
            <?php
                $productrow=query($db,"SELECT*FROM `product`");
                $count=0;
                for($i=0;$i<count($productrow);$i=$i+1){
                    $data="productleft";
                    if($count%2==0){ ?><div class="productdiv"><?php }
                    if($count%2==1){ $data="productright"; }
                    ?>
                    <div class="<?php echo($data); ?> product" id="<?= $productrow[$i][0] ?>">
                        <div class="id">版型: <?= $productrow[$i][0] ?></div>
                        <div class="name" style="<?php echo($productrow[$i][1]) ?>">商品名稱</div>
                        <div class="cost" style="<?php echo($productrow[$i][2]) ?>">費用</div>
                        <div class="date" style="<?php echo($productrow[$i][3]) ?>">發布日期</div>
                        <div class="link" style="<?php echo($productrow[$i][4]) ?>">相關連結</div>
                        <div class="introduction" style="<?php echo($productrow[$i][5]) ?>">商品簡介</div>
                        <div class="picture" style="<?php echo($productrow[$i][6]) ?>">圖片</div>
                    </div>
                    <?php
                    if($count%2==1||count($productrow)-1==$i){ ?></div><?php }
                    $count=$count+1;
                }
            ?>
        </div>
        <div class="editmaindiv xcenter">
            <form id="form" method="POST" enctype="multipart/form-data">
                商品名稱: <input type="text" class="input" name="name" value="<?= @$row[2] ?>"><br><br>
                費用: <input type="number" class="input" name="cost" placeholder="只能是數字" value="<?= @$row[4] ?>"><br><br>
                相關連結: <input type="text" class="input" name="link" placeholder="" value="<?= @$row[6] ?>"><br><br>
                <textarea name="introduction" cols="30" rows="4" placeholder="商品簡介"><?= @$row[3] ?></textarea><br><br>
                <input type="button" onclick="document.getElementById('file').click()" class="button" value="上傳圖片">
                <input type="button" onclick="location.href='main.php'" class="button" value="返回">
                <input type="button" onclick="location.href='productedit.php'" class="button" value="重設">
                <input type="submit" class="button" name="submit" value="完成"><br>
                <input type="file" class="file" name="picture" id="file" accept="image/*">
                <input type="hidden" name="val" id="val" value="">
            </form>
        </div>
        <?php
            if(isset($_POST["submit"])){
                @$name=$_POST["name"];
                @$introduction=$_POST["introduction"];
                @$cost=$_POST["cost"];
                @$link=$_POST["link"];
                @$picture=$_POST["picture"];
                @$val=$_POST["val"];
                if($name==""){
                    ?><script>alert("請輸入商品!");location.href="productedit.php"</script><?php
                }else{
                    if(!empty($_FILES["picture"]["name"])){
                        move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                        $picture="image/".$_FILES["picture"]["name"];
                        query($db,"UPDATE `coffee` SET `picture`=?,`name`=?,`introduction`=?,`cost`=?,`link`=?,`product`=? WHERE `id`='$id'",[$picture,$name,$introduction,$cost,$link,$val]);
                    }else{
                        query($db,"UPDATE `coffee` SET `name`=?,`introduction`=?,`cost`=?,`link`=?,`product`=? WHERE `id`='$id'",[$name,$introduction,$cost,$link,$val]);
                    }
                    ?><script>alert("修改完成!");location.href="main.php"</script><?php
                }
            }
        ?>
        <script> let valdata="<?php echo($row[7]); ?>"; </script>
        <script src="productedit.js"></script>
    </body>
</html>