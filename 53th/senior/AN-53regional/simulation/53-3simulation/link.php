<?php
    $db=new PDO("mysql:host=localhost;dbname=web02;charset=utf8","root","");
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
        return preg_match("/([  ,\~,\`,\!,\@,\#,\$,\^,\&,\*,\(,\),\_,\-,\+,\=,{,\},\[.\],\|,\\\,\:,\;,\",\',\<,\>,\,,\.,,\?,\/ ])/",$name);
    }

    if(isset($_GET["logout"])){
        $data=$_SESSION["data"];
        if($row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"))){
            query($db,"INSERT INTO `data`(`number`,`move1`,`move2`,`time`)VALUES('$row[1]','登出','成功','$time')");
        }else{
            query($db,"INSERT INTO `data`(`number`,`move1`,`move2`,`time`)VALUES('未知','登出','成功','$time')");
        }
        session_unset();
        ?><script>alert("登出成功");location.href="index.php"</script><?php
    }

    function up($row,$comp){
        usort($row,function($a,$b)use($comp){ return $a[$comp]>$b[$comp]||$a[$comp]==$b[$comp]&&$a[0]>$b[0]; });
        for($i=0;$i<count($row);$i++){
            if($row[$i][1]=="0000"){
                ?>
                <tr>
                    <td class="atd">
                        <?= $row[$i][1] ?>
                        <input type="button" class="but" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改" disabled>
                        <input type="button" class="but" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除" disabled>
                    </td>
                    <td class="atd"><?= $row[$i][2] ?></td>
                    <td class="atd"><?= $row[$i][3] ?></td>
                    <td class="atd"><?= $row[$i][4] ?></td>
                    <td class="atd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="atd">
                        <?= $row[$i][1] ?>
                        <input type="button" class="but" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改">
                        <input type="button" class="but" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除">
                    </td>
                    <td class="atd"><?= $row[$i][2] ?></td>
                    <td class="atd"><?= $row[$i][3] ?></td>
                    <td class="atd"><?= $row[$i][4] ?></td>
                    <td class="atd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function down($row,$comp){
        usort($row,function($a,$b)use($comp){ return $a[$comp]<$b[$comp]||$a[$comp]==$b[$comp]&&$a[0]>$b[0]; });
        for($i=0;$i<count($row);$i++){
            if($row[$i][1]=="0000"){
                ?>
                <tr>
                    <td class="atd">
                        <?= $row[$i][1] ?>
                        <input type="button" class="but" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改" disabled>
                        <input type="button" class="but" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除" disabled>
                    </td>
                    <td class="atd"><?= $row[$i][2] ?></td>
                    <td class="atd"><?= $row[$i][3] ?></td>
                    <td class="atd"><?= $row[$i][4] ?></td>
                    <td class="atd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="atd">
                        <?= $row[$i][1] ?>
                        <input type="button" class="but" onclick="location.href='edit.php?edit=<?= $row[$i][1] ?>'" value="修改">
                        <input type="button" class="but" onclick="location.href='edit.php?del=<?= $row[$i][1] ?>'" value="刪除">
                    </td>
                    <td class="atd"><?= $row[$i][2] ?></td>
                    <td class="atd"><?= $row[$i][3] ?></td>
                    <td class="atd"><?= $row[$i][4] ?></td>
                    <td class="atd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function updown($row){
        if(@$_GET["nb"]=="降冪"){
            down($row,1);
            ?><script>document.getElementById("nb").value="升冪"</script><?php
        }elseif(@$_GET["un"]=="降冪"){
            down($row,2);
            ?><script>document.getElementById("un").value="升冪"</script><?php
        }elseif(@$_GET["n"]=="降冪"){
            down($row,4);
            ?><script>document.getElementById("n").value="升冪"</script><?php
        }elseif(@$_GET["un"]=="升冪"){
            up($row,2);
        }elseif(@$_GET["n"]=="升冪"){
            up($row,4);
        }else{
            up($row,1);
        }
    }
?>