<?php
    $db=new PDO("mysql:host=localhost;dbname=49regional;charset=utf8","admin","1234");
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

    function block($name){
        return preg_match("/([ ,\!,\@,\#,\$,\%,\^,\&,\*,\(,\),\_,\-,\+,\=,\{,\},\[,\],\|,\\\,\:,\;,\',\",\<,\>,\,,\.,\?,\/ ])/",$name,$e);
    }

    if(isset($_GET["logout"])){
        @$data=$_SESSION["data"];
        $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"));
        if($row){
            query($db,"INSERT INTO `data`(`number`,`move`,`movetime`)VALUES('$row[1]','$time','登出成功')");
        }else{
            query($db,"INSERT INTO `data`(`number`,`move`,`movetime`)VALUES('未知','$time','登出成功')");
        }
        session_unset();
        ?><script>alert("登出成功!");location.href="index.php"</script><?php
    }

    function up($row,$com){
        usort($row,function($a,$b)use($com){ return $a[$com]>$b[$com]||$a[$com]==$b[$com]&&$a[0]>$b[0]; });
        for($i=0;$i<count($row);$i++){
            if($row[$i][1]=="a0001"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][1] ?>
                    </td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][4] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                    <td class="admintd">
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除" disabled>
                    </td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][1] ?>
                    </td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][4] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                    <td class="admintd">
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除">
                    </td>
                </tr>
                <?php
            }
        }
    }

    function down($row,$com){
        usort($row,function($a,$b)use($com){ return $a[$com]<$b[$com]||$a[$com]==$b[$com]&&$a[0]>$b[0]; });
        for($i=0;$i<count($row);$i++){
            if($row[$i][1]=="a0001"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][1] ?>
                    </td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][4] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                    <td class="admintd">
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除" disabled>
                    </td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][1] ?>
                    </td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][4] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                    <td class="admintd">
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除">
                    </td>
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

    function data($row,$i,$p){
        if($p=="name"){
            ?>商品名稱: <?= $row[$i][2] ?><?php
        }elseif($p=="cost"){
            ?>費用: <?= $row[$i][3] ?><?php
        }elseif($p=="link"){
            ?>相關連結: <?= $row[$i][4] ?><?php
        }elseif($p=="date"){
            ?>發佈日期: <?= $row[$i][5] ?><?php
        }else{
            ?>商品簡介: <?= $row[$i][6] ?><?php
        }
    }
?>