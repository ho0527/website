<?php
    include("link.php");

    if(isset($_GET["logout"])){
        $data=$_SESSION["data"];
        $row=query($db,"SELECT*FROM `user` WHERE `number`='$data'")[0];
        if(isset($data)){
            query($db,"INSERT INTO `data`(`number`,`username`,`password`,`name`,`permission`,`move1`,`move2`,`movetime`)VALUES(?,?,?,?,?,'登出','成功',?)",[$row[4],$row[1],$row[2],$row[3],$row[5],$time]);
            session_unset();
            ?><script>alert("登出成功!");location.href="index.php"</script><?php
        }else{
            query($db,"INSERT INTO `data`(`number`,`username`,`password`,`name`,`permission`,`move1`,`move2`,`movetime`)VALUES('未知','','','','','登出','成功','$time')");
            session_unset();
            ?><script>alert("登出成功!");location.href="index.php"</script><?php
        }
    }

    function ifdata($a,$i,$product,$j,$data){
        if($product[$j][$data]=="name"){
            ?>商品名稱: <?= @$a[$i][2] ?> <?php
        }elseif($product[$j][$data]=="cost"){
            ?>金額: <?= @$a[$i][4] ?> <?php
        }elseif($product[$j][$data]=="date"){
            ?>發佈日期: <?= @$a[$i][5] ?> <?php
        }elseif($product[$j][$data]=="link"){
            ?>相關連結: <?= @$a[$i][6] ?> <?php
        }else{
            ?>商品簡介: <?= @$a[$i][3] ?> <?php
        }
    }

    function product($db,$permission,$otr){
        $product=query($otr,"SELECT*FROM `product`");
        for($i=0;$i<count($db)-1;$i=$i+1){
            for($j=0;$j<count($db)-$i-1;$j=$j+1){
                if($db[$j][0]<$db[$j+1][0]){
                    $tamp=$db[$j];
                    $db[$j]=$db[$j+1];
                    $db[$j+1]=$tamp;
                }
            }
        }
        for($i=0;$i<count($db);$i=$i+1){
            if($permission==0){
                ?>
                <tr>
                    <td class="producttd">
                        <?php
                        for($j=0;$j<count($product);$j=$j+1){
                            if($db[$i][7]==$product[$j][0]){
                                if($product[$j][1]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$db[$i][1] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,4) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,6) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,7) ?></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <button class="bottom" onclick="location.href='productedit.php?id=<?= @$db[$i][0] ?>'">修改</button>
                                    <?php
                                }elseif($product[$j][2]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$db[$i][1] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,3) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,5) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,7) ?></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <button class="bottom" onclick="location.href='productedit.php?id=<?= @$db[$i][0] ?>'">修改</button>
                                    <?php
                                }elseif($product[$j][3]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$db[$i][1] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,4) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,6) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <button class="bottom" onclick="location.href='productedit.php?id=<?= @$db[$i][0] ?>'">修改</button>
                                    <?php
                                }else{
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,3) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$db[$i][1] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,5) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,7) ?></td>
                                        </tr>
                                    </table>
                                    <button class="bottom" onclick="location.href='productedit.php?id=<?= @$db[$i][0] ?>'">修改</button>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="producttd">
                        <?php
                        for($j=0;$j<count($product);$j=$j+1){
                            if($db[$i][7]==$product[$j][0]){
                                if($product[$j][1]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$db[$i][1] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,4) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,6) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,7) ?></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }elseif($product[$j][2]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$db[$i][1] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,3) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,5) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,7) ?></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }elseif($product[$j][3]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$db[$i][1] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,4) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,6) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }else{
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,3) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$db[$i][1] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,5) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($db,$i,$product,$j,7) ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
    }
?>