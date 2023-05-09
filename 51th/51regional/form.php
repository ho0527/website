<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>編輯問卷</title>
        <link rel="stylesheet" href="index.css">
        <script src="error.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
            $id=$_SESSION["id"];
            $count=$_SESSION["count"];
            $row=query($db,"SELECT*FROM `question` WHERE `id`='$id'")[0];
        ?>
        <form method="POST">
            <div class="navigationbar">
                <div class="navigationbartitle">網路問卷管理系統-編輯問卷</div><br>
                <div class="navigationbarbuttondiv">
                    id: <input type="text" class="formtext" name="id" value="<?php echo($row[0]) ?>" style="width:50px" readonly>
                    標題: <input type="text" class="formtext" name="title" value="<?php echo($row[1]) ?>" style="width:120px">
                    總數: <input type="text" class="formtext" name="count" value="<?php echo($count) ?>" style="width:35px" readonly>
                    最大總數: <input type="text" class="formtext" name="max" value="<?php echo($row[6]) ?>" style="width:50px">
                    <input type="button" class="button" onclick="location.href='questioncode.php'" value="問卷邀請碼">
                    <input type="submit" class="button" name="lestqust" value="減少">
                    <input type="submit" class="button" name="newqust" value="新增">
                    <input type="submit" class="button" name="cancel" value="返回">
                    <input type="submit" class="button" name="save" value="儲存">
                    <input type="button" class="button" onclick="location.href='api.php?logout='" value="登出">
                </div>
            </div>
            <div class="div">
                <table>
                    <?php
                        $questionrow=query($db,"SELECT*FROM `questionlog` WHERE `questionid`='$id'");
                        for($i=0;$i<$count;$i=$i+1){
                            $question=[];
                            if(@$questionrow[$i][6]!=""){ $question=explode("|&|",$questionrow[$i][6]); }
                            for($j=count($question);$j<6;$j=$j+1){
                                $question[]="";
                            }
                            ?>
                            <tr>
                                <td rowspan="2" class="order"><?php echo($questionrow[$i][2]) ?></td>
                                <td class="newform">
                                    <?php
                                    $mod=["none"=>"未設定","yesno"=>"是非題","single"=>"單選題","multi"=>"多選題","qa"=>"問答題"];
                                    $key=array_keys($mod);
                                    for($j=0;$j<count($key);$j=$j+1){
                                        $type=$key[$j];
                                        $checked="";
                                        if($questionrow[$i][5]==$type){
                                            $checked="checked";
                                            $check=1;
                                        }
                                        ?><input type="radio" class="radio <?php echo($type) ?>" id="<?php echo($type) ?> <?php echo($i) ?>" name="select<?php echo($i) ?>" value="<?php echo($type) ?>" <?php echo($checked) ?>><?php
                                        echo($mod[$key[$j]]);
                                    }
                                    if($check!=1){ ?><script>sql001();location.href="admin.php"</script><?php }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <?php
                                if(!isset($questionrow[$i][5])||$questionrow[$i][5]=="none"){
                                    ?><td class="output" id="output<?= $i ?>"></td><?php
                                }else{
                                    ?>
                                    <td class="output">
                                        <div class="questiondiv" id="output<?= $i ?>">
                                            <?php
                                            if($questionrow[$i][4]=="true"){
                                                ?>必填<input type="checkbox" name="required<?php echo($i) ?>" checked><br><?php
                                            }else{
                                                ?>必填<input type="checkbox" name="required<?php echo($i) ?>"><br><?php
                                            }
                                            ?>
                                            題目說明:<input type="text" class="directions" name="direction<?php echo($i) ?>" value="<?php echo($questionrow[$i][3]) ?>"><br>
                                            <?php
                                            if($questionrow[$i][5]=="yesno"){
                                                ?>
                                                是<input type="radio" name="yesno" value="yes" disabled>
                                                否<input type="radio" name="yesno" value="no" disabled>
                                                <?php
                                            }elseif($questionrow[$i][5]=="single"){
                                                ?>
                                                1.<input type="text" name="<?php echo($i) ?>single1" class="forminputtext" value="<?php echo($question[0]) ?>">
                                                2.<input type="text" name="<?php echo($i) ?>single2" class="forminputtext" value="<?php echo($question[1]) ?>">
                                                3.<input type="text" name="<?php echo($i) ?>single3" class="forminputtext" value="<?php echo($question[2]) ?>">
                                                4.<input type="text" name="<?php echo($i) ?>single4" class="forminputtext" value="<?php echo($question[3]) ?>">
                                                5.<input type="text" name="<?php echo($i) ?>single5" class="forminputtext" value="<?php echo($question[4]) ?>">
                                                6.<input type="text" name="<?php echo($i) ?>single6" class="forminputtext" value="<?php echo($question[5]) ?>">
                                                <?php
                                            }elseif($questionrow[$i][5]=="multi"){
                                                ?>
                                                1.<input type="text" name="<?php echo($i) ?>multi1" class="forminputtext" value="<?php echo($question[0]) ?>">
                                                2.<input type="text" name="<?php echo($i) ?>multi2" class="forminputtext" value="<?php echo($question[1]) ?>">
                                                3.<input type="text" name="<?php echo($i) ?>multi3" class="forminputtext" value="<?php echo($question[2]) ?>">
                                                4.<input type="text" name="<?php echo($i) ?>multi4" class="forminputtext" value="<?php echo($question[3]) ?>">
                                                5.<input type="text" name="<?php echo($i) ?>multi5" class="forminputtext" value="<?php echo($question[4]) ?>">
                                                6.<input type="text" name="<?php echo($i) ?>multi6" class="forminputtext" value="<?php echo($question[5]) ?>"><br>
                                                <?php
                                                    if($questionrow[$i][7]==""||$questionrow[$i][7]=="true"){
                                                        ?>顯示其他選項<input type="checkbox" name="showauther<?php echo($i) ?>" checked><?php
                                                    }else{
                                                        ?>顯示其他選項<input type="checkbox" name="showauther<?php echo($i) ?>"><?php
                                                    }
                                            }elseif($questionrow[$i][5]=="qa"){
                                                ?>
                                                <textarea cols="30" rows="5" placeholder="問答題" disabled></textarea>
                                                <?php
                                            }else{ ?><script>sql001();location.href="admin.php"</script><?php }
                                            ?>
                                        </div>
                                    </td>
                                    <?php
                                }
                            ?></tr><?php
                        }
                    ?>
                </table>
                <?php
                    if(isset($_POST["newqust"])){
                        $_SESSION["count"]=$_SESSION["count"]+1;
                        ?><script>location.href="form.php"</script><?php
                    }
                    if(isset($_POST["lestqust"])){
                        $_SESSION["count"]=$_SESSION["count"]-1;
                        ?><script>location.href="form.php"</script><?php
                    }
                    if(isset($_POST["save"])){
                        $title=$_POST["title"];
                        $count=$_POST["count"];
                        $max=$_POST["max"];
                        query($db,"UPDATE `question` SET `title`=?,`questioncount`=?,`maxlen`=? WHERE `id`='$id'",[$title,$count,$max]);
                        $row=query($db,"SELECT*FROM `questionlog` WHERE `questionid`='$id'");
                        if($count>count($row)){
                            $m=$count-count($row);
                            if(count($row)==0){ $max=0; }else{ $max=(int)$row[count($row)-1][2]; }
                            for($i=0;$i<$m;$i=$i+1){
                                $order=$i+$max+1;
                                query($db,"INSERT INTO `questionlog`(`questionid`,`order`)VALUES(?,?)",[$id,$order]);
                            }
                        }elseif($count<count($row)){
                            // $m=count($row)-$count;
                            // if(count($row)!=0){ $max=0; }else{ $max=(int)$row[count($row)-1][2]; }
                            // for($i=0;$i<$m;$i=$i+1){
                            //     $order=$i+$max+1;
                            //     query($db,"INSERT INTO `questionlog`(`questionid`,`order`)VALUES('$id','$order')");
                            // }
                        }
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
                                ?><script>alert("禁止連續輸入|&| 位於第"+<?php echo($order) ?>+"欄")</script><?php
                            }else{
                                query($db,"UPDATE `questionlog` SET `desciption`=?,`required`=?,`mod`=?,`opition`=?,`showmultimorerespond`='$showantherans' WHERE `questionid`='$id'AND`order`='$order'",[$direction,$required,$mod,$opition]);
                            }
                        }
                        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$data','儲存問卷成功','$time','qid=$id')");
                        ?><script>alert("儲存成功");location.href="form.php"</script><?php
                    }
                    if(isset($_POST["cancel"])){
                        unset($_SESSION["id"]);
                        unset($_SESSION["count"]);
                        ?><script>location.href="admin.php"</script><?php
                    }
                ?>
            </div>
        </form>
        <script src="form.js"></script>
    </body>
</html>