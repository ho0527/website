<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>新增修改執行方案</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
            if(!isset($_GET["id"])){ header("location:project.php"); }
            $_SESSION["id"]=$_GET["id"];
            if(isset($_GET["edit"])){
                $id=$_GET["edit"];
                $_SESSION["planid"]=$id;
                $row=query($db,"SELECT*FROM `plan` WHERE `id`='$id'")[0];
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft">
                        <div class="navigationbartitle">專案討論系統</div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='neweditplan.php'" value="修改執行方案">
                        <?php
                            if($_SESSION["data"]==1){ ?><input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理"><?php }
                        ?>
                        <input type="button" class="navigationbarbutton" onclick="location.href='project.php'" value="專案管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='teamleader.php'" value="組長功能管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='statistics.php'" value="統計管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
                    </div>
                </div>
                <div class="main">
                    <form method="POST">
                        標題: <input type="text" class="input" name="title" value="<?php echo($row[2]); ?>"><br><br>
                        說明: <textarea class="textarea" name="description"><?php echo($row[3]); ?></textarea><br><br>
                        <?php
                            $projectid=$_SESSION["id"];
                            $facingrow=query($db,"SELECT*FROM `facing` WHERE `projectid`='$projectid'");
                            $rowplan=explode("|&|",$row[4]);
                            for($i=0;$i<count($facingrow);$i=$i+1){
                                $projectfacingid=$projectid."_".$facingrow[$i][0];
                                $opinionrow=query($db,"SELECT*FROM `opinion` WHERE `project_facingid`='$projectfacingid'");
                                ?>
                                <div class="selectdiv">
                                    <div class="selecttext"><?php echo($facingrow[$i][2]); ?></div>
                                    <select class="select" name="facing<?php echo($facingrow[$i][0]); ?>">
                                        <option value="none">不選擇</option>
                                        <?php
                                            for($j=0;$j<count($opinionrow);$j=$j+1){
                                                $facingopiniionid=$facingrow[$i][0]."_".$opinionrow[$j][0];
                                                $check=false;
                                                for($k=0;$k<count($rowplan);$k=$k+1){
                                                    if($rowplan[$k]==$facingopiniionid){
                                                        $check=true;
                                                        ?><option value="<?php echo($opinionrow[$j][0]); ?>" selected><?php echo($opinionrow[$j][4]); ?></option><?php
                                                    }
                                                }
                                                if(!$check){
                                                    ?><option value="<?php echo($opinionrow[$j][0]); ?>"><?php echo($opinionrow[$j][4]); ?></option><?php
                                                }
                                            }
                                        ?>
                                    </select><br>
                                </div>
                                <?php
                            }
                        ?><br>
                        <input type="button" class="button" onclick="location.href='admin.php'" value="返回">
                        <input type="submit" class="button" name="edit" value="送出"><br>
                    </form>
                </div>
                <?php
            }else{
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft">
                        <div class="navigationbartitle">專案討論系統</div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='neweditplan.php'" value="新增執行方案">
                        <?php
                            if($_SESSION["data"]==1){ ?><input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理"><?php }
                        ?>
                        <input type="button" class="navigationbarbutton" onclick="location.href='project.php'" value="專案管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='teamleader.php'" value="組長功能管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='statistics.php'" value="統計管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
                    </div>
                </div>
                <div class="main">
                    <form method="POST">
                        標題: <input type="text" class="input" name="title"><br><br>
                        說明: <textarea class="textarea" name="description"></textarea><br><br>
                        <?php
                            $projectid=$_SESSION["id"];
                            $projectrow=query($db,"SELECT*FROM `project` WHERE `id`='$projectid'")[0];
                            $facingrow=query($db,"SELECT*FROM `facing` WHERE `projectid`='$projectid'");
                            for($i=0;$i<count($facingrow);$i=$i+1){
                                $projectfacingid=$projectid."_".$facingrow[$i][0];
                                $opinionrow=query($db,"SELECT*FROM `opinion` WHERE `project_facingid`='$projectfacingid'");
                                ?>
                                <div class="selectdiv">
                                    <div class="selecttext"><?php echo($facingrow[$i][2]); ?></div>
                                    <select class="select" name="facing<?php echo($facingrow[$i][0]); ?>">
                                        <option value="none">不選擇</option>
                                        <?php
                                            for($j=0;$j<count($opinionrow);$j=$j+1){
                                                ?><option value="<?php echo($opinionrow[$j][0]); ?>"><?php echo($opinionrow[$j][4]); ?></option><?php
                                            }
                                        ?>
                                    </select><br>
                                </div>
                                <?php
                            }
                        ?><br>
                        <input type="button" class="button" onclick="location.href='admin.php'" value="返回">
                        <input type="submit" class="button" name="new" value="送出"><br>
                    </form>
                </div>
                <?php
            }
        ?>
    <?php
        $data=$_SESSION["data"];
        if(isset($_POST["new"])){
            $title=$_POST["title"];
            $description=$_POST["description"];
            $id=$_SESSION["id"];
            $row=query($db,"SELECT*FROM `plan` WHERE `title`='$title'AND`projectid`='$id'")[0];
            if($row){
                ?><script>alert("該執行方案已存在");location.href="neweditplan.php?id=<?php echo($id); ?>"</script><?php
            }elseif($title==""){
                ?><script>alert("請輸入標題");location.href="neweditplan.php?id=<?php echo($id); ?>"</script><?php
            }else{
                $facingopiniionid=[];
                $projectid=$_SESSION["id"];
                $facingrow=query($db,"SELECT*FROM `facing` WHERE `projectid`='$projectid'");
                for($i=0;$i<count($facingrow);$i=$i+1){
                    $id=$facingrow[$i][0];
                    $select=$_POST["facing".$id];
                    if($select!="none"){
                        $facingopiniionid[]=$id."_".$select;
                    }
                }
                query($db,"INSERT INTO `plan`(`projectid`,`title`,`description`,`facing_opinionid`)VALUES(?,?,?,?)",[$id,$title,$description,implode("|&|",$facingopiniionid)]);
                query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES(?,?,?,?)",[$data,"新增執行方案",$time,""]);
                ?><script>alert("新增成功");location.href="plan.php?id=<?php echo($projectid); ?>"</script><?php
            }
        }

        if(isset($_POST["edit"])){
            $title=$_POST["title"];
            $description=$_POST["description"];
            $id=$_SESSION["id"];
            $planid=$_SESSION["planid"];
            $row=query($db,"SELECT*FROM `plan` WHERE `title`='$title'AND`projectid`='$id'")[0];
            if($row&&$row[0]!=$planid){
                ?><script>alert("該執行方案已存在");location.href="neweditplan.php?id=<?php echo($id); ?>&edit=<?php echo($planid); ?>"</script><?php
            }elseif($title==""){
                ?><script>alert("請輸入標題");location.href="neweditplan.php?id=<?php echo($id); ?>&edit=<?php echo($planid); ?>"</script><?php
            }else{
                $facingopiniionid=[];
                $projectid=$_SESSION["id"];
                $facingrow=query($db,"SELECT*FROM `facing` WHERE `projectid`='$projectid'");
                for($i=0;$i<count($facingrow);$i=$i+1){
                    $id=$facingrow[$i][0];
                    $select=$_POST["facing".$id];
                    if($select!="none"){
                        $facingopiniionid[]=$id."_".$select;
                    }
                }
                query($db,"UPDATE `plan` SET `title`=?,`description`=?,`facing_opinionid`=? WHERE `id`='$planid'",[$title,$description,implode("|&|",$facingopiniionid)]);
                query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES(?,?,?,?)",[$data,"編輯執行方案",$time,""]);
                ?><script>alert("修改成功");location.href="plan.php?id=<?php echo($projectid); ?>"</script><?php
            }
        }

        if(isset($_GET["del"])){
            $id=$_GET["del"];
            if($row=query($db,"SELECT*FROM `plan` WHERE `id`='$id'")[0]){
                query($db,"DELETE FROM `plan` WHERE `id`='$id'");
                query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES(?,?,?,?)",[$data,"刪除執行方案",$time,""]);
                ?><script>alert("刪除成功!");location.href="plan.php?id=<?php echo($id); ?>"</script><?php
            }else{ ?><script>alert("帳號已被刪除!");location.href="plan.php?id=<?php echo($id); ?>"</script><?php }
        }
    ?>
    </body>
</html>