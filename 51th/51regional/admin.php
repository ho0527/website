<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="navigationbar">
            <div class="navigationbartitle">網路問卷管理系統</div>
            <div class="navigationbarbuttondiv">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="首頁">
                <input type="button" class="navigationbarbutton" id="newform" value="新增問卷">
                <input type="submit" class="navigationbarbutton" onclick="location.href='link.php?logout='" value="登出">
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
            $row=query($db,"SELECT*FROM `question` WHERE `ps`!='del'");
            for($i=0;$i<count($row);$i=$i+1){
                $id=$row[$i][0];
                $coderow=query($db,"SELECT*FROM `questioncode` WHERE `questionid`='$id'");
                ?>
                <tr>
                    <td class="formtd"><?php echo($row[$i][1]) ?></td>
                    <td class="formtd">
                        <?php
                            for($j=0;$j<count($coderow);$j=$j+1){
                                echo($coderow[$j][3]);
                            }
                        ?>
                    </td>
                    <td class="formtd"><?php echo($row[$i][4]) ?></td>
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
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <div class="check" id="check">
            <div class="mask"></div>
            <div class="main">
                <form>
                    問卷名稱: <input type="text" class="input" name="title" placeholder="問卷名稱"><br><br>
                    問卷題數: <input type="text" class="input" name="count" placeholder="問卷題數"><br><br>
                    <input type="submit" class="button" name="clear" value="取消">
                    <input type="submit" class="button" name="submit" value="確定">
                </form>
            </div>
        </div>
        <?php
            if(isset($_GET["submit"])){
                $title=$_GET["title"];
                $count=$_GET["count"];
                $row=query($db,"SELECT*FROM `question` WHERE `title`=?",[$title])[0];
                if($title==""){
                    ?><script>alert("請輸入問卷標題");location.href="admin.php"</script><?php
                }elseif($row){
                    ?><script>alert("問卷已存在");location.href="admin.php"</script><?php
                }elseif(preg_match("/^[0-9]+$/",$count)){
                    query($db,"INSERT INTO `question`(`title`,`questioncount`)VALUES(?,?)",[$title,$count]);
                    $_SESSION["title"]=$title;
                    $_SESSION["count"]=$count;
                    ?><script>alert("登入成功");location.href="form.php"</script><?php
                }else{
                    ?><script>alert("問卷題數請輸入數字");location.href="admin.php"</script><?php
                }
            }
            if(isset($_GET["mod"])){
                if($_GET["mod"]=="lock"){
                    $id=$_GET["id"];
                    $row=query($db,"SELECT*FROM `question` WHERE `id`='$id'")[0];
                    if($row[5]=="true"){
                        query($db,"UPDATE `question` SET `lock`=? WHERE `id`='$id'",["false"]);
                    }else{
                        query($db,"UPDATE `question` SET `lock`=? WHERE `id`='$id'",["true"]);
                    }
                    ?><script>location.href="admin.php"</script><?php
                }elseif($_GET["mod"]=="edit"){
                    $id=$_GET["id"];
                    $row=query($db,"SELECT*FROM `question` WHERE `id`='$id'")[0];
                    if($row[5]=="false"){
                        $_SESSION["id"]=$row[0];
                        $_SESSION["count"]=$row[2];
                        ?><script>location.href="form.php"</script><?php
                    }else{
                        ?><script>alert("[ERROR]PERMISSION ERROR(幹不要亂搞)");location.href="admin.php"</script><?php
                    }
                }elseif($_GET["mod"]=="del"){
                    $id=$_GET["id"];
                    $row=query($db,"SELECT*FROM `question` WHERE `id`='$id'")[0];
                    if($row[5]=="false"){
                        ?><script>
                            if(confirm("Are you sure you want to delete this?")){
                                location.href="link.php?formdel=&id=<?php echo($id) ?>"
                            }else{
                                location.href="admin.php"
                            }
                        </script><?php
                    }else{
                        ?><script>alert("[ERROR]PERMISSION ERROR(幹不要亂搞)");location.href="admin.php"</script><?php
                    }
                }
            }
            if(isset($_GET["clear"])){
                session_unset();
                header("location:admin.php");
            }
        ?>
        <script src="admin.js"></script>
    </body>
</html>