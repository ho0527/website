<?php
    $db=new PDO("mysql:host=localhost;dbname=db12;charset=utf8","root","");
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
        }else{
            query($db,"INSERT INTO `data`(`number`, `username`, `code`, `name`, `permission`, `move`, `movetime`)VALUES('未知','','','','','登出成功','$time')");
        }
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }

    function up($row,$comp){
        usort($row,function($a,$b)use($comp){ return $a[$comp]>$b[$comp]||($a[$comp]==$b[$comp]&&$a[0]>$b[0]); });
        for($i=0;$i<count($row);$i++){
            if($row[$i][1]=="0000"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除" disabled>
                    </td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][4] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除">
                    </td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][4] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function down($row,$comp){
        usort($row,function($a,$b)use($comp){ return $a[$comp]<$b[$comp]||($a[$comp]==$b[$comp]&&$a[0]>$b[0]); });
        for($i=0;$i<count($row);$i++){
            if($row[$i][1]=="0000"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除" disabled>
                    </td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][4] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除">
                    </td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][4] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function updown($a){
        if(@$_GET["udnb"]=="升冪"){
            down($a,1);
            ?><script>document.getElementById("udnb").value="降冪"</script><?php
        }elseif(@$_GET["udun"]=="升冪"){
            down($a,2);
            ?><script>document.getElementById("udun").value="降冪"</script><?php
        }elseif(@$_GET["udn"]=="升冪"){
            down($a,4);
            ?><script>document.getElementById("udn").value="降冪"</script><?php
        }elseif(@$_GET["udun"]=="降冪"){
            up($a,2);
        }elseif(@$_GET["udn"]=="降冪"){
            up($a,4);
        }else{
            up($a,1);
        }
    }

    
?>