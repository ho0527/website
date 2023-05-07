<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>編輯問卷</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            $id=$_SESSION["id"];
            $count=$_SESSION["count"];
            $row=query($db,"SELECT*FROM `question` WHERE `id`=?",[$id])[0];
            ?>
        <div class="div">
            <div class="formtitle">編輯問卷</div><br>
        </div>
        <form method="POST">
            id: <input type="text" class="formtext" name="id" value="<?php echo($row[0]) ?>" style="width:50px" readonly>
            標題: <input type="text" class="formtext" name="title" value="<?php echo($row[1]) ?>" style="width:120px">
            總數: <input type="text" class="formtext" name="count" value="<?php echo($count) ?>" style="width:35px" readonly>
            最大總數: <input type="text" class="formtext" name="count" value="<?php echo($row[7]) ?>" style="width:35px">
            <input type="button" class="button" name="questioncode" value="問卷邀請碼">
            <input type="submit" class="button" name="newqust" value="新增">
            <input type="submit" class="button" name="lestqust" value="減少">
            <input type="submit" class="button" name="save" value="儲存">
            <input type="submit" class="button" name="cancel" value="取消">
            <input type="submit" class="button" name="logout" value="登出">
            <div class="">
                <?php
                    $questionrow=fetchall(query($db,"SELECT*FROM `questionlog` WHERE `questionid`='$id'"));
                    for($i=0;$i<$count;$i=$i+1){
                        if(!isset($questionrow[$i][5])||$questionrow[$i][5]=="none"){
                            ?>
                            <div class="divform">
                                <div class="newform">
                                    未設定<input type="radio" class="radio none" id="none <?php echo($i) ?>" name="select<?= $i ?>" value="none" checked>
                                    是非題<input type="radio" class="radio yesno" id="yesno <?php echo($i) ?>" name="select<?= $i ?>" value="yesno">
                                    單選題<input type="radio" class="radio single" id="single <?php echo($i) ?>" name="select<?= $i ?>" value="single">
                                    多選題<input type="radio" class="radio multi" id="multi <?php echo($i) ?>" name="select<?= $i ?>" value="multi">
                                    問答題<input type="radio" class="radio qa" id="qa <?php echo($i) ?>" name="select<?= $i ?>" value="qa">
                                </div>
                                <div class="output" id="output<?= $i ?>"></div>
                            </div>
                            <?php
                        }elseif($questionrow[$i][5]=="yesno"){
                            ?>
                            <div class="divform">
                                <div class="newform">
                                    未設定<input type="radio" class="radio none" id="none <?= $i ?>" name="select<?= $i ?>" value="none">
                                    是非題<input type="radio" class="radio yesno" id="yesno <?= $i ?>" name="select<?= $i ?>" value="yesno" checked>
                                    單選題<input type="radio" class="radio single" id="single <?= $i ?>" name="select<?= $i ?>" value="single">
                                    多選題<input type="radio" class="radio multi" id="multi <?= $i ?>" name="select<?= $i ?>" value="multi">
                                    問答題<input type="radio" class="radio qa" id="qa <?= $i ?>" name="select<?= $i ?>" value="qa">
                                </div>
                                <div class="output" id="output<?= $i ?>">
                                    <div class="yesnodiv">
                                        <div class="formcenter">
                                            <?php
                                            if($questionrow[$i][4]=="true"){
                                                ?>
                                                必填<input type="checkbox" name="required<?php echo($i) ?>" checked><br>
                                                <?php
                                            }else{
                                                ?>
                                                必填<input type="checkbox" name="required<?php echo($i) ?>"><br>
                                                <?php
                                            }
                                            ?>
                                            題目說明:<input type="text" class="directions" name="direction<?php echo($i) ?>" value="<?php echo($questionrow[$i][3]) ?>"><br>
                                            是<input type="radio" name="yesno" value="yes">
                                            否<input type="radio" name="yesno" value="no">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }elseif($questionrow[$i][5]=="single"){
                            ?>
                            <div class="divform">
                                <div class="newform">
                                    未設定<input type="radio" class="radio none" id="none <?php echo($i) ?>" name="select<?= $i ?>" value="none">
                                    是非題<input type="radio" class="radio yesno" id="yesno <?php echo($i) ?>" name="select<?= $i ?>" value="yesno">
                                    單選題<input type="radio" class="radio single" id="single <?php echo($i) ?>" name="select<?= $i ?>" value="single" checked>
                                    多選題<input type="radio" class="radio multi" id="multi <?php echo($i) ?>" name="select<?= $i ?>" value="multi">
                                    問答題<input type="radio" class="radio qa" id="qa <?php echo($i) ?>" name="select<?= $i ?>" value="qa">
                                </div>
                                <div class="output" id="output<?= $i ?>">
                                    <div class="singlediv">
                                        <div class="formcenter">
                                            <?php
                                            if($questionrow[$i][4]=="true"){
                                                ?>
                                                必填<input type="checkbox" name="required<?php echo($i) ?>" checked><br>
                                                <?php
                                            }else{
                                                ?>
                                                必填<input type="checkbox" name="required<?php echo($i) ?>"><br>
                                                <?php
                                            }
                                            ?>
                                            題目說明:<input type="text" class="directions" name="direction<?php echo($i) ?>" value="<?php echo($questionrow[$i][3]) ?>"><br>
                                            1.<input type="text" name="single1" class="forminputtext" value="">
                                            2.<input type="text" name="single2" class="forminputtext" value="">
                                            3.<input type="text" name="single3" class="forminputtext" value="">
                                            4.<input type="text" name="single4" class="forminputtext" value="">
                                            5.<input type="text" name="single5" class="forminputtext" value="">
                                            6.<input type="text" name="single6" class="forminputtext" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }elseif($questionrow[$i][5]=="multi"){
                            ?>
                            <div class="divform">
                                <div class="newform">
                                    未設定<input type="radio" class="radio none" id="none <?php echo($i) ?>" name="select<?= $i ?>" value="none">
                                    是非題<input type="radio" class="radio yesno" id="yesno <?php echo($i) ?>" name="select<?= $i ?>" value="yesno">
                                    單選題<input type="radio" class="radio single" id="single <?php echo($i) ?>" name="select<?= $i ?>" value="single">
                                    多選題<input type="radio" class="radio multi" id="multi <?php echo($i) ?>" name="select<?= $i ?>" value="multi" checked>
                                    問答題<input type="radio" class="radio qa" id="qa <?php echo($i) ?>" name="select<?= $i ?>" value="qa">
                                </div>
                                <div class="output" id="output<?= $i ?>">
                                    <div class="multidiv">
                                        <div class="formcenter">
                                            <?php
                                            if($questionrow[$i][4]=="true"){
                                                ?>
                                                必填<input type="checkbox" name="required<?php echo($i) ?>" checked><br>
                                                <?php
                                            }else{
                                                ?>
                                                必填<input type="checkbox" name="required<?php echo($i) ?>"><br>
                                                <?php
                                            }
                                            ?>
                                            題目說明:<input type="text" class="directions" name="direction<?php echo($i) ?>" value="<?php echo($questionrow[$i][3]) ?>"><br>
                                            1.<input type="text" name="multi1" class="forminputtext" value="">
                                            2.<input type="text" name="multi2" class="forminputtext" value="">
                                            3.<input type="text" name="multi3" class="forminputtext" value="">
                                            4.<input type="text" name="multi4" class="forminputtext" value="">
                                            5.<input type="text" name="multi5" class="forminputtext" value="">
                                            6.<input type="text" name="multi6" class="forminputtext" value=""><br>
                                            其他:<input type="text" name="multiauther" class="forminputlongtext" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }elseif($questionrow[$i][5]=="qa"){
                            ?>
                            <div class="divform">
                                <div class="newform">
                                    未設定<input type="radio" class="radio none" id="none <?php echo($i) ?>" name="select<?= $i ?>" value="none">
                                    是非題<input type="radio" class="radio yesno" id="yesno <?php echo($i) ?>" name="select<?= $i ?>" value="yesno">
                                    單選題<input type="radio" class="radio single" id="single <?php echo($i) ?>" name="select<?= $i ?>" value="single">
                                    多選題<input type="radio" class="radio multi" id="multi <?php echo($i) ?>" name="select<?= $i ?>" value="multi">
                                    問答題<input type="radio" class="radio qa" id="qa <?php echo($i) ?>" name="select<?= $i ?>" value="qa" checked>
                                </div>
                                <div class="output" id="output<?= $i ?>">
                                    <div class="questiondiv">
                                        <div class="formcenter">
                                            <br>
                                            <?php
                                            if($questionrow[$i][4]=="true"){
                                                ?>
                                                必填<input type="checkbox" name="required<?php echo($i) ?>" checked><br>
                                                <?php
                                            }else{
                                                ?>
                                                必填<input type="checkbox" name="required<?php echo($i) ?>"><br>
                                                <?php
                                            }
                                            ?>
                                            題目說明:<input type="text" class="directions" name="direction<?php echo($i) ?>" value="<?php echo($questionrow[$i][3]) ?>"><br>
                                            <textarea cols="30" rows="5" placeholder="問答題"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }else{
                            ?><script>alert("[ERROR]SQL ERROR 請與程式開發者聯繫 (ERROR CODE: 01)");location.href="admin.php"</script><?php
                        }
                    }
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
                        query($db,"UPDATE `question` SET `title`='$title',`questioncount`='$count' WHERE `id`='$id'");
                        $row=fetchall(query($db,"SELECT*FROM `questionlog` WHERE `questionid`='$id'"));
                        if($count>count($row)){
                            $m=$count-count($row);
                            if(count($row)==0){ $max=0; }else{ $max=(int)$row[count($row)-1][2]; }
                            for($i=0;$i<$m;$i=$i+1){
                                $order=$i+$max+1;
                                query($db,"INSERT INTO `questionlog`(`questionid`,`order`)VALUES('$id','$order')");
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
                            $select=$_POST["select".$i];
                            $direction=$_POST["direction".$i];
                            if(isset($_POST["required".$i])){
                                $required="true";
                            }else{
                                $required="false";
                            }
                            $order=$i+1;
                            $opition="";
                            query($db,"UPDATE `questionlog` SET `desciption`='$direction',`required`='$required',`mod`='$select',`opition`='$opition' WHERE `questionid`='$id'AND`order`='$order'");
                        }
                        ?><script>alert("儲存成功");location.href="form.php"</script><?php
                    }
                    if(isset($_POST["cancel"])){
                        session_unset();
                        ?><script>location.href="admin.php"</script><?php
                    }
                ?>
            </div>
        </form>
        <script src="form.js"></script>
    </body>
</html>