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
                        <td class="admintablenum" id=<?= $a[$row][1]; ?>>
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
                    <td class="admintablenum" id=<?= $a[$row][1]; ?>>
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
            down($data,"username");
            ?><script>document.getElementById("user-up-down").value="降冪"</script><?php
        }elseif($code=="升冪"){
            down($data,"password");
            ?><script>document.getElementById("code-up-down").value="降冪"</script><?php
        }elseif($name=="升冪"){
            down($data,"name");
            ?><script>document.getElementById("name-up-down").value="降冪"</script><?php
        }elseif(isset($number)||isset($user)||isset($code)||isset($name)){
            header("location:manage.php");
        }else{
            up($data,1);
        }
    }

    function product($db,$permission){
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
                            if($a[$i][7]==1){
                                ?>
                                <table class="show" id="version1">
                                    <tr>
                                        <td class="coffeedata">商品名稱: <?= @$a[$i][2] ?></td>
                                        <td class="coffeedata">費用: <?= @$a[$i][4] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeedata" rowspan="4"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                        <td class="coffeedata" rowspan="2">商品簡介: <?= @$a[$i][3] ?></td>
                                    </tr>
                                    <tr></tr>
                                    <tr>
                                        <td class="coffeedata">發佈日期: <?= @$a[$i][5] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeedata">相關連結: <?= @$a[$i][6] ?></td>
                                    </tr>
                                </table>
                                <button class="bottom" onclick="location.href='productedit.php?id=<?= @$a[$i][0] ?>'">修改</button>
                                <?php
                            }else{
                                ?>
                                <table class="show" id="version2">
                                    <tr>
                                        <td class="coffeedata" rowspan="4"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                        <td class="coffeedata">商品名稱: <?= @$a[$i][2] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeedata" rowspan="2">商品簡介: <?= @$a[$i][3] ?></td>
                                    </tr>
                                    <tr></tr>
                                    <tr>
                                        <td class="coffeedata">發佈日期: <?= @$a[$i][5] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeedata">費用: <?= @$a[$i][4] ?></td>
                                        <td class="coffeedata">相關連結: <?= @$a[$i][6] ?></td>
                                    </tr>
                                </table>
                                <button class="bottom" onclick="location.href='productedit.php?id=<?= @$a[$i][0] ?>'">修改</button>
                                <?php
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
                            if($a[$i][7]==1){
                                ?>
                                <table class="version" id="version1" style="top: 10px;left: 35%;transform: scale(1);">
                                    <tr>
                                        <td class="coffeedata">商品名稱: <?= @$a[$i][2] ?></td>
                                        <td class="coffeedata">費用: <?= @$a[$i][4] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeedata" rowspan="4"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
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
                                        <td class="coffeedata" rowspan="4"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
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
    }
?>