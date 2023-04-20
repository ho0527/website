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
            $row=fetch(query($db,"SELECT*FROM `question` WHERE `id`='$id'"));
        ?>
        <div class="div">
            <div class="formtitle">編輯問卷</div><br>
        </div>
        <form>
            id: <input type="text" class="formtext" name="id" value="<?php echo($row[0]) ?>" style="width:50px" readonly>
            標題: <input type="text" class="formtext" name="title" value="<?php echo($row[1]) ?>" style="width:120px">
            總數: <input type="text" class="formtext" name="count" value="<?php echo($count) ?>" style="width:35px">
            <input type="submit" class="button" name="newqust" value="新增">
            <input type="submit" class="button" name="lestqust" value="減少">
            <input type="submit" class="button" name="save" value="儲存">
            <input type="submit" class="button" name="cancel" value="取消">
            <input type="submit" class="button" name="logout" value="登出">
            <div class="">
                <?php
                    for($i=0;$i<$count;$i=$i+1){
                        ?>
                        <div class="divform">
                            <div class="newform">
                                未設定<input type="radio" class="radio none" id="none <?= $i ?>" name="select<?= $i ?>" value="none" checked>
                                是非題<input type="radio" class="radio yesno" id="yesno <?= $i ?>" name="select<?= $i ?>" value="yesno">
                                單選題<input type="radio" class="radio single" id="single <?= $i ?>" name="select<?= $i ?>" value="single">
                                多選題<input type="radio" class="radio multi" id="multi <?= $i ?>" name="select<?= $i ?>" value="multi">
                                問答題<input type="radio" class="radio qa" id="qa <?= $i ?>" name="select<?= $i ?>" value="qa">
                            </div>
                            <div class="output" id="output<?= $i ?>"></div>
                        </div>
                        <?php
                    }
                    if(isset($_GET["newqust"])){
                        $_SESSION["count"]=$_SESSION["count"]+1;
                        ?><script>location.href="form.php"</script><?php
                    }
                    if(isset($_GET["lestqust"])){
                        $_SESSION["count"]=$_SESSION["count"]-1;
                        ?><script>location.href="form.php"</script><?php
                    }
                    if(isset($_GET["save"])){
                        $title=$_GET["title"];
                        $count=$_GET["count"];
                        query($db,"UPDATE `question` SET `title`='$title',`questioncount`='$count' WHERE `id`='$id'");
                        for($i=0;$i<$count;$i=$i+1){
                            $select=$_GET["select".$i];
                            if(isset($_GET["required".$i])){
                                $required="true";
                            }else{
                                $required="false";
                            }
                            query($db,"INSERT INTO `questionlog`(`qusetionid`,``)VALUES('$title','$count')");
                        }
                        ?><script>alert("儲存成功");location.href="form.php"</script><?php
                    }
                    if(isset($_GET["cancel"])){
                        session_unset();
                        ?><script>alert("取消成功");location.href="admin.php"</script><?php
                    }
                ?>
            </div>
        </form>
        <script src="form.js"></script>
    </body>
</html>