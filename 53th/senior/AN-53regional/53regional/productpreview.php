<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>管理者專區</title>
      <link href="index.css" rel="stylesheet">
   </head>
   <body>
        <div class="navigationbar">
            <form class="navigationbardiv">
                咖啡商品展示系統-&nbsp&nbsp預覽&nbsp&nbsp
                <input type="button" class="adminbutton" onclick="location.href='signupedit.php'" value="新增">
                <input type="button" class="adminbutton" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="adminbutton selectbut" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="adminbutton" onclick="location.href='search.php'" value="查詢">
                <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
                <input type="submit" class="adminbutton" name="logout" value="登出">
            </form>
        </div>
        <div class="productbar">
           <div class="productbardiv">
                <input type="button" class="productbutton" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="productbutton" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="productbutton selectbut" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="productbutton" onclick="location.href='productsubmit.php'" value="確定送出">
           </div>
        </div>
        <?php
            include("link.php");
            @$val=$_SESSION["val"];
            if(isset($val)){
                $a=fetchall(query($db,"SELECT*FROM `product` WHERE `id`='$val'"));
                function ifadta2($a,$i,$data){
                    if($a[$i][$data]=="name"){
                        ?>商品名稱: <?= $_SESSION["name"] ?><?php
                    }elseif($a[$i][$data]=="cost"){
                        ?>金額: <?= $_SESSION["cost"] ?><?php
                    }elseif($a[$i][$data]=="date"){
                        ?>發佈日期: (發佈後產生)<?php
                    }elseif($a[$i][$data]=="link"){
                        ?>相關連結: <?= $_SESSION["link"] ?><?php
                    }else{
                        ?>商品簡介: <?= $_SESSION["introduction"] ?><?php
                    }
                }
                for($i=0;$i<count($a);$i=$i+1){
                    ?>
                    <table class="maintable" id="version<?= $i+1 ?>">
                        <tr>
                            <td class="producttd">
                                <?php
                                if($a[$i][1]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= ifadta2($a,$i,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,4) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,6) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,7) ?></td>
                                            <td class="coffeedata"><?= ifadta2($a,$i,8) ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }elseif($a[$i][2]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,1) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,3) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,5) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,7) ?></td>
                                            <td class="coffeedata"><?= ifadta2($a,$i,8) ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }elseif($a[$i][3]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,1) ?></td>
                                            <td class="coffeedata"><?= ifadta2($a,$i,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= ifadta2($a,$i,4) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,6) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,8) ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }else{
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,1) ?></td>
                                            <td class="coffeedata"><?= ifadta2($a,$i,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,3) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$_SESSION["picture"] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,5) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifadta2($a,$i,7) ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }
                                ?>
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