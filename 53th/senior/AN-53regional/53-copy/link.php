<?php
    $db=new PDO("mysql:host=localhost;dbname=db2;charset=utf8","admin","1234");
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
            query($db,"INSERT INTO `data`(`number`, `username`, `code`, `name`,`premission` ,`movetime`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登出成功')");
            session_unset();
            ?><script>alert("登出成功");location.href="index.php"</script><?php
        }else{
            query($db,"INSERT INTO `data`(`number`, `username`, `code`, `name`, `movetime`, `move`) VALUES ('未知','','','','$time','登出成功')");
            session_unset();
            ?><script>alert("登出成功");location.href="index.php"</script><?php
        }
    }

    function up($data,$comper){
        usort($data,function($a,$b)use($comper){ return $a[$comper]>$b[$comper]||($a[$comper]==$b[$comper])&&$a[0]>$b[0]; });
        for($i=0;$i<count($data);$i++){
            ?>
            <tr>
                <?php
                for($j=1;$j<=7;$j++){
                    ?>
                    <td class="admintd"><?= $data[$i][$j] ?></td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
    }

    function down($data,$comper){
        usort($data,function($a,$b)use($comper){ return $a[$comper]<$b[$comper]||($a[$comper]==$b[$comper])&&$a[0]>$b[0]; });
        for($i=0;$i<count($data);$i++){
            ?>
            <tr>
                <?php
                for($j=1;$j<=7;$j++){
                    ?>
                    <td class="admintd"><?= $data[$i][$j] ?></td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
    }

    function updown($data){
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

    function data($a,$i,$p){
        if($p=="name"){
            ?>商品名稱: <?= $a[$i][2] ?><?php
        }elseif($p=="link"){
            ?>相關連結: <?= $a[$i][4] ?><?php
        }elseif($p=="cost"){
            ?>費用: <?= $a[$i][5] ?><?php
        }elseif($p=="date"){
            ?>發佈日期: <?= $a[$i][6] ?><?php
        }else{
            ?>商品名稱: <?= $a[$i][3] ?><?php
        }
    }

    function product($a,$p,$db){
        $product=fetchall(query($db,"SELECT*FROM `product`"));
        usort($a,function($a,$b){ return $a[0]<$b[0]; });
        for($i=0;$i<count($a);$i++){
            if($p==0){
                ?>
                <tr>
                    <td class="ptd">
                        <table class="coffeetable">
                            <?php
                                for($j=0;$j<count($product);$j++){
                                    if($product[$j][0]==$a[$i][7]&&$product[$j][1]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd" rowspan="3"><img src="<?= $a[$i][1] ?>" width="175px" alt="圖片"></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][4]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][7]) ?></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][8]) ?></td>
                                            </tr>
                                        <?php
                                    }elseif($product[$j][0]==$a[$i][7]&&$product[$j][2]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][1]) ?></td>
                                                <td class="coffeetd" rowspan="3"><img src="<?= $a[$i][1] ?>" width="175px" alt="圖片"></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][3]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][7]) ?></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][8]) ?></td>
                                            </tr>
                                        <?php
                                    }elseif($product[$j][0]==$a[$i][7]&&$product[$j][3]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][1]) ?></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd" rowspan="3"><img src="<?= $a[$i][1] ?>" width="175px" alt="圖片"></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][4]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][8]) ?></td>
                                            </tr>
                                        <?php
                                    }elseif($product[$j][0]==$a[$i][7]&&$product[$j][4]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][1]) ?></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][3]) ?></td>
                                                <td class="coffeetd" rowspan="3"><img src="<?= $a[$i][1] ?>" width="175px" alt="圖片"></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][7]) ?></td>
                                            </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </table>
                        <input type="button" class="producteditbut" onclick="location.href='edit.php?pe=<?= $a[$i][0] ?>'" value="修改" style="float:right;">
                    </td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="ptd">
                        <table class="coffeetable">
                            <?php
                                for($j=0;$j<count($product);$j++){
                                    if($product[$j][0]==$a[$i][7]&&$product[$j][1]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd" rowspan="3"><img src="<?= $a[$i][1] ?>" width="175px" alt="圖片"></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][4]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][7]) ?></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][8]) ?></td>
                                            </tr>
                                        <?php
                                    }elseif($product[$j][0]==$a[$i][7]&&$product[$j][2]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][1]) ?></td>
                                                <td class="coffeetd" rowspan="3"><img src="<?= $a[$i][1] ?>" width="175px" alt="圖片"></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][3]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][7]) ?></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][8]) ?></td>
                                            </tr>
                                        <?php
                                    }elseif($product[$j][0]==$a[$i][7]&&$product[$j][3]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][1]) ?></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd" rowspan="3"><img src="<?= $a[$i][1] ?>" width="175px" alt="圖片"></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][4]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][6]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][8]) ?></td>
                                            </tr>
                                        <?php
                                    }elseif($product[$j][0]==$a[$i][7]&&$product[$j][4]=="picture"){
                                        ?>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][1]) ?></td>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][2]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][3]) ?></td>
                                                <td class="coffeetd" rowspan="3"><img src="<?= $a[$i][1] ?>" width="175px" alt="圖片"></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][5]) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="coffeetd"><?php data($a,$i,$product[$j][7]) ?></td>
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
?>