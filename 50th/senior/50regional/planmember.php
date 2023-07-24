<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>管理者專區</title>
        <link href="index.css" rel="stylesheet">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <script src="plugin/js/macossection.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
            if(!isset($_GET["id"])){ header("location:project.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">專案討論系統</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='neweditplan.php?id=<?php echo($_GET['id']); ?>'" value="新增執行方案">
                <?php
                    if($_SESSION["data"]==1){ ?><input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理"><?php }
                ?>
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='project.php'" value="專案管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='teamleader.php'" value="組長功能管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='statistic.php'" value="統計管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
            </div>
        </div>
        <div class="main mainmain macossectiondiv">
            <table>
                <form>
                    <tr>
                        <td class="maintd">title</td>
                        <td class="maintd">desciption</td>
                        <td class="maintd">function</td>
                    </tr>
                    <?php
                        $id=$_GET["id"];
                        $row=query($db,"SELECT*FROM `plan` WHERE `projectid`='$id'");
                        $projectrow=query($db,"SELECT*FROM `project` WHERE `id`='$id'")[0];
                        $leader=$projectrow[3];
                        for($i=0;$i<count($row);$i=$i+1){
                            $planid=$row[$i][0];
                            $scorerow=query($db,"SELECT*FROM `planscore` WHERE `planid`='$planid'");
                            $usercheck=true;
                            for($j=0;$j<count($scorerow);$j=$j+1){
                                $scoreuserid=$scorerow[$j][1];
                                $scoreuseerrow=query($db,"SELECT*FROM `user` WHERE `id`='$scoreuserid'")[0];
                                if($scoreuseerrow[0]==$_SESSION["data"]){ $usercheck=false; }
                            }
                            ?>
                            <tr>
                                <td class="maintd"><?php echo($row[$i][2]); ?></td>
                                <td class="maintd"><?php echo($row[$i][3]); ?></td>
                                <td class="maintd">
                                    <input type="button" class="bluebutton" onclick="location.href='viewplan.php?id=<?php echo($row[$i][0]); ?>'" value="查看">
                                    <?php
                                    if($leader!=$_SESSION["data"]){
                                        if($usercheck){
                                            if($row[$i][5]=="true"){
                                                ?><input type="button" class="bluebutton" onclick="location.href='score.php?key=plan&value=finish&id=<?php echo($row[$i][0]); ?>&projectid=<?php echo($id); ?>'" value="評分"><div class="warning">尚未填寫此項目!</div><?php
                                            }elseif($row[$i][5]=="false"){
                                                ?><input type="button" class="bluebutton" onclick="location.href='score.php?key=plan&value=true&id=<?php echo($row[$i][0]); ?>&projectid=<?php echo($id); ?>'" value="評分尚未開始"><?php
                                            }else{
                                                ?><input type="button" class="bluebutton" value="檢視結果"><?php
                                            }
                                        }else{
                                            if($row[$i][5]=="finish"){
                                                ?><input type="button" class="bluebutton" value="檢視結果"><?php
                                            }else{
                                                ?><input type="button" class="bluebutton" value="已完成評分" disabled><?php
                                            }
                                        }
                                    }else{
                                        ?><input type="button" class="bluebutton" value="組長無法評分" disabled><?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </form>
            </table>
        </div>
    </body>
</html>