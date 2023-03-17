<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>登入失敗</title>
        <link rel="stylesheet" href="index.css">
        <style>
            .main{
                width: 75%;
            }
        </style>
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){ header("main.php"); }
            unset($_SESSION["edit"]);
            unset($_SESSION["del"]);
            function data($p){
                if($p=="name"){
                    ?>商品名稱:<?= @$_SESSION["name"] ?><?php
                }elseif($p=="link"){
                    ?>相關連結:<?= @$_SESSION["link"] ?><?php
                }elseif($p=="cost"){
                    ?>費用:<?= @$_SESSION["cost"] ?><?php
                }elseif($p=="date"){
                    ?>發佈日期:(發佈後產生)<?php
                }else{
                    ?>商品簡介:<?= @$_SESSION["intr"] ?><?php
                }
            }
        ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="button" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="button selt" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <input type="button" class="button" onclick="location.href='productindex.php?clearall='" value="清除">
        <input type="button" class="button" onclick="location.href='productindex.php'" value="選擇版型">
        <input type="button" class="button" onclick="location.href='productinput.php'" value="填寫資料">
        <input type="button" class="button selt" onclick="location.href='productperview.php'" value="預覽">
        <input type="button" class="button" onclick="location.href='productsubmit.php'" value="確定送出"><br><br>
        <div class="main">
            <h2>預覽</h2>
                    <table class="producttable">
                        <?php
                            $val=$_SESSION["val"];
                            $product=fetchall(query($db,"SELECT*FROM `product`"));
                            for($j=0;$j<count($product);$j++){
                                ?>
                                <tr>
                                    <td class="producttd">
                                        <table class="coffeetable">
                                            <?php
                                                    if($val==$product[$j][0]&&$product[$j][1]=="picture"){
                                                        ?>
                                                        <tr>
                                                            <td class="coffee" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
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
                                                            <td class="coffee" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
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
                                                            <td class="coffee" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
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
                                                            <td class="coffee" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" alt="圖片" width="200px" height="175px"></td>
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
                        ?>
                    </table>
                    <?php
            ?>
        </div>
        <?php
            if(isset($_GET["val"])){
                if($_GET["val"]=="no"){
                    if(!isset($_SESSION["val"])){
                        $_SESSION["val"]="1";
                    }
                }else{
                    $_SESSION["val"]=$_GET["val"];
                }
                ?><script>location.href="productperview.php"</script><?php
            }else{
                if(!isset($_SESSION["val"])){
                    $_SESSION["val"]="1";
                    ?><script>location.href="productperview.php"</script><?php
                }
            }
        ?>
    </body>
</html>