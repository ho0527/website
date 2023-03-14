<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 75%;
            max-height: 600px;
            height: 600px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        function data($p){
            if($p=="name"){
                ?>商品名稱:<?php
            }elseif($p=="cost"){
                ?>費用:<?php
            }elseif($p=="link"){
                ?>相關連結<?php
            }elseif($p=="date"){
                ?>發佈日期<?php
            }else{
                ?>商品簡介<?php
            }
        }
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
            ?>
            <h1>網站前台登入頁面</h1>
            <input type="button" class="mbutton" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mbutton selt" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mbutton" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="mbutton logout" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <input type="button" class="mbutton" onclick="location.href='productindex.php?clearall='" value="取消"><br><br>
            <input type="button" class="mbutton selt" onclick="location.href='productindex.php'" value="選擇版型">
            <input type="button" class="mbutton" onclick="check('productinput.php')" value="填寫資料">
            <input type="button" class="mbutton" onclick="check('productperview.php')" value="預覽">
            <input type="button" class="mbutton" onclick="check('productsubmit.php')" value="確定送出">
            <br><br>
            <div class="main">
                <h2 class="">選擇版型</h2>
                <input type="button" class="mbutton mag" onclick="check('newproduct.php')" value="新增版型">
                <table class="producttable">
                    <?php
                        $product=fetchall(query($db,"SELECT*FROM `product`"));
                        for($j=0;$j<count($product);$j++){
                            ?>
                            <tr>
                                <td class="producttd">
                                    這是版型<?= $product[$j][0] ?>
                                    <table class="coffeetable" id="<?= $product[$j][0] ?>">
                                        <?php
                                            if($product[$j][1]=="picture"){
                                                ?>
                                                <tr>
                                                    <td class="coffeetd" rowspan="3">圖片</td>
                                                    <td class="coffeetd"><?php data($product[$j][2]); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][4]); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][6]); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][7]); ?></td>
                                                    <td class="coffeetd"><?php data($product[$j][8]); ?></td>
                                                </tr>
                                                <?php
                                            }elseif($product[$j][2]=="picture"){
                                                ?>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][1]); ?></td>
                                                    <td class="coffeetd" rowspan="3">圖片</td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][3]); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][5]); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][7]); ?></td>
                                                    <td class="coffeetd"><?php data($product[$j][8]); ?></td>
                                                </tr>
                                                <?php
                                            }elseif($product[$j][3]=="picture"){
                                                ?>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][1]); ?></td>
                                                    <td class="coffeetd"><?php data($product[$j][2]); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd" rowspan="3">圖片</td>
                                                    <td class="coffeetd"><?php data($product[$j][4]); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][6]); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][8]); ?></td>
                                                </tr>
                                                <?php
                                            }elseif($product[$j][4]=="picture"){
                                                ?>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][1]); ?></td>
                                                    <td class="coffeetd"><?php data($product[$j][2]); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][3]); ?></td>
                                                    <td class="coffeetd" rowspan="3">圖片</td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][5]); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="coffeetd"><?php data($product[$j][7]); ?></td>
                                                </tr>
                                                <?php
                                            }
                                        
                                        ?>
                                    </table>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>

    <?php
        if(isset($_GET["clearall"])){
            unset($_SESSION["name"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["link"]);
            unset($_SESSION["intr"]);
            unset($_SESSION["picture"]);
            unset($_SESSION["val"]);
            ?><script>location.href="main.php"</script><?php
        }
        if(isset($_GET["val"])){
            if($_GET["val"]=="no"){
                if(!isset($_SESSION["val"])){
                    $_SESSION["val"]="1";
                }
            }else{
                $_SESSION["val"]=$_GET["val"];
            }
            ?><script>location.href="productindex.php"</script><?php
        }else{
            if(!isset($_SESSION["val"])){
                $_SESSION["val"]="1";
                ?><script>location.href="productindex.php"</script><?php
            }
        }
    ?>
    <script src="product.js"></script>
</body>
</html>