<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>編輯問卷</title>
        <link rel="stylesheet" href="index.css">
        <script src="error.js"></script>
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <script src="plugin/js/macossection.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
            $id=$_SESSION["id"];
            $count=$_SESSION["count"];
            $row=query($db,"SELECT*FROM `question` WHERE `id`='$id'")[0];
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <script>
            let count="<?php echo($_SESSION["count"]) ?>"
            let row=[<?php query($db,"SELECT*FROM `questionlog` WHERE `questionid`='$id'") ?>]
        </script>
        <form method="POST">
            <div class="navigationbar">
                <div class="navigationbartitle">網路問卷管理系統-編輯問卷</div><br>
                <div class="navigationbarbuttondiv">
                    id: <input type="text" class="formtext" name="id" value="<?php echo($row[0]) ?>" style="width:50px" readonly>
                    標題: <input type="text" class="formtext" name="title" value="<?php echo($row[1]) ?>" style="width:120px">
                    總數: <input type="text" class="formtext" name="count" value="<?php echo($count) ?>" style="width:35px" readonly>
                    最大總數: <input type="text" class="formtext" name="max" value="<?php echo($row[6]) ?>" style="width:50px">
                    <input type="button" class="button" onclick="location.href='questioncode.php'" value="問卷邀請碼">
                    <input type="submit" class="button" name="newqust" value="新增">
                    <input type="button" class="button" onclick="location.href='api.php?cancel='" value="返回">
                    <input type="submit" class="button" name="save" value="儲存">
                    <input type="button" class="button" onclick="location.href='api.php?logout='" value="登出">
                </div>
            </div>
            <div class="div macosmaindiv macossectiondiv">
                <table>
                    <tr class="div<?php echo($i) ?>">
                        <td class="newform"></td>
                        <td class="newform"></td>
                    </tr>
                </table>
            </div>
        </form>
        <?php
            if(isset($_POST["newqust"])){
                $_SESSION["count"]=$_SESSION["count"]+1;
                ?><script>location.href="form.php"</script><?php
            }
            if(isset($_POST["save"])){
                $data=$_SESSION["data"];
                $title=$_POST["title"];
                $count=$_POST["count"];
                $max=$_POST["max"];
                $row=query($db,"SELECT*FROM `questionlog` WHERE `questionid`='$id'");
                query($db,"DELETE FROM `questionlog` WHERE `questionid`='$id'");
                for($i=0;$i<$count;$i=$i+1){
                    $mod=$_POST["select".$i];
                    if($mod!="none"){
                        $direction=$_POST["direction".$i];
                        $badbadcheck="";
                        $showantherans="true";
                        if(isset($_POST["required".$i])){ $required="true"; }else{ $required="false"; }
                        if($mod=="single"||$mod=="multi"){
                            for($j=1;$j<=6;$j=$j+1){
                                if($_POST[$i.$mod.$j]!=""){
                                    $opition=$opition.$_POST[$i.$mod.$j]."|&|";
                                    $badbadcheck=$badbadcheck.$_POST[$i.$mod.$j];
                                }
                            }
                        }else{
                            $opition="";
                        }
                        if(!isset($_POST["showauther".$i])){ $showantherans="false"; }
                    }else{
                        $direction="";
                        $required="false";
                        $opition="";
                    }
                    $order=$i+1;
                    if(preg_match("/\|\&\|/",$badbadcheck)){
                        ?><script>alert("禁止連續輸入|&| 位於第"+<?php echo($order) ?>+"欄，故選項不儲存")</script><?php
                        query($db,"INSERT INTO `questionlog`(`questionid`,`order`,`desciption`,`required`,`mod`,`opition`,`showmultimorerespond`)VALUES(?,?,?,?,?,?,?)",[$id,$order,$direction,$required,$mod,"",$showantherans]);
                    }else{
                        query($db,"INSERT INTO `questionlog`(`questionid`,`order`,`desciption`,`required`,`mod`,`opition`,`showmultimorerespond`)VALUES(?,?,?,?,?,?,?)",[$id,$order,$direction,$required,$mod,$opition,$showantherans]);
                    }
                }
                if($max==""||preg_match("/^[0-9]+$/",$max)){
                    query($db,"UPDATE `question` SET `title`=?,`questioncount`=?,`maxlen`=? WHERE `id`='$id'",[$title,$count,$max]);
                }else{
                    query($db,"UPDATE `question` SET `title`=?,`questioncount`=? WHERE `id`='$id'",[$title,$count]);
                    ?><script>alert("最大長度只能是數字或空白")</script><?php
                }
                query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$data','儲存問卷成功','$time','qid=$id')");
                ?><script>alert("儲存成功");location.href="form.php"</script><?php
            }
        ?>
        <script src="form.js"></script>
    </body>
</html>