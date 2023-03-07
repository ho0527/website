<?php
    $db=new PDO("mysql:host=localhost;dbname=db10;charset=utf8","admin","1234");
    date_default_timezone_set("Asia/Taipei");
    $time=date("Y-m-d H:i:s");
    session_start();

    function query($db,$data){
        return $db->query($data);
    }

    function fetch($data){
        return $data->fetch();
    }

    function fetchall($data){
        return $data->fetchall();
    }

    if(isset($_GET["logout"])){
        $data=$_SESSION["data"];
        if($row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"))){
            query($db,"INSERT INTO `data`(`number`, `username`, `code`, `name`, `permission`, `move`, `movetime`)VALUES('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','登出成功','$time')");
            session_unset();
            ?><script>alert("登出成功");location.href="index.php"</script><?php
        }else{
            query($db,"INSERT INTO `data`(`number`, `username`, `code`, `name`, `permission`, `move`, `movetime`)VALUES('未知','','','','','登出成功','$time')");
            session_unset();
            ?><script>alert("登出成功");location.href="index.php"</script><?php
        }
    }

    function up($row,$comp){
        usort($row,function($a,$b)use($comp){ return $a[$comp]>$b[$comp]||$a[$comp]==$b[$comp]&&$a[0]>$b[0]; });
        for($i=0;$i<count($row);$i++){
            if($row[$i][1]=="0000"){
                ?>
                <tr>
                    <td class="td">
                        <?= $row[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除" disabled>
                    </td>
                    <td class="td"><?= $row[$i][2] ?></td>
                    <td class="td"><?= $row[$i][3] ?></td>
                    <td class="td"><?= $row[$i][4] ?></td>
                    <td class="td"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="td">
                        <?= $row[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除">
                    </td>
                    <td class="td"><?= $row[$i][2] ?></td>
                    <td class="td"><?= $row[$i][3] ?></td>
                    <td class="td"><?= $row[$i][4] ?></td>
                    <td class="td"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function down($row,$comp){
        usort($row,function($a,$b)use($comp){ return $a[$comp]<$b[$comp]||$a[$comp]==$b[$comp]&&$a[0]>$b[0]; });
        for($i=0;$i<count($row);$i++){
            if($row[$i][1]=="0000"){
                ?>
                <tr>
                    <td class="td">
                        <?= $row[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除" disabled>
                    </td>
                    <td class="td"><?= $row[$i][2] ?></td>
                    <td class="td"><?= $row[$i][3] ?></td>
                    <td class="td"><?= $row[$i][4] ?></td>
                    <td class="td"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="td">
                        <?= $row[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除">
                    </td>
                    <td class="td"><?= $row[$i][2] ?></td>
                    <td class="td"><?= $row[$i][3] ?></td>
                    <td class="td"><?= $row[$i][4] ?></td>
                    <td class="td"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function updown($row){
        if(@$_GET["udnb"]=="升冪"){
            down($row,1);
            ?><script>document.getElementById("udnb").value="降冪"</script><?php
        }elseif(@$_GET["udun"]=="升冪"){
            down($row,2);
            ?><script>document.getElementById("udun").value="降冪"</script><?php
        }elseif(@$_GET["udn"]=="升冪"){
            down($row,4);
            ?><script>document.getElementById("udn").value="降冪"</script><?php
        }elseif(@$_GET["udun"]=="降冪"){
            up($row,2);
        }elseif(@$_GET["udn"]=="降冪"){
            up($row,4);
        }else{
            up($row,1);
        }
    }

    function data($a,$i,$p){
        if($p=="name"){
            ?>商品名稱: <?= $a[$i][2] ?><?php
        }elseif($p=="cost"){
            ?>費用: <?= $a[$i][3] ?><?php
        }elseif($p=="link"){
            ?>相關連結: <?= $a[$i][4] ?><?php
        }elseif($p=="date"){
            ?>發佈日期: <?= $a[$i][5] ?><?php
        }else{
            ?>商品簡介: <?= $a[$i][6] ?><?php
        }
    }

    function product($a,$db,$p){
        usort($a,function($a,$b){ return $a[0]>$b[0]; });
        $product=fetchall(query($db,"SELECT*FROM `product`"));
        for($i=0;$i<count($a);$i++){
            if($p==0){
                ?>
                <tr>
                    <td class="producttd">
                        <table class="coffeetable">
                            <?php
                            for($j=0;$j<count($product);$j++){
                                if($a[$i][7]==$product[$j][0]&&$product[$j][1]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffee" rowspan="3"><img src="<?= $a[$i][1] ?>" alt="圖片" width="175px"></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][2]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][4]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][6]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][7]) ?></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][8]) ?></td>
                                    </tr>
                                    <?php
                                }elseif($a[$i][7]==$product[$j][0]&&$product[$j][2]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][1]) ?></td>
                                        <td class="coffee" rowspan="3"><img src="<?= $a[$i][1] ?>" alt="圖片" width="175px"></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][3]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][5]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][7]) ?></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][8]) ?></td>
                                    </tr>
                                    <?php
                                }elseif($a[$i][7]==$product[$j][0]&&$product[$j][3]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][1]) ?></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][2]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee" rowspan="3"><img src="<?= $a[$i][1] ?>" alt="圖片" width="175px"></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][4]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][6]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][8]) ?></td>
                                    </tr>
                                    <?php
                                }elseif($a[$i][7]==$product[$j][0]&&$product[$j][4]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][1]) ?></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][2]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][3]) ?></td>
                                        <td class="coffee" rowspan="3"><img src="<?= $a[$i][1] ?>" alt="圖片" width="175px"></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][5]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][7]) ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                        <input type="button" onclick="location.href='edit.php?pedit=<?= $a[$i][0] ?>'" value="修改">
                    </td>
                </tr>
                <?php
            }else{{
                ?>
                <tr>
                    <td class="producttd">
                        <table class="coffeetable">
                            <?php
                            for($j=0;$j<count($product);$j++){
                                if($a[$i][7]==$product[$j][0]&&$product[$j][1]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffee" rowspan="3"><img src="<?= $a[$i][1] ?>" alt="圖片" width="175px"></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][2]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][4]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][6]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][7]) ?></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][8]) ?></td>
                                    </tr>
                                    <?php
                                }elseif($a[$i][7]==$product[$j][0]&&$product[$j][2]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][1]) ?></td>
                                        <td class="coffee" rowspan="3"><img src="<?= $a[$i][1] ?>" alt="圖片" width="175px"></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][3]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][5]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][7]) ?></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][8]) ?></td>
                                    </tr>
                                    <?php
                                }elseif($a[$i][7]==$product[$j][0]&&$product[$j][3]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][1]) ?></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][2]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee" rowspan="3"><img src="<?= $a[$i][1] ?>" alt="圖片" width="175px"></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][4]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][6]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][8]) ?></td>
                                    </tr>
                                    <?php
                                }elseif($a[$i][7]==$product[$j][0]&&$product[$j][4]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][1]) ?></td>
                                        <td class="coffee"><?php data($a,$i,$product[$j][2]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][3]) ?></td>
                                        <td class="coffee" rowspan="3"><img src="<?= $a[$i][1] ?>" alt="圖片" width="175px"></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][5]) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffee"><?php data($a,$i,$product[$j][7]) ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </td>
                </tr>
                <?php
                }
            }
        }
    }
?>