<?php
    $db=new PDO("mysql:host=localhost;dbname=db06;charset=utf8","admin","1234");
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
            query($db,"INSERT INTO `data`(`number`, `username`, `code`, `name`, `permission`, `move`, `movertime`) VALUES ('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','登出成功','$time')");
        }else{
            query($db,"INSERT INTO `data`(`number`, `username`, `code`, `name`, `permission`, `move`, `movertime`) VALUES ('未知','','','','','登出成功','$time')");
        }
        session_unset();
        ?><script>alert("登出成功");location.href="admin.php"</script><?php
    }

    function up($a,$comper){
        usort($a,function($a,$b)use($comper){ return $a[$comper]>$b[$comper]||($a[$comper]==$b[$comper]&&$a[0]>$b[0]); });
        for($i=0;$i<count($a);$i++){
            if($a[$i][1]=="0000"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $a[$i][1] ?>
                        <input type="button" value="修改" disabled>
                        <input type="button" value="刪除" disabled>
                    </td>
                    <td class="admintd"><?= $a[$i][2] ?></td>
                    <td class="admintd"><?= $a[$i][3] ?></td>
                    <td class="admintd"><?= $a[$i][4] ?></td>
                    <td class="admintd"><?= $a[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $a[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $a[$i][1] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $a[$i][1] ?>'" value="刪除">
                    </td>
                    <td class="admintd"><?= $a[$i][2] ?></td>
                    <td class="admintd"><?= $a[$i][3] ?></td>
                    <td class="admintd"><?= $a[$i][4] ?></td>
                    <td class="admintd"><?= $a[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function down($a,$comper){
        usort($a,function($a,$b)use($comper){ return $a[$comper]<$b[$comper]||$a[$comper]==$b[$comper]&&$a[0]>$b[0]; });
        for($i=0;$i<count($a);$i++){
            if($a[$i][1]=="0000"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $a[$i][1] ?>
                        <input type="button" value="修改" disabled>
                        <input type="button" value="刪除" disabled>
                    </td>
                    <td class="admintd"><?= $a[$i][2] ?></td>
                    <td class="admintd"><?= $a[$i][3] ?></td>
                    <td class="admintd"><?= $a[$i][4] ?></td>
                    <td class="admintd"><?= $a[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $a[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $a[$i][1] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $a[$i][1] ?>'" value="刪除">
                    </td>
                    <td class="admintd"><?= $a[$i][2] ?></td>
                    <td class="admintd"><?= $a[$i][3] ?></td>
                    <td class="admintd"><?= $a[$i][4] ?></td>
                    <td class="admintd"><?= $a[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function updown($a){
        if(@$_GET["updownnumber"]=="升冪"){
            down($a,1);
            ?><script>document.getElementById("updownnumber").value="降冪"</script><?php
        }elseif(@$_GET["updownusername"]=="升冪"){
            down($a,2);
            ?><script>document.getElementById("updownusername").value="降冪"</script><?php
        }elseif(@$_GET["updowncode"]=="升冪"){
            down($a,3);
            ?><script>document.getElementById("updowncode").value="降冪"</script><?php
        }elseif(@$_GET["updownname"]=="升冪"){
            down($a,4);
            ?><script>document.getElementById("updownname").value="降冪"</script><?php
        }elseif(@$_GET["updownusername"]=="降冪"){
            up($a,2);
        }elseif(@$_GET["updowncode"]=="降冪"){
            up($a,3);
        }elseif(@$_GET["updownname"]=="降冪"){
            up($a,4);
        }else{
            up($a,1);
        }
    }
?>