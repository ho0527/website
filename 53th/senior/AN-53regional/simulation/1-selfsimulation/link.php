<?php
    $db=new PDO("mysql:host=localhost;dbname=53regional;charset=utf8","admin","1234");
    date_default_timezone_set("Asia/Taipei");
    $date=date("Y-m-d H:i:s");
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
        @$data=$_SESSION["data"];
        if($row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"))){
            ?><script>alert("登出成功");location.href="index.php"</script><?php
            query($db,"INSERT INTO `data`( `number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$date','登出成功')");
            session_unset();
        }else{
            ?><script>alert("登出成功");location.href="index.php"</script><?php
            query($db,"INSERT INTO `data`( `number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES ('未知','','','','','','登出成功')");
            session_unset();
        }
    }

    function up($a,$c){
        for($i=0;$i<count($a);$i++){
            for($j=0;$j<count($a)-$i-1;$j++){
                if($a[$j][$c]>$a[$j+1][$c]){
                    $temp=$a[$j];
                    $a[$j]=$a[$j+1];
                    $a[$j+1]=$temp;
                }
            }
        }
        for($i=0;$i<count($a);$i++){
            if($a[$i][2]=="admin"||$a[$i][2]=="未知"){
                ?>
                <tr>
                    <td class="admtable">
                        <?= $a[$i][1] ?>
                        <input type="button" value="編輯" disabled>
                        <input type="submit" value="刪除" disabled>
                    </td>
                    <td class="admtable"><?= $a[$i][2] ?></td>
                    <td class="admtable"><?= $a[$i][3] ?></td>
                    <td class="admtable"><?= $a[$i][4] ?></td>
                    <td class="admtable"><?= $a[$i][5] ?></td>
                    <td class="admtable"><?= $a[$i][6] ?></td>
                    <td class="admtable"><?= $a[$i][7] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admtable">
                        <?= $a[$i][1] ?>
                        <input type="button" onclick="location.href='signupedit.php?num=<?= $a[$i][1] ?>'" value="編輯">
                        <button type="submit" name="del" value="<?= $a[$i][1] ?>">刪除</button>
                    </td>
                    <td class="admtable"><?= $a[$i][2] ?></td>
                    <td class="admtable"><?= $a[$i][3] ?></td>
                    <td class="admtable"><?= $a[$i][4] ?></td>
                    <td class="admtable"><?= $a[$i][5] ?></td>
                    <td class="admtable"><?= $a[$i][6] ?></td>
                    <td class="admtable"><?= $a[$i][7] ?></td>
                </tr>
                <?php
            }
        }
    }

    function down($a,$c){
        for($i=0;$i<count($a);$i++){
            for($j=0;$j<count($a)-$i-1;$j++){
                if($a[$j][$c]<$a[$j+1][$c]){
                    $temp=$a[$j];
                    $a[$j]=$a[$j+1];
                    $a[$j+1]=$temp;
                }
            }
        }
        for($i=0;$i<count($a);$i++){
            if($a[$i][2]=="admin"||$a[$i][2]=="未知"){
                ?>
                <tr>
                    <td class="admtable">
                        <?= $a[$i][1] ?>
                        <input type="button" value="編輯" disabled>
                        <input type="submit" value="刪除" disabled>
                    </td>
                    <td class="admtable"><?= $a[$i][2] ?></td>
                    <td class="admtable"><?= $a[$i][3] ?></td>
                    <td class="admtable"><?= $a[$i][4] ?></td>
                    <td class="admtable"><?= $a[$i][5] ?></td>
                    <td class="admtable"><?= $a[$i][6] ?></td>
                    <td class="admtable"><?= $a[$i][7] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admtable">
                        <?= $a[$i][1] ?>
                        <input type="button" onclick="location.href='signupedit.php?num=<?= $a[$i][1] ?>'" value="編輯">
                        <button type="submit" name="del" value="<?= $a[$i][1] ?>">刪除</button>
                    </td>
                    <td class="admtable"><?= $a[$i][2] ?></td>
                    <td class="admtable"><?= $a[$i][3] ?></td>
                    <td class="admtable"><?= $a[$i][4] ?></td>
                    <td class="admtable"><?= $a[$i][5] ?></td>
                    <td class="admtable"><?= $a[$i][6] ?></td>
                    <td class="admtable"><?= $a[$i][7] ?></td>
                </tr>
                <?php
            }
        }
    }

    function updown($db){
        @$num=$_GET["num"];
        @$username=$_GET["username"];
        @$name=$_GET["name"];
        @$code=$_GET["code"];
        if($num=="升冪"){
            down($db,1);
            ?><script>document.getElementById("num").value="降冪"</script><?php
        }elseif($username=="升冪"){
            down($db,2);
            ?><script>document.getElementById("username").value="降冪"</script><?php
        }elseif($code=="升冪"){
            down($db,3);
            ?><script>document.getElementById("code").value="降冪"</script><?php
        }elseif($name=="升冪"){
            down($db,4);
            ?><script>document.getElementById("name").value="降冪"</script><?php
        }elseif(isset($username)){
            up($db,2);
            ?><script>document.getElementById("username").value="升冪"</script><?php
        }elseif(isset($code)){
            up($db,3);
            ?><script>document.getElementById("code").value="升冪"</script><?php
        }elseif(isset($name)){
            up($db,4);
            ?><script>document.getElementById("name").value="升冪"</script><?php
        }else{
            up($db,1);
            ?><script>document.getElementById("num").value="升冪"</script><?php
        }
    }


?>