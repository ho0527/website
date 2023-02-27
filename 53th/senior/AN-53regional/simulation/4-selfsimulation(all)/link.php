<?php
    $db=new PDO("mysql:host=localhost;dbname=db04;charset=utf8","admin","1234");
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
            query($db,"INSERT INTO `data`(`number`, `username`, `password`,`permission` ,`name`, `move`, `movetime`) VALUES ('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','登出成功','$time')");
        }else{
            query($db,"INSERT INTO `data`(`number`, `username`, `password`,`permission` ,`name`, `move`, `movetime`) VALUES ('未知','','','','','登出成功','$time')");
        }
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }

    function up($a,$comper){
        usort($a,function($a,$b)use($comper){ return $a[$comper]>$b[$comper]||$a[$comper]==$b[$comper]&&$a[0]>$b[0]; });
        for($i=0;$i<count($a);$i++){
            ?>
            <tr>
                <td class="admintd"><?= $a[$i][1] ?></td>
                <td class="admintd"><?= $a[$i][2] ?></td>
                <td class="admintd"><?= $a[$i][3] ?></td>
                <td class="admintd"><?= $a[$i][4] ?></td>
                <td class="admintd"><?= $a[$i][5] ?></td>
                <td class="admintd"><?= $a[$i][6] ?></td>
                <td class="admintd"><?= $a[$i][7] ?></td>
            </tr>
            <?php
        }
    }

    function down($a,$comper){
        usort($a,function($a,$b)use($comper){ return $a[$comper]<$b[$comper]||$a[$comper]==$b[$comper]&&$a[0]>$b[0]; });
        for($i=0;$i<count($a);$i++){
            ?>
            <tr>
                <td class="admintd"><?= $a[$i][1] ?></td>
                <td class="admintd"><?= $a[$i][2] ?></td>
                <td class="admintd"><?= $a[$i][3] ?></td>
                <td class="admintd"><?= $a[$i][4] ?></td>
                <td class="admintd"><?= $a[$i][5] ?></td>
                <td class="admintd"><?= $a[$i][6] ?></td>
                <td class="admintd"><?= $a[$i][7] ?></td>
            </tr>
            <?php
        }
    }

    function updown($data){
        @$number=$_GET["numberupdown"];
        @$username=$_GET["usernameupdown"];
        @$code=$_GET["codeupdown"];
        @$name=$_GET["nameupdown"];
        if($number=="升冪"){
            down($data,1);
            ?><script>document.getElementById("number").value="降冪"</script><?php
        }elseif($username=="升冪"){
            down($data,2);
            ?><script>document.getElementById("username").value="降冪"</script><?php
        }elseif($code=="升冪"){
            down($data,3);
            ?><script>document.getElementById("code").value="降冪"</script><?php
        }elseif($name=="升冪"){
            down($data,4);
            ?><script>document.getElementById("name").value="降冪"</script><?php
        }elseif(isset($username)){
            up($data,2);
        }elseif(isset($code)){
            up($data,3);
        }elseif(isset($name)){
            up($data,4);
        }else{
            up($data,1);
        }
    }

    function data($a,$i,$product){
        if($product=="name"){
            ?>
            商品名稱: <?= $a[$i][2]; ?>
            <?php
        }elseif($product=="link"){
            ?>
            相觀連結: <?= $a[$i][3]; ?>
            <?php
        }elseif($product=="cost"){
            ?>
            費用: <?= $a[$i][4]; ?>
            <?php
        }elseif($product=="date"){
            ?>
            發佈日期: <?= $a[$i][5]; ?>
            <?php
        }else{
            ?>
            商品簡介: <?= $a[$i][6]; ?>
            <?php
        }
    }

    function product($data,$db,$p){
        $product=fetchall(query($db,"SELECT*FROM `product`"));
        usort($data,function($a,$b){ return $a<$b; });
        for($i=0;$i<count($data);$i++){
            if($p==0){
                ?>
                <tr>
                    <td class="producttd">
                        <table class="coffeetable">
                            <?php
                            for($j=0;$j<count($product);$j=$j+1){
                                if($product[$j][0]==$data[$i][7]&&$product[$j][1]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffeetd" rowspan="3"><img src="<?= $data[$i][1] ?>" alt="圖片" width="175px"></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][2]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][4]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][6]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][7]); ?></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][8]); ?></td>
                                    </tr>
                                    <?php
                                }elseif($product[$j][0]==$data[$i][7]&&$product[$j][2]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][1]); ?></td>
                                        <td class="coffeetd" rowspan="3"><img src="<?= $data[$i][1] ?>" alt="圖片" width="175px"></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][3]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][5]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][7]); ?></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][8]); ?></td>
                                    </tr>
                                    <?php
                                }elseif($product[$j][0]==$data[$i][7]&&$product[$j][3]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][1]); ?></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][2]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd" rowspan="3"><img src="<?= $data[$i][1] ?>" alt="圖片" width="175px"></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][4]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][6]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][8]); ?></td>
                                    </tr>
                                    <?php
                                }elseif($product[$j][0]==$data[$i][7]&&$product[$j][4]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][1]); ?></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][2]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][3]); ?></td>
                                        <td class="coffeetd" rowspan="3"><img src="<?= $data[$i][1] ?>" alt="圖片" width="175px"></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][5]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][7]); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        <input type="button" class="peoducteditbut" onclick="location.href='edit.php?pedit=<?= $data[$i][0] ?>'" value="修改">
                        </table>
                    </td>
                </tr>
                <?php
            }else{
                for($j=0;$j<count($product);$j=$j+1){
                    ?>
                    <tr>
                        <td class="producttd">
                            <table class="coffeetable">
                                <?php
                                if($product[$j][0]==$data[$i][7]&&$product[$j][1]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffeetd" rowspan="3"><img src="<?= $data[$i][1] ?>" alt="圖片" width="175px"></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][2]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][4]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][6]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][7]); ?></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][8]); ?></td>
                                    </tr>
                                    <?php
                                }elseif($product[$j][0]==$data[$i][7]&&$product[$j][2]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][1]); ?></td>
                                        <td class="coffeetd" rowspan="3"><img src="<?= $data[$i][1] ?>" alt="圖片" width="175px"></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][3]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][5]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][7]); ?></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][8]); ?></td>
                                    </tr>
                                    <?php
                                }elseif($product[$j][0]==$data[$i][7]&&$product[$j][3]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][1]); ?></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][2]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd" rowspan="3"><img src="<?= $data[$i][1] ?>" alt="圖片" width="175px"></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][4]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][6]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][8]); ?></td>
                                    </tr>
                                    <?php
                                }elseif($product[$j][0]==$data[$i][7]&&$product[$j][4]=="picture"){
                                    ?>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][1]); ?></td>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][2]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][3]); ?></td>
                                        <td class="coffeetd" rowspan="3"><img src="<?= $data[$i][1] ?>" alt="圖片" width="175px"></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][5]); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeetd"><?php data($data,$i,$product[$j][7]); ?></td>
                                    </tr>
                                    <?php
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