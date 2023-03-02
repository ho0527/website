<?php
    $db=new PDO("mysql:host=localhost;dbname=53regional;chaeset=utf8","admin","1234");
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
            query($db,"INSERT INTO `data`(`number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登出成功')");
        }else{
            query($db,"INSERT INTO `data`(`number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('未知','','','','','$time','登出成功')");
        }
        session_unset();
        ?><script>alert("登出成功");location.href="verify.php"</script><?php
    }

    function up($a,$comper){
        usort($a,function($a,$b)use($comper){ return $a[$comper]<$b[$comper]||$a[$comper]==$b[$comper]&&$a[0]>$b[0]; });
        for($i=0;$i<count($a);$i++){
            if($a[$i][0]=="0000"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $a[$i][4] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $a[$i][4] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='edit.php?del=<?= $a[$i][4] ?>'" value="刪除" disabled>
                    </td>
                    <td class="admintd"><?= $a[$i][1] ?></td>
                    <td class="admintd"><?= $a[$i][2] ?></td>
                    <td class="admintd"><?= $a[$i][3] ?></td>
                    <td class="admintd"><?= $a[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $a[$i][4] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $a[$i][4] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $a[$i][4] ?>'" value="刪除">
                    </td>
                    <td class="admintd"><?= $a[$i][1] ?></td>
                    <td class="admintd"><?= $a[$i][2] ?></td>
                    <td class="admintd"><?= $a[$i][3] ?></td>
                    <td class="admintd"><?= $a[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function down($a,$comper){
        usort($a,function($a,$b)use($comper){ return $a[$comper]>$b[$comper]||$a[$comper]==$b[$comper]&&$a[0]>$b[0]; });
        for($i=0;$i<count($a);$i++){
            if($a[$i][0]=="0000"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $a[$i][4] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $a[$i][4] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='edit.php?del=<?= $a[$i][4] ?>'" value="刪除" disabled>
                    </td>
                    <td class="admintd"><?= $a[$i][1] ?></td>
                    <td class="admintd"><?= $a[$i][2] ?></td>
                    <td class="admintd"><?= $a[$i][3] ?></td>
                    <td class="admintd"><?= $a[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $a[$i][4] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $a[$i][4] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $a[$i][4] ?>'" value="刪除">
                    </td>
                    <td class="admintd"><?= $a[$i][1] ?></td>
                    <td class="admintd"><?= $a[$i][2] ?></td>
                    <td class="admintd"><?= $a[$i][3] ?></td>
                    <td class="admintd"><?= $a[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function updown($a){
        if(@$_GET["updownnumber"]="升冪"){
            down($a,4);
            ?><script>document.getElementById("updownnumber").value="降冪"</script><?php
        }elseif(@$_GET["updownusername"]="升冪"){
            down($a,1);
            ?><script>document.getElementById("updownusername").value="降冪"</script><?php
        }elseif(@$_GET["updowncode"]="升冪"){
            down($a,2);
            ?><script>document.getElementById("updowncode").value="降冪"</script><?php
        }elseif(@$_GET["updownname"]="升冪"){
            down($a,3);
            ?><script>document.getElementById("updownname").value="降冪"</script><?php
        }elseif(@$_GET["upupusername"]="降冪"){
            up($a,1);
        }elseif(@$_GET["upupcode"]="降冪"){
            up($a,2);
        }elseif(@$_GET["upupname"]="降冪"){
            up($a,3);
        }else{
            up($a,4);
        }
    }
?>