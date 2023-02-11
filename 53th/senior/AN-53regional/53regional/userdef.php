<?php
    function product($db){
        $a=fetchall($db);
        for($i=0;$i<count($a)-1;$i=$i+1){
            for($j=0;$j<count($a)-$i-1;$j=$j+1){
                if($a[$j][0]<$a[$j+1][0]){
                    $tamp=$a[$j];
                    $a[$j]=$a[$j+1];
                    $a[$j+1]=$tamp;
                }
            }
        }
        for($i=0;$i<count($a);$i=$i+1){
            ?>
            <tr>
                <td class="producttd">
                    <?php
                        if($a[$i][7]==1){
                            ?>
                            <div class="version" id="version1" style="top: 0px;left: 35%;transform: scale(1);">
                                <div class="name" style="top: 5px;left: 20px;">商品名稱:<?= @$a[$i][2] ?></div>
                                <div class="picture" style="top: 40px;left: 20px;">圖片:<img src="<?= @$a[$i][1] ?>" width="120px"></div>
                                <div class="introduction" style="top: 40px;right: 20px;">商品簡介:<?= @$a[$i][3] ?></div>
                                <div class="date" style="top: 125px;right: 20px;">發佈日期:<?= @$a[$i][5] ?></div>
                                <div class="cost" style="top: 5px;right: 20px;">費用:<?= @$a[$i][4] ?></div>
                                <div class="link" style="top: 195px;right: 20px;">相關連結:<?= @$a[$i][6] ?></div>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="version" id="version1" style="top: 0px;left: 35%;transform: scale(1);">
                                <div class="name" style="top: 5px;right: 20px;">商品名稱:<?= @$a[$i][2] ?></div>
                                <div class="picture" style="top: 5px;left: 20px;">圖片:<img src="<?= @$a[$i][1] ?>" width="120px"></div>
                                <div class="introduction" style="top: 40px;right: 20px;">商品簡介:<?= @$a[$i][3] ?></div>
                                <div class="date" style="top: 125px;right: 20px;">發佈日期:<?= @$a[$i][5] ?></div>
                                <div class="cost" style="top: 195px;right: 20px;">費用:<?= @$a[$i][4] ?></div>
                                <div class="link" style="top: 195px;left: 20px;">相關連結:<?= @$a[$i][6] ?></div>
                            </div>
                            <?php
                        }
                    ?>
                </td>
            </tr>
            <?php
        }
    }
?>