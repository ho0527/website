<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewp or t" content="width=device-width, initial-scale=1.0">
    <title>上架產品精靈</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="head">
            <div class="title">咖啡商品展示系統-選擇版型</div>
            <div class="hbut">
                <form action="">
                    <input type="button" class="headbut" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="headbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="headbut selt" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="headbut" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="headbut" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="headbut" name="logout" value="登出">
                </form>
            </div>
        </div>
        <div class="pbar">
            <form action="">
                <input type="button" class="headbut selt" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="headbut" onclick="check()" value="填寫資料">
                <input type="button" class="headbut" onclick="nono()" value="預覽">
                <input type="button" class="headbut" onclick="nono()" value="確定送出">
                <div style="float:right;">
                    <input type="button" class="headbut" onclick="location.href='newproduct.php'" value="新增版型">
                </div>
            </form>
        </div>
        <table class="productindextable">
            <?php
            function data2($product){
                if($product=="name"){
                    ?>商品名稱:<?php
                }elseif($product=="link"){
                    ?>相觀連結:<?php
                }elseif($product=="cost"){
                    ?>費用:0000<?php
                }elseif($product=="date"){
                    ?>發佈日期:<?php
                }else{
                    ?>商品簡介:<?php
                }
            }
            $product=fetchall(query($db,"SELECT*FROM `product`"));
            for($j=0;$j<count($product);$j=$j+1){
                ?>
                <tr>
                    <td class="producttd">
                        <table class="coffeetable" id="<?= $product[$j][0] ?>">
                            <?php
                            if($product[$j][1]=="picture"){
                                ?>
                                <tr>
                                    <td class="coffeetd" rowspan="3">圖片</td>
                                    <td class="coffeetd"><?php data2($product[$j][2]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][4]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][6]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][7]); ?></td>
                                    <td class="coffeetd"><?php data2($product[$j][8]); ?></td>
                                </tr>
                                <?php
                            }elseif($product[$j][2]=="picture"){
                                ?>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][1]); ?></td>
                                    <td class="coffeetd" rowspan="3">圖片</td>
                                </tr>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][3]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][5]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][7]); ?></td>
                                    <td class="coffeetd"><?php data2($product[$j][8]); ?></td>
                                </tr>
                                <?php
                            }elseif($product[$j][3]=="picture"){
                                ?>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][1]); ?></td>
                                    <td class="coffeetd"><?php data2($product[$j][2]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeetd" rowspan="3">圖片</td>
                                    <td class="coffeetd"><?php data2($product[$j][4]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][6]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][8]); ?></td>
                                </tr>
                                <?php
                            }elseif($product[$j][4]=="picture"){
                                ?>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][1]); ?></td>
                                    <td class="coffeetd"><?php data2($product[$j][2]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][3]); ?></td>
                                    <td class="coffeetd" rowspan="3">圖片</td>
                                </tr>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][5]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeetd"><?php data2($product[$j][7]); ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <div class="text">這是版型<?= $product[$j][0] ?></div>
                        </table>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <script src="product.js"></script>
</body>
</html>