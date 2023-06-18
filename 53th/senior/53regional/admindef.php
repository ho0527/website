<?php
    function up($row,$comp){
        usort($row,function($a,$b)use($comp){ return $a[$comp]>$b[$comp]||($a[$comp]==$b[$comp]&&$a[0]>$b[0]); });
        for($i=0;$i<count($row);$i=$i+1){
            if($row[$i][4]=="0000"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][4] ?>
                        <input type="button" onclick="location.href='signupedit.php?edit=<?= $row[$i][4] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='signupedit.php?del=<?= $row[$i][4] ?>'" value="刪除" disabled>
                    </td>
                    <td class="admintd"><?= $row[$i][1] ?></td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][4] ?>
                        <input type="button" onclick="location.href='signupedit.php?edit=<?= $row[$i][4] ?>'" value="修改">
                        <input type="button" onclick="location.href='signupedit.php?del=<?= $row[$i][4] ?>'" value="刪除">
                    </td>
                    <td class="admintd"><?= $row[$i][1] ?></td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function down($row,$comp){
        usort($row,function($a,$b)use($comp){ return $a[$comp]<$b[$comp]||($a[$comp]==$b[$comp]&&$a[0]>$b[0]); });
        for($i=0;$i<count($row);$i=$i+1){
            if($row[$i][4]=="0000"){
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][4] ?>
                        <input type="button" onclick="location.href='signupedit.php?edit=<?= $row[$i][4] ?>'" value="修改" disabled>
                        <input type="button" onclick="location.href='signupedit.php?del=<?= $row[$i][4] ?>'" value="刪除" disabled>
                    </td>
                    <td class="admintd"><?= $row[$i][1] ?></td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td class="admintd">
                        <?= $row[$i][4] ?>
                        <input type="button" onclick="location.href='signupedit.php?edit=<?= $row[$i][4] ?>'" value="修改">
                        <input type="button" onclick="location.href='signupedit.php?del=<?= $row[$i][4] ?>'" value="刪除">
                    </td>
                    <td class="admintd"><?= $row[$i][1] ?></td>
                    <td class="admintd"><?= $row[$i][2] ?></td>
                    <td class="admintd"><?= $row[$i][3] ?></td>
                    <td class="admintd"><?= $row[$i][5] ?></td>
                </tr>
                <?php
            }
        }
    }

    function updown($row){
        if(@$_GET["number"]=="升冪"){
            down($row,4);
            ?><script>document.getElementById("number").value="降冪"</script><?php
        }elseif(@$_GET["username"]=="升冪"){
            down($row,1);
            ?><script>document.getElementById("username").value="降冪"</script><?php
        }elseif(@$_GET["name"]=="升冪"){
            down($row,2);
            ?><script>document.getElementById("name").value="降冪"</script><?php
        }elseif(@$_GET["username"]=="降冪"){
            up($row,1);
        }elseif(@$_GET["name"]=="降冪"){
            up($row,2);
        }else{
            up($row,4);
        }
    }
?>