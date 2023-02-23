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
    <div class="pbar">
        <div class="pber2">
            <input type="button" class="pbut" onclick="location.href='productindex.php'" value="選擇版型">
            <input type="button" class="pbut" onclick="location.href='productinput.php'" value="填寫資料">
            <input type="button" class="pbut selectbut" onclick="location.href='productpreview.php'" value="預覽">
            <input type="button" class="pbut" onclick="location.href='productsubmit.php'" value="確定送出">
            <div style="float:right">
               <input type="button" onclick="location.href='newproduct.php'" value="新增版型">
            </div>
        </div>
    </div>
    <?php
        include("link.php");
        @$val=$_SESSION["val"];
        if(isset($val)){
            $a=fetchall(query($db,"SELECT*FROM `product` WHERE `id`='$val'"));
            function data2($a){
                if($a=="name"){
                    ?>商品名稱: <?= @$_SESSION["name"] ?><?php
                }elseif($a=="cost"){
                    ?>金額: <?= @$_SESSION["cost"] ?><?php
                }elseif($a=="date"){
                    ?>發佈日期: (發布後產生)<?php
                }elseif($a=="link"){
                    ?>相關連結: <?= @$_SESSION["link"] ?><?php
                }else{
                    ?>商品簡介: <?= @$_SESSION["introduction"] ?><?php
                }
            }
            for($i=0;$i<count($a);$i++){
                ?>
                <table class="maintable" id="version<?= $i+1 ?>">
                    <tr>
                        <td class="producttd">
                            <table class="show">
                                <?php
                                    if($a[$i][1]=="picture"){
                                        ?>
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= data2($a[$i][2]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][4]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][6]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][7]) ?></td>
                                            <td class="coffeedata"><?= data2($a[$i][8]) ?></td>
                                        </tr>
                                        <?php
                                    }elseif($a[$i][2]=="picture"){
                                        ?>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][1]) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][3]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][5]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][7]) ?></td>
                                            <td class="coffeedata"><?= data2($a[$i][8]) ?></td>
                                        </tr>
                                        <?php
                                    }elseif($a[$i][3]=="picture"){
                                        ?>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][1]) ?></td>
                                            <td class="coffeedata"><?= data2($a[$i][2]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= data2($a[$i][4]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][6]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][8]) ?></td>
                                        </tr>
                                        <?php
                                    }elseif($a[$i][4]=="picture"){
                                        ?>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][1]) ?></td>
                                            <td class="coffeedata"><?= data2($a[$i][2]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][3]) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][5]) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= data2($a[$i][7]) ?></td>
                                        </tr>
                                        <?php
                                    }
                                ?>`
                            </table>
                        </td>
                    </tr>
                </table>
                <?php
            }
        }else{
            ?><script>alert("請選擇版型!");location.href="productindex.php"</script><?php
        }
    ?>
   </body>
</html>