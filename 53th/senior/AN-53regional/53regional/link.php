<?php
    $db=new PDO("mysql:host=localhost;dbname=53regional;charset=utf8","admin","1234");
    date_default_timezone_set("Asia/Taipei");
    $time=date("Y-m-d H:i:s");
    session_start();

    function query($db,$query){
        return $db->query($query);
    }

    function fetch($result){
        return $result->fetch();
    }

    function fetchall($result){
        return $result->fetchAll();
    }

    function rowcount($result){
        return $result->rowCount();
    }

    @$data=$_SESSION["data"];
    if(isset($_GET["logout"])){
        $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"));
        if(isset($data)){
            query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登出成功')");
            session_unset();
            ?><script>alert("登出成功!");location.href="index.php"</script><?php
        }else{
            query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('未知','','','','','','登出成功')");
            session_unset();
            ?><script>alert("登出成功!");location.href="index.php"</script><?php
        }
    }

    function printrow($a){
        for($row=0;$row<count($a);$row=$row+1){
            if($a[$row][1]=="0000"||$a[$row][1]=="未知"){
                ?>
                    <tr>
                        <td class="admintable" id=<?= $a[$row][1]; ?>>
                            <?php print_r($a[$row][1]); ?>
                            <input type="button" value="修改" disabled>
                            <button name="del" disabled>刪除帳號</button>
                        </td>
                        <td class="admintable"><?php print_r($a[$row][2]); ?></td>
                        <td class="admintable"><?php print_r($a[$row][3]); ?></td>
                        <td class="admintable"><?php print_r($a[$row][4]); ?></td>
                        <td class="admintable"><?php print_r($a[$row][5]); ?></td>
                        <td class="admintable"><?php print_r($a[$row][6]); ?></td>
                        <td class="admintable"><?php print_r($a[$row][7]); ?></td>
                    </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintable" id=<?= $a[$row][1]; ?>>
                        <?php print_r($a[$row][1]); ?>
                        <input type="button" value="修改" onclick="location.href='signupedit.php?number=<?= $a[$row][1] ?>'">
                        <button name="del" value="<?= $a[$row][1]; ?>">刪除帳號</button>
                    </td>
                    <td class="admintable"><?php print_r($a[$row][2]); ?></td>
                    <td class="admintable"><?php print_r($a[$row][3]); ?></td>
                    <td class="admintable"><?php print_r($a[$row][4]); ?></td>
                    <td class="admintable"><?php print_r($a[$row][5]); ?></td>
                    <td class="admintable"><?php print_r($a[$row][6]); ?></td>
                    <td class="admintable"><?php print_r($a[$row][7]); ?></td>
                </tr>
                <?php
            }
        }
    }

    function up($data,$comper){
        $a=fetchall($data);
        for($i=0;$i<count($a)-1;$i=$i+1){
            for($j=0;$j<count($a)-$i-1;$j=$j+1){
                if($a[$j][$comper]>$a[$j+1][$comper]){
                    $tamp=$a[$j];
                    $a[$j]=$a[$j+1];
                    $a[$j+1]=$tamp;
                }
            }
        }
        printrow($a);
    }

    function down($data,$comper){
        $a=fetchall($data);
        for($i=0;$i<count($a)-1;$i=$i+1){
            for($j=0;$j<count($a)-$i-1;$j=$j+1){
                if($a[$j][$comper]<$a[$j+1][$comper]){
                    $tamp=$a[$j];
                    $a[$j]=$a[$j+1];
                    $a[$j+1]=$tamp;
                }
            }
        }
        printrow($a);
    }

    function issetgetupdown($data){
        @$number=$_GET["num-up-down"];
        @$user=$_GET["user-up-down"];
        @$code=$_GET["code-up-down"];
        @$name=$_GET["name-up-down"];
        if($number=="升冪"){
            down($data,1);
            ?><script>document.getElementById("num-up-down").value="降冪"</script><?php
        }elseif($user=="升冪"){
            down($data,2);
            ?><script>document.getElementById("user-up-down").value="降冪"</script><?php
        }elseif($code=="升冪"){
            down($data,3);
            ?><script>document.getElementById("code-up-down").value="降冪"</script><?php
        }elseif($name=="升冪"){
            down($data,4);
            ?><script>document.getElementById("name-up-down").value="降冪"</script><?php
        }elseif(isset($user)){
            up($data,2);
        }elseif(isset($code)){
            up($data,3);
        }elseif(isset($name)){
            up($data,4);
        }else{
            up($data,1);
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
        $a=fetchall($db);
        $product=fetchall(query($otr,"SELECT*FROM `product`"));
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
            if($permission==0){
                ?>
                <tr>
                    <td class="producttd">
                        <?php
                        for($j=0;$j<count($product);$j=$j+1){
                            if($a[$i][7]==$product[$j][0]){
                                if($product[$j][1]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,4) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,6) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,7) ?></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <button class="bottom" onclick="location.href='productedit.php?id=<?= @$a[$i][0] ?>'">修改</button>
                                    <?php
                                }elseif($product[$j][2]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,3) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,5) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,7) ?></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <button class="bottom" onclick="location.href='productedit.php?id=<?= @$a[$i][0] ?>'">修改</button>
                                    <?php
                                }elseif($product[$j][3]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,4) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,6) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <button class="bottom" onclick="location.href='productedit.php?id=<?= @$a[$i][0] ?>'">修改</button>
                                    <?php
                                }else{
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,3) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,5) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,7) ?></td>
                                        </tr>
                                    </table>
                                    <button class="bottom" onclick="location.href='productedit.php?id=<?= @$a[$i][0] ?>'">修改</button>
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
                            if($a[$i][7]==$product[$j][0]){
                                if($product[$j][1]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,4) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,6) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,7) ?></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }elseif($product[$j][2]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,3) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,5) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,7) ?></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }elseif($product[$j][3]=="picture"){
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,4) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,6) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,8) ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }else{
                                    ?>
                                    <table class="show">
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,1) ?></td>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,3) ?></td>
                                            <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,5) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffeedata"><?= ifdata($a,$i,$product,$j,7) ?></td>
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