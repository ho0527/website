<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>上架商品精靈</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <form>
            <div class="nbar">
                <div class="title">咖啡商品管理系統-選擇版型</div>
                <div class="divbut">
                    <input type="button" class="hbutton" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbutton selt" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="hbutton" onclick="location.href='serch.php'" value="查詢">
                    <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="hbutton" name="logout" value="登出">
                </div>
            </div>
            <div class="pbar">
                <div class="pbut">
                    <input type="button" class="hbutton selt" onclick="location.href='productindex.php'" value="選擇版型">
                    <input type="button" class="hbutton" onclick="data()" value="填寫資料">
                    <input type="button" class="hbutton" onclick="nono()" value="預覽">
                    <input type="button" class="hbutton" onclick="nono()" value="確定送出">
                    <div style="float:right">
                        <input type="button" onclick="location.href='newproduct.php'" class="hbutton" value="新增版型">
                    </div>
                </div>
            </div>
        </form>
        <table class="maintable">
            <?php
                include("link.php");
                function data2($p){
                    if($p=="name"){
                        ?>商品名稱<?php
                    }elseif($p=="link"){
                        ?>相關連結<?php
                    }elseif($p=="cost"){
                        ?>費用:0000<?php
                    }elseif($p=="date"){
                        ?>發佈日期<?php
                    }else{
                        ?>商品簡介<?php
                    }
                }
            
                $product=fetchall(query($db,"SELECT*FROM `product`"));
                for($i=0;$i<count($product);$i++){
                    ?>
                    <tr>
                        <td class="ptd">
                            <table class="coffeetable" id="v<?= $product[$i][0] ?>">
                                <?php
                                    if($product[$i][1]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd" rowspan="3">圖片</td>
                                                <td class="coffeetd"><?php data2($product[$i][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][4]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][7]) ?></td>
                                                <td class="coffeetd"><?php data2($product[$i][8]) ?></td>
                                            </tr>
                                        <?php
                                    }elseif($product[$i][2]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][1]) ?></td>
                                                <td class="coffeetd" rowspan="3">圖片</td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][3]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][7]) ?></td>
                                                <td class="coffeetd"><?php data2($product[$i][8]) ?></td>
                                            </tr>
                                        <?php
                                    }elseif($product[$i][3]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][1]) ?></td>
                                                <td class="coffeetd"><?php data2($product[$i][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd" rowspan="3">圖片</td>
                                                <td class="coffeetd"><?php data2($product[$i][4]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][8]) ?></td>
                                            </tr>
                                        <?php
                                    }elseif($product[$i][4]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][1]) ?></td>
                                                <td class="coffeetd"><?php data2($product[$i][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][3]) ?></td>
                                                <td class="coffeetd" rowspan="3">圖片</td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data2($product[$i][7]) ?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
                if(isset($_GET["val"])){
                    if($val!="no"){
                        $_SESSION["val"]=$_GET["val"];
                        ?><script>location.href="productinput.php"</script><?php
                    }else{
                        if(isset($_SESSION["val"])){
                            ?><script>location.href="productinput.php"</script><?php

                        }else{
                            ?><script>alert("請先選擇版型");location.href="productindex.php"</script><?php
                        }
                    }
                }
                ?>
        </table>
        <script src="product.js"></script>
    </body>
</html>