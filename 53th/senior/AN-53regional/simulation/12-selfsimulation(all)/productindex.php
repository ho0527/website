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
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <h1>咖啡商品展示系統</h1>
    <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="mainbutton selt" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="mainbutton" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查尋">
    <input type="button" class="mainbutton logout" onclick="location.href='link.php?logout='" value="登出">
    <hr>
    <input type="button" class="mainbutton selt" onclick="location.href='productindex.php'" value="選擇版型">
    <input type="button" class="mainbutton" onclick="check('productinput.php')" value="填寫資料">
    <input type="button" class="mainbutton" onclick="check('productpreview.php')" value="預覽">
    <input type="button" class="mainbutton" onclick="check('productsubmit.php')" value="確定送出">
    <div class="mag"></div>
    <div class="main">
        <h2>選擇版型</h2>
        <input type="button" class="mainbutton" onclick="location.href='newproduct.php'" value="新增版型">
        <table class="producttable">
            <?php
                function data2($data){
                    if($data=="name"){
                        ?>商品名稱:<?php
                    }elseif($data=="cost"){
                        ?>費用:<?php
                    }elseif($data=="link"){
                        ?>相關連結:<?php
                    }elseif($data=="date"){
                        ?>發佈日期:<?php
                    }else{
                        ?>商品簡介:<?php
                    }
                }

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
                                            <td class="coffee" rowspan="3">圖片</td>
                                            <td class="coffee"><?php data2($product[$j][2]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][4]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][6]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][7]) ?></td>
                                            <td class="coffee"><?php data2($product[$j][8]) ?></td>
                                        </tr>
                                        <?php
                                    }elseif($product[$j][2]=="picture"){
                                        ?>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][1]) ?></td>
                                            <td class="coffee" rowspan="3">圖片</td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][3]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][5]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][7]) ?></td>
                                            <td class="coffee"><?php data2($product[$j][8]) ?></td>
                                        </tr>
                                        <?php
                                    }elseif($product[$j][3]=="picture"){
                                        ?>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][1]) ?></td>
                                            <td class="coffee"><?php data2($product[$j][2]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee" rowspan="3">圖片</td>
                                            <td class="coffee"><?php data2($product[$j][4]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][6]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][8]) ?></td>
                                        </tr>
                                        <?php
                                    }elseif($product[$j][4]=="picture"){
                                        ?>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][1]) ?></td>
                                            <td class="coffee"><?php data2($product[$j][2]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][3]) ?></td>
                                            <td class="coffee" rowspan="3">圖片</td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][5]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data2($product[$j][7]) ?></td>
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
    <script src="product.js"></script>
</body>
</html>