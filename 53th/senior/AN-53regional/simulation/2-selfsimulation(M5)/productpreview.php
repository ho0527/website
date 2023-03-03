<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>上架商品精靈</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
            <div class="header">
                <form class="headerform">
                    <div class="headtitle">咖啡商品展示系統-預覽</div>
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
            <div class="header">
                <div class="pdiv">
                    <input type="button" class="pbutton" onclick="location.href='productindex.php'" value="選擇版型">
                    <input type="button" class="pbutton" onclick="location.href='productinput.php'" value="填寫資料">
                    <input type="button" class="pbutton selectbut" onclick="location.href='productpreview.php'" value="預覽">
                    <input type="button" class="pbutton" onclick="location.href='productsubmit.php'" value="確定送出">
                    <div style="float:right;">
                        <input type="button" class="pbutton" onclick="location.href='newproduct.php'" value="新增版型">
                    </div>
                </div>
            </div>
            <table class="maintable">
                <?php
                include("link.php");
                function data2($p){
                    if($p=="name"){
                        ?>商品名稱: <?= $_SESSION["name"] ?><?php
                    }elseif($p=="cost"){
                        ?>金額:  <?= $_SESSION["cost"] ?><?php
                    }elseif($p=="date"){
                        ?>發佈日期: (發布後產生)<?php
                    }elseif($p=="link"){
                        ?>相關連結: <?= $_SESSION["link"] ?><?php
                    }else{
                        ?>商品簡介: <?= $_SESSION["intr"] ?><?php
                    }
                }
                $val=$_SESSION["val"];
                $product=fetchall(query($db,"SELECT*FROM `product` WHERE `id`='$val'"));
                for($i=0;$i<count($product);$i++){
                    ?>
                        <tr>
                            <td class="producttd">
                                <table class="producttable">
                                    <?php
                                        if($product[$i][1]=="picture"){
                                            ?>
                                            <tr>
                                                <td class="coffeedata" rowspan="3">圖片</td>
                                                <td class="coffeedata"><?php data2($product[$i][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][4]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][7]) ?></td>
                                                <td class="coffeedata"><?php data2($product[$i][8]) ?></td>
                                            </tr>
                                            <?php
                                        }elseif($product[$i][2]=="picture"){
                                            ?>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][1]) ?></td>
                                                <td class="coffeedata" rowspan="3">圖片</td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][3]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][7]) ?></td>
                                                <td class="coffeedata"><?php data2($product[$i][8]) ?></td>
                                            </tr>
                                            <?php
                                        }elseif($product[$i][3]=="picture"){
                                            ?>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][1]) ?></td>
                                                <td class="coffeedata"><?php data2($product[$i][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata" rowspan="3"><img src="<?= $a[$i][3] ?>" width="175px" alt="圖片"></td>
                                                <td class="coffeedata"><?php data2($product[$i][4]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][8]) ?></td>
                                            </tr>
                                            <?php
                                        }elseif($product[$i][4]=="picture"){
                                            ?>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][1]) ?></td>
                                                <td class="coffeedata"><?php data2($product[$i][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][3]) ?></td>
                                                <td class="coffeedata" rowspan="3">圖片</td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeedata"><?php data2($product[$i][7]) ?></td>
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
    </body>
</html>