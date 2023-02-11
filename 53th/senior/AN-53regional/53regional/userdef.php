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
                            <table class="version" id="version1" style="top: 10px;left: 35%;transform: scale(1);">
                                <tr>
                                    <td class="coffeedata">商品名稱: <?= @$a[$i][2] ?></td>
                                    <td class="coffeedata">費用: <?= @$a[$i][4] ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeedata" rowspan="4">圖片: <img src="<?= @$a[$i][1] ?>" width="120px"></td>
                                    <td class="coffeedata" rowspan="2">商品簡介: <?= @$a[$i][3] ?></td>
                                </tr>
                                <tr>
                                </tr>
                                <tr>
                                    <td class="coffeedata">發佈日期: <?= @$a[$i][5] ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeedata">相關連結: <?= @$a[$i][6] ?></td>
                                </tr>
                            </table>
                            <?php
                        }else{
                            ?>
                            <table class="version" id="version2" style="top: 10px;left: 35%;transform: scale(1);">
                                <tr>
                                    <td class="coffeedata" rowspan="4">圖片: <img src="<?= @$a[$i][1] ?>" width="120px"></td>
                                    <td class="coffeedata">商品名稱: <?= @$a[$i][2] ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeedata" rowspan="2">商品簡介: <?= @$a[$i][3] ?></td>
                                </tr>
                                <tr>
                                </tr>
                                <tr>
                                    <td class="coffeedata">發佈日期: <?= @$a[$i][5] ?></td>
                                </tr>
                                <tr>
                                    <td class="coffeedata">費用: <?= @$a[$i][4] ?></td>
                                    <td class="coffeedata">相關連結: <?= @$a[$i][6] ?></td>
                                </tr>
                            </table>
                            <?php
                        }
                    ?>
                </td>
            </tr>
            <?php
        }
    }
?>