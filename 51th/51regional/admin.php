<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
        <script src="error.js"></script>
    </head>
    <body>
        <div class="navigationbar">
            <div class="navigationbartitle">網路問卷管理系統</div>
            <div class="navigationbarbuttondiv">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="首頁">
                <input type="button" class="navigationbarbutton" id="newform" value="新增問卷">
                <input type="submit" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
            </div>
        </div>
        <table class="formtable">
            <tr>
                <td class="formtdtitle">標題</td>
                <td class="formtdtitle">邀請碼</td>
                <td class="formtdtitle">填寫份數</td>
                <td class="formtdtitle">功能</td>
            </tr>
            <?php
            include("link.php");
            $data=$_SESSION["data"];
            $row=query($db,"SELECT*FROM `question` WHERE `ps`!='del'");
            for($i=0;$i<count($row);$i=$i+1){
                $id=$row[$i][0];
                $coderow=query($db,"SELECT*FROM `questioncode` WHERE `questionid`='$id'");
                ?>
                <tr id="<?php echo($id) ?>">
                    <td class="formtd"><?php echo($row[$i][1]) ?></td>
                    <td class="formtd">
                        <?php
                            for($j=0;$j<count($coderow);$j=$j+1){
                                if($coderow[$j][2]==""){ echo($coderow[$j][3]."<br>"); }
                                else{ echo($coderow[$j][2]." => ".$coderow[$j][3]."<br>"); }
                            }
                        ?>
                    </td>
                    <td class="formtd">
                        <?php
                        if($row[$i][6]!=""){ echo($row[$i][4]."/".$row[$i][6]); }
                        else{ echo($row[$i][4]); }
                        ?>
                    </td>
                    <td class="formtd">
                        <?php
                        if($row[$i][5]=="true"){
                            ?>
                            <input type="button" class="workbutton" onclick="location.href='?mod=lock&id=<?php echo($row[$i][0]) ?>'" value="解鎖"><br>
                            <input type="button" class="workbutton" onclick="location.href='?mod=edit&id=<?php echo($row[$i][0]) ?>'" value="編輯" disabled><br>
                            <input type="button" class="workbutton" onclick="location.href='?mod=del&id=<?php echo($row[$i][0]) ?>'" value="刪除" disabled><br>
                            <?php
                        }else{
                            ?>
                            <input type="button" class="workbutton" onclick="location.href='?mod=lock&id=<?php echo($row[$i][0]) ?>'" value="鎖定"><br>
                            <input type="button" class="workbutton" onclick="location.href='?mod=edit&id=<?php echo($row[$i][0]) ?>'" value="編輯"><br>
                            <input type="button" class="workbutton" onclick="location.href='?mod=del&id=<?php echo($row[$i][0]) ?>'" value="刪除"><br>
                            <?php
                        }
                        ?>
                        <input type="button" class="workbutton" onclick="location.href='?mod=results&id=<?php echo($row[$i][0]) ?>'" value="統計結果"><br>
                        <input type="button" class="workbutton" onclick="location.href='?mod=output&id=<?php echo($row[$i][0]) ?>'" value="輸出問卷"><br>
                        <input type="button" class="workbutton" onclick="location.href='?mod=copyquestion&id=<?php echo($row[$i][0]) ?>'" value="複製問題"><br>
                        <input type="button" class="workbutton" onclick="location.href='?mod=copyall&id=<?php echo($row[$i][0]) ?>'" value="複製全部"><br>
                        <?php
                            if(query($db,"SELECT*FROM `questioncode` WHERE `user`='$data'OR`user`=''")){
                                ?><input type="button" class="workbutton" onclick="location.href='?mod=respone&id=<?php echo($row[$i][0]) ?>'" value="填寫問卷"><?php
                            }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <div id="check"></div>
        <?php
            if(isset($_GET["submit"])){
                $title=$_GET["title"];
                $count=$_GET["count"];
                $row=query($db,"SELECT*FROM `question` WHERE `title`=?",[$title])[0];
                if($title==""){
                    ?><script>alert("[WARNING]請輸入問卷標題");location.href="admin.php"</script><?php
                }elseif($row){
                    ?><script>alert("[WARNING]問卷已存在");location.href="admin.php"</script><?php
                }elseif(preg_match("/^[0-9]+$/",$count)){
                    query($db,"INSERT INTO `question`(`title`,`questioncount`,`lock`)VALUES(?,?,'false')",[$title,$count]);
                    $_SESSION["title"]=$title;
                    $_SESSION["count"]=$count;
                    $_SESSION["id"]=$row[0];
                    ?><script>location.href="form.php"</script><?php
                }else{
                    ?><script>alert("[WARNING]問卷題數請輸入數字");location.href="admin.php"</script><?php
                }
            }
            if(isset($_GET["mod"])){
                $id=$_GET["id"];
                $mod=$_GET["mod"];
                $row=query($db,"SELECT*FROM `question` WHERE `id`='$id'")[0];
                if($mod=="lock"||$mod=="edit"||$mod=="del"){
                    if($row[5]=="false"){
                        if($mod=="lock"){
                            query($db,"UPDATE `question` SET `lock`='true' WHERE `id`='$id'");
                        }elseif($mod=="edit"){
                            $_SESSION["id"]=$row[0];
                            $_SESSION["count"]=$row[2];
                            ?><script>location.href="form.php"</script><?php
                        }elseif($mod=="del"){
                            ?><script>
                                if(confirm("Are you sure you want to delete?")){ location.href="api.php?formdel=&id=<?php echo($id) ?>" }
                                else{ location.href="admin.php" }
                            </script><?php
                        }else{ ?><script>e4032();location.href="admin.php"</script><?php }
                    }elseif($row[5]=="true"){
                        if($mod=="lock"){ query($db,"UPDATE `question` SET `lock`='false' WHERE `id`='$id'"); }
                        elseif($mod=="edit"||$mod=="del"){ ?><script>e403();location.href="admin.php"</script><?php }
                        else{ ?><script>e4032();location.href="admin.php"</script><?php }
                    }else{ ?><script>sql001();location.href="admin.php"</script><?php }
                    ?><script>location.href="admin.php"</script><?php
                }elseif($mod=="copyquestion"||$mod=="copyall"){
                    $row=query($db,"SELECT*FROM `question` WHERE `id`='$id'")[0];
                    $title=$row[1];
                    for($i=0;$i<1000000000000000000000000;$i=$i+1){
                        if($mod=="copyquestion"){ $title="copy ".$title; }else{ $title=$title." copy"; }
                        if(!query($db,"SELECT*FROM `question` WHERE `title`='$title'")[0]){ break; }
                    }
                    query($db,"INSERT INTO `question`(`title`,`questioncount`,`pagelen`,`responcount`,`lock`,`maxlen`)VALUES(?,?,?,?,?,?)",[$title,$row[2],$row[3],0,"false",$row[6]]);
                    $newrow=query($db,"SELECT*FROM `question` WHERE `title`='$title'")[0];
                    $questionlogrow=query($db,"SELECT*FROM `questionlog` WHERE `questionid`='$id'");
                    for($i=0;$i<count($questionlogrow);$i=$i+1){
                        if($mod=="copyquestion"){
                            query($db,"INSERT INTO `questionlog`(`questionid`,`order`,`required`,`mod`)VALUES(?,?,?,?)",[$newrow[0],$questionlogrow[$i][2],"false","none"]);
                        }else{
                            query($db,"INSERT INTO `questionlog`(`questionid`,`order`,`desciption`,`required`,`mod`,`opition`)VALUES(?,?,?,?,?,?)",[$newrow[0],$questionlogrow[$i][2],$questionlogrow[$i][3],$questionlogrow[$i][4],$questionlogrow[$i][5],$questionlogrow[$i][6]]);
                        }
                    }
                    ?><script>alert("成功");location.href="admin.php"</script><?php
                }elseif($mod=="respone"){
                    $id=$_GET["id"];
                    $_SESSION["id"]=$_GET["id"];
                    ?><script>location.href="user.php"</script><?php
                }else{
                    ?><script>e404();location.href="admin.php"</script><?php
                }
            }
        ?>
        <script src="admin.js"></script>
    </body>
</html>