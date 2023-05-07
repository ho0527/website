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
            $row=query($db,"SELECT*FROM `question` WHERE `id`=?",[$id])[0];
            if($row[4]>=$row[6]&&$row[6]!=""){
                ?>
                <div class="navigationbar">
                    <div class="navigationbartitle">網路問卷管理系統-填寫問卷</div><br>
                    <div class="navigationbarbuttondiv">
                        id: <input type="text" class="formtext" name="id" value="<?php echo($row[0]) ?>" style="width:50px" readonly>
                        標題: <input type="text" class="formtext" name="title" value="<?php echo($row[1]) ?>" style="width:120px">
                        <input type="button" class="button" onclick="location.href='index.php'" value="返回">
                        <input type="submit" class="button" name="save" value="送出">
                        <input type="submit" class="button" name="logout" value="登出">
                    </div>
                </div>
                <div class="warning center">
                    您好~!本問卷已達所需之數量，感謝您的支持
                </div>
                <?php
            }else{
                ?>
                <form method="POST">
                    <div class="navigationbar">
                        <div class="navigationbartitle">網路問卷管理系統-編輯問卷</div><br>
                        <div class="navigationbarbuttondiv">
                            id: <input type="text" class="formtext" name="id" value="<?php echo($row[0]) ?>" style="width:50px" readonly>
                            標題: <input type="text" class="formtext" name="title" value="<?php echo($row[1]) ?>" style="width:120px">
                            總數: <input type="text" class="formtext" name="count" value="<?php echo($row[2]) ?>" style="width:35px" readonly>
                            <input type="submit" class="button" name="cancel" value="取消">
                            <input type="submit" class="button" name="save" value="送出">
                        </div>
                    </div>
                    <div class="div">
                        <table>
                            <?php
                                $questionrow=query($db,"SELECT*FROM `questionlog` WHERE `questionid`='$id'");
                                for($i=0;$i<count($questionrow);$i=$i+1){
                                    $question=[];
                                    if(@$questionrow[$i][6]!=""){ $question=explode(" ",$questionrow[$i][6]); }
                                    for($j=count($question);$j<6;$j=$j+1){
                                        $question[]="";
                                    }
                                    ?>
                                    <tr>
                                        <?php
                                        if(isset($questionrow[$i][5])&&$questionrow[$i][5]!="none"){
                                            ?><td rowspan="2" class="order">
                                                <?php
                                                if($questionrow[$i][4]=="true"){ ?><div class="required">*必填</div><?php }
                                                echo($questionrow[$i][2]);
                                                ?>
                                            </td><?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                        if(!isset($questionrow[$i][5])||$questionrow[$i][5]=="none"){}
                                        elseif($questionrow[$i][5]=="yesno"){
                                            ?>
                                            <td class="output" id="output<?= $i ?>">
                                                <div class="yesnodiv">
                                                    題目說明:<input type="text" class="directions" name="direction<?php echo($i) ?>" value="<?php echo($questionrow[$i][3]) ?>"><br>
                                                    是<input type="radio" name="yesno" value="yes">
                                                    否<input type="radio" name="yesno" value="no">
                                                </div>
                                            </td>
                                            <?php
                                        }elseif($questionrow[$i][5]=="single"){
                                            ?>
                                            <td class="output" id="output<?= $i ?>">
                                                <div class="singlediv">
                                                    題目說明:<input type="text" class="directions" name="direction<?php echo($i) ?>" value="<?php echo($questionrow[$i][3]) ?>"><br>
                                                    <?php
                                                    for($j=0;$j<6;$j=$j+1){
                                                        if(@$question[$j]!=""){
                                                            ?><input type="radio" name="single<?php echo($i) ?>" class="radio" value="<?php echo($j+1) ?>"><?php
                                                            echo($question[$j]." ");
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <?php
                                        }elseif($questionrow[$i][5]=="multi"){
                                            ?>
                                            <td class="output" id="output<?= $i ?>">
                                                <div class="multidiv">
                                                    題目說明:<input type="text" class="directions" name="direction<?php echo($i) ?>" value="<?php echo($questionrow[$i][3]) ?>"><br>
                                                    <?php
                                                    for($j=0;$j<6;$j=$j+1){
                                                        if(@$question[$j]!=""){
                                                            echo($j+1)?>.<input type="text" name="<?php echo($i) ?>multi1" class="forminputtext" value="<?php echo($question[$j]) ?>"><?php
                                                        }
                                                    }
                                                    ?><br>
                                                    其他:<input type="text" name="multiauther" class="forminputlongtext" value="">
                                                </div>
                                            </td>
                                            <?php
                                        }elseif($questionrow[$i][5]=="qa"){
                                            ?>
                                            <td class="output" id="output<?= $i ?>">
                                                <div class="questiondiv">
                                                    題目說明:<input type="text" class="directions" name="direction<?php echo($i) ?>" value="<?php echo($questionrow[$i][3]) ?>"><br><br>
                                                    <textarea cols="30" rows="5" placeholder="問答題"></textarea>
                                                </div>
                                            </td>
                                            <?php
                                        }else{
                                            ?><script>alert("[ERROR]SQL ERROR 請與程式開發者聯繫(ERROR CODE:001)");location.href="admin.php"</script><?php
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
                                // $title=$_POST["title"];
                                // $count=$_POST["count"];
                                // $max=$_POST["max"];
                                // for($i=0;$i<$count;$i=$i+1){
                                //     $mod=$_POST["select".$i];
                                //     if($mod!="none"){
                                //         $direction=$_POST["direction".$i];
                                //         if(isset($_POST["required".$i])){ $required="true"; }else{ $required="false"; }
                                //         if($mod=="single"){
                                //             for($j=1;$j<=6;$j=$j+1){
                                //                 if($_POST[$i."single".$j]!=""){
                                //                     $opition=$opition.$_POST[$i."single".$j]." ";
                                //                 }
                                //             }
                                //         }elseif($mod=="multi"){
                                //             for($j=1;$j<=6;$j=$j+1){
                                //                 if($_POST[$i."multi".$j]!=""){
                                //                     $opition=$opition.$_POST[$i."multi".$j]." ";
                                //                 }
                                //             }
                                //         }else{
                                //             $opition="";
                                //         }
                                //     }else{
                                //         $direction="";
                                //         $required="false";
                                //         $opition="";
                                //     }
                                //     $order=$i+1;
                                //     query($db,"UPDATE `questionlog` SET `desciption`=?,`required`=?,`mod`=?,`opition`=? WHERE `questionid`='$id'AND`order`='$order'",[$direction,$required,$mod,$opition]);
                                //     echo "\$opition ="; print_r($opition); echo "<br>";
                                // }
                                ?><script>alert("儲存成功");location.href="index.php"</script><?php
                            }
                            if(isset($_POST["cancel"])){
                                unset($_SESSION["id"]);
                                unset($_SESSION["count"]);
                                ?><script>location.href="index.php"</script><?php
                            }
                        ?>
                    </div>
                </form>
                <?php
            }
        ?>
        <script src="form.js"></script>
    </body>
</html>