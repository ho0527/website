<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>電子競技網站管理</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
            unset($_SESSION["edit"]);
            unset($_SESSION["pedit"]);
            unset($_SESSION["del"]);
            function data($p){
                if($p=="name"){
                    ?>商品名稱<?php
                }elseif($p=="link"){
                    ?>相關連結<?php
                }elseif($p=="cost"){
                    ?>費用<?php
                }elseif($p=="date"){
                    ?>發佈日期<?php
                }else{
                    ?>商品簡介<?php
                }
            }
        ?>
        <div class="navigationbar">
            <div class="maintitle">電子競技網站管理-選擇版型</div>
            <div class="navigationbarbuttondiv">
                <input type="button" class="navigationbarbutton" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="navigationbarbutton selectbutton" onclick="location.href='productindex.php'" value="電競活動管理精靈">
                <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查尋">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='link.php?logout='" value="登出">
            </div>
        </div>
        <div class="productbar">
            <div class="center">
                <input type="button" class="navigationbarbutton selectbutton" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="navigationbarbutton" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="navigationbarbutton" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="navigationbarbutton" onclick="location.href='productsumbit.php'" value="確定送出">
                <input type="button" class="navigationbarbutton" onclick="check('newproduct.php')" value="新增版型">
            </div>
        </div>
        <div class="mainbody">
            <table class="producttable">
                        <?php
                            $product=fetchall(query($db,"SELECT*FROM `product`"));
                            for($j=0;$j<count($product);$j++){
                                ?>
                                <tr>
                                    <td class="producttd">
                                        版型<?= $product[$j][0] ?>
                                        <table class="coffeetable mag" id="<?= $product[$j][0] ?>">
                                            <?php
                                                    if($product[$j][1]=="picture"){
                                                        ?>
                                                        <tr>
                                                            <td class="coffee" rowspan="3">圖片</td>
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
                                                    }elseif($product[$j][2]=="picture"){
                                                        ?>
                                                        <tr>
                                                            <td class="coffee"><?php data($product[$j][1]); ?></td>
                                                            <td class="coffee" rowspan="3">圖片</td>
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
                                                    }elseif($product[$j][3]=="picture"){
                                                        ?>
                                                        <tr>
                                                            <td class="coffee"><?php data($product[$j][1]); ?></td>
                                                            <td class="coffee"><?php data($product[$j][2]); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="coffee" rowspan="3">圖片</td>
                                                            <td class="coffee"><?php data($product[$j][4]); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="coffee"><?php data($product[$j][6]); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="coffee"><?php data($product[$j][8]); ?></td>
                                                        </tr>
                                                        <?php
                                                    }elseif($product[$j][4]=="picture"){
                                                        ?>
                                                        <tr>
                                                            <td class="coffee"><?php data($product[$j][1]); ?></td>
                                                            <td class="coffee"><?php data($product[$j][2]); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="coffee"><?php data($product[$j][3]); ?></td>
                                                            <td class="coffee" rowspan="3">圖片</td>
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
                            if(isset($_GET["clearall"])){
                                unset($_SESSION["name"]);
                                unset($_SESSION["picture"]);
                                unset($_SESSION["cost"]);
                                unset($_SESSION["link"]);
                                unset($_SESSION["intr"]);
                                unset($_SESSION["val"]);
                                ?><script>location.href="main.php"</script><?php
                            }
                        ?>
                    </table>
                </div>
        <script src="product.js"></script>
        <script>
            document.getElementById(<?= $_SESSION["val"] ?>).style.backgroundColor="rgb(203, 203, 38)"
        </script>
    </body>
</html>