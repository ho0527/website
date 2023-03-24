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
        }
        table{
            width: 90%;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        function data($p){
            if($p=="name"){
                ?>商品名稱 <?= $_SESSION["name"] ?><?php
            }elseif($p=="link"){
                ?>相關連結 <?= $_SESSION["link"] ?><?php
            }elseif($p=="cost"){
                ?>費用 <?= $_SESSION["cost"] ?><?php
            }elseif($p=="time"){
                ?>發佈日期(發佈後產生)<?php
            }else{
                ?>商品簡介 <?= $_SESSION["intr"] ?><?php
            }
        }
    ?>
    <h1>咖啡商品展示系統</h1>
    <input type="button" class="but selt" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="but" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
    <hr>
    <input type="button" class="but" onclick="location.href='productindex.php'" value="選擇版型">
    <input type="button" class="but" onclick="location.href='productinput.php'" value="填寫資料">
    <input type="button" class="but selt" onclick="location.href='productperview.php'" value="預覽">
    <input type="button" class="but" onclick="location.href='productsubmit.php'" value="確定送出"><br><br>
    <div class="main">
        <h2>選擇版型</h2>
        <table class="ptable">
            <?php
            $product=fetchall(query($db,"SELECT*FROM `product`"));
            $val=$_SESSION["val"];
            for($j=0;$j<count($product);$j++){
            ?>
            <tr>
                <td>
                    <table class="ctable">
                        <?php
                            if($val==$product[$j][0]&&$product[$j][1]=="picture"){
                                ?>
                                    <tr>
                                    <td class="coffee" rowspan="3"><img src="<?= $_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
                                    <td class="coffee"><?php data($product[$j][2]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][4]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][6]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][7]); ?></td>
                                    <td class="coffee"><?php data($product[$j][8]); ?></td>
                                </tr>
                                <?php
                            }elseif($val==$product[$j][0]&&$product[$j][2]=="picture"){
                                ?>
                                    <tr>
                                        <td class="coffee"><?php data($product[$j][1]); ?></td>
                                        <td class="coffee" rowspan="3"><img src="<?= $_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][3]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][5]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][7]); ?></td>
                                    <td class="coffee"><?php data($product[$j][8]); ?></td>
                                </tr>
                                <?php
                            }elseif($val==$product[$j][0]&&$product[$j][3]=="picture"){
                                ?>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][1]); ?></td>
                                    <td class="coffee"><?php data($product[$j][2]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee" rowspan="3"><img src="<?= $_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
                                    <td class="coffee"><?php data($product[$j][4]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][6]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][8]); ?></td>
                                </tr>
                                <?php
                            }elseif($val==$product[$j][0]&&$product[$j][4]=="picture"){
                                ?>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][1]); ?></td>
                                    <td class="coffee"><?php data($product[$j][2]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][3]); ?></td>
                                    <td class="coffee" rowspan="3"><img src="<?= $_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][5]); ?></td>
                                </tr>
                                <tr>
                                    <td class="coffee"><?php data($product[$j][7]); ?></td>
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
                $_SESSION["val"]=$_GET["val"];
                ?><script>location.href="productperview.php"</script><?php
            }
            ?>
        </table>
    </div>
</body>
</html>