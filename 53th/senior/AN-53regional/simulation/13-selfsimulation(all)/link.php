<?php
    $db=new PDO("mysql:host=localhost;dbname=db13;charset=utf8","root","");
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

    function block($name){
        return preg_match("/([ ,\! \@ \# \$ \% \^ \& \* \( \) \_ \- \+ \= \[ \] \{ \} \' \" \/ \: \; \\\ \> \<  ])/",$name,$e);
    }

    if(isset($_GET["logout"])){
        $data=$_SESSION["data"];
        if($row=fetch(query($db,"SELECT*FROM `user`"))){
            query($db,"INSERT INTO `data`(`number`,`move`,`movetime`)VALUES('$row[1]','登出成功','$time')");
        }else{
            query($db,"INSERT INTO `data`(`number`,`move`,`movetime`)VALUES('未知','登出成功','$time')");
        }
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }

    function up($data,$comp){
        usort($data,function($a,$b)use($comp){ return $a[$comp]>$b[$comp]||$a[$comp]==$b[$comp]&&$a[0]>$b[0]; });
        for($i=0;$i<count($data);$i++){
            if($data[$i][1]=="0000"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $data[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $data[$i][1] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='edit.php?del=<?= $data[$i][1] ?>'" value="刪除" disabled>
                    </td>
                    <td class="admintd"><?= $data[$i][2] ?></td>
                    <td class="admintd"><?= $data[$i][3] ?></td>
                    <td class="admintd"><?= $data[$i][4] ?></td>
                    <td class="admintd"><?= $data[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $data[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $data[$i][1] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $data[$i][1] ?>'" value="刪除">
                    </td>
                    <td class="admintd"><?= $data[$i][2] ?></td>
                    <td class="admintd"><?= $data[$i][3] ?></td>
                    <td class="admintd"><?= $data[$i][4] ?></td>
                    <td class="admintd"><?= $data[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function down($data,$comp){
        usort($data,function($a,$b)use($comp){ return $a[$comp]<$b[$comp]||$a[$comp]==$b[$comp]&&$a[0]>$b[0]; });
        for($i=0;$i<count($data);$i++){
            if($data[$i][1]=="0000"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $data[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $data[$i][1] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='edit.php?del=<?= $data[$i][1] ?>'" value="刪除" disabled>
                    </td>
                    <td class="admintd"><?= $data[$i][2] ?></td>
                    <td class="admintd"><?= $data[$i][3] ?></td>
                    <td class="admintd"><?= $data[$i][4] ?></td>
                    <td class="admintd"><?= $data[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $data[$i][1] ?>
                        <input type="button" onclick="location.href='edit.php?edit=<?= $data[$i][1] ?>'" value="修改">
                        <input type="button" onclick="location.href='edit.php?del=<?= $data[$i][1] ?>'" value="刪除">
                    </td>
                    <td class="admintd"><?= $data[$i][2] ?></td>
                    <td class="admintd"><?= $data[$i][3] ?></td>
                    <td class="admintd"><?= $data[$i][4] ?></td>
                    <td class="admintd"><?= $data[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function updown($data){
        if(@$_GET["udnb"]=="升冪"){
            down($data,1);
            ?><script>document.getElementById("udnb").value="降冪"</script><?php
        }elseif(@$_GET["udun"]=="升冪"){
            down($data,2);
            ?><script>document.getElementById("udun").value="降冪"</script><?php
        }elseif(@$_GET["udn"]=="升冪"){
            down($data,4);
            ?><script>document.getElementById("udn").value="降冪"</script><?php
        }elseif(@$_GET["udun"]=="降冪"){
            up($data,2);
        }elseif(@$_GET["udn"]=="降冪"){
            up($data,4);
        }else{
            up($data,1);
        }
    }
?>