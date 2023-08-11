<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>專案討論系統</title>
        <link href="index.css" rel="stylesheet">
        <link rel="stylesheet" href="plugin/css/chrisplugin.css">
        <script src="plugin/js/chrisplugin.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
            $id=$_SESSION["data"];
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">專案討論系統</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='project.php'" value="新增專案">
                <?php
                    if($_SESSION["data"]==1){ ?><input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理"><?php }
                ?>
                <input type="button" class="navigationbarbutton" onclick="location.href='project.php'" value="專案管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='teamleader.php'" value="組長功能管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='statistic.php'" value="統計管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
            </div>
        </div>
        <div class="main mainmainmain macossectiondivy">
            <table class="table">
                <tr>
                    <td class="maintd">專案id</td>
                    <td class="maintd">職位</td>
                    <td class="maintd">planid</td>
                    <td class="maintd">使用者列表</td>
                    <td class="maintd">功能</td>
                </tr>
                <?php
                    $projectdata=[];

                    $rowproject=query($db,"SELECT*FROM `project`");
                    for($i=0;$i<count($rowproject);$i=$i+1){
                        $projectid=$rowproject[$i][0];
                        $leader=$rowproject[$i][3];
                        $member=explode("|&|",$rowproject[$i][4]);
                        $status="";

                        if($id==$leader||$id=="1"){
                            $status="leader";
                        }elseif(in_array($id,$member)){
                            $status="member";
                        }else{
                            $status="false";
                        }

                        if($status!="false"){
                            if($rowproject[$i][8]=="false"){
                                $projectdata[$i]=["projectid"=>$projectid,"status"=>$status,"data"=>"this project is not open"];
                            }elseif($rowproject[$i][8]=="true"){
                                $projectdata[$i]=["projectid"=>$projectid,"status"=>$status];
                                $rowplan=query($db,"SELECT*FROM `plan` WHERE `projectid`='$projectid'");
                                if(count($rowplan)>0){
                                    if($status=="leader"){
                                        for($j=0;$j<count($rowplan);$j=$j+1){
                                            $planid=$rowplan[$j][0];
                                            $rowplanscore=query($db,"SELECT*FROM `planscore` WHERE `planid`='$planid'");
                                            $nonescorelist=$member;
                                            for($k=0;$k<count($rowplanscore);$k=$k+1){
                                                $planscoreid=$rowplanscore[$k][0];
                                                $userid=$rowplanscore[$k][1];
                                                $nonescorelist=array_diff($nonescorelist,[$userid]);
                                            }
                                            if(count($nonescorelist)==0){
                                                $projectdata[$i]["data"][]=["planid"=>$planid,"message"=>"true"];
                                            }else{
                                                $nonescoreuseridlist=[];
                                                for($k=0;$k<count($nonescorelist);$k=$k+1){
                                                    $nonescoreuseridlist[]=$nonescorelist[$k];
                                                }
                                                $projectdata[$i]["data"][]=["planid"=>$planid,"message"=>"false","userid"=>$nonescoreuseridlist];
                                            }
                                        }
                                    }else{
                                        for($j=0;$j<count($rowplan);$j=$j+1){
                                            $planid=$rowplan[$j][0];
                                            $rowplanscore=query($db,"SELECT*FROM `planscore` WHERE `planid`='$planid'");
                                            $check=false;
                                            $nonescorelist=$member;
                                            for($k=0;$k<count($rowplanscore);$k=$k+1){
                                                $planscoreid=$rowplanscore[$k][0];
                                                $userid=$rowplanscore[$k][1];
                                                if($userid==$id){
                                                    $check=true;
                                                }
                                            }

                                            if($check){
                                                $projectdata[$i]["data"][]=["planid"=>$planid,"message"=>"true"];
                                            }else{
                                                $projectdata[$i]["data"][]=["planid"=>$planid,"message"=>"false"];
                                            }
                                        }
                                    }
                                }else{
                                    $projectdata[$i]=["projectid"=>$projectid,"status"=>$status,"data"=>"no plan in this project"];
                                }
                            }elseif($rowproject[$i][8]=="check"){
                                $projectdata[$i]=["projectid"=>$projectid,"status"=>$status,"data"=>"this project is end score"];
                            }else{
                                $projectdata[$i]=["projectid"=>$projectid,"status"=>$status,"data"=>"this project is end"];
                            }
                        }else{
                            $projectdata[$i]=["projectid"=>$projectid,"status"=>$status,"data"=>"user not in this project"];
                        }
                    }

                    $_SESSION["projectdata"]=$projectdata;
                    for($i=0;$i<count($projectdata);$i=$i+1){
                        if($projectdata[$i]["status"]=="leader"){
                            if(is_array($projectdata[$i]["data"])){
                                for($j=0;$j<count($projectdata[$i]["data"]);$j=$j+1){
                                    ?>
                                    <tr>
                                        <td class="maintd"><?php echo($projectdata[$i]["projectid"]); ?></td>
                                        <td class="maintd"><?php echo($projectdata[$i]["status"]); ?></td>
                                        <td class="maintd"><?php echo($projectdata[$i]["data"][$j]["planid"]); ?></td>
                                        <td class="maintd">
                                            <?php
                                            if($projectdata[$i]["data"][$j]["message"]=="true"){
                                                echo("已完成評分");
                                            }else{
                                                echo("userid: ".implode(", ",$projectdata[$i]["data"][$j]["userid"])." 尚未評分");
                                            }
                                            ?>
                                        </td>
                                        <td class="maintd"></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                <tr>
                                    <td class="maintd"><?php echo($projectdata[$i]["projectid"]); ?></td>
                                    <td class="maintd"><?php echo($projectdata[$i]["status"]); ?></td>
                                    <td class="maintd" colspan="3"><?php echo($projectdata[$i]["data"]); ?></td>
                                </tr>
                                <?php
                            }
                        }elseif($projectdata[$i]["status"]=="member"){
                            if(is_array($projectdata[$i]["data"])){
                                for($j=0;$j<count($projectdata[$i]["data"]);$j=$j+1){
                                    ?>
                                    <tr>
                                        <td class="maintd"><?php echo($projectdata[$i]["projectid"]); ?></td>
                                        <td class="maintd"><?php echo($projectdata[$i]["status"]); ?></td>
                                        <td class="maintd"><?php echo($projectdata[$i]["data"][$j]["planid"]); ?></td>
                                        <td class="maintd">
                                            <?php
                                            if($projectdata[$i]["data"][$j]["message"]=="true"){
                                                echo("已完成評分");
                                                ?><td class="maintd"></td><?php
                                            }else{
                                                echo("尚未評分");
                                                ?><td class="maintd"><input type="button" class="bluebutton" onclick="location.href='score.php?key=plan&id=<?php echo($projectdata[$i]['data'][$j]['planid']); ?>&projectid=<?php echo($projectdata[$i]['projectid']); ?>'" value="去評分"></td><?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                <tr>
                                    <td class="maintd"><?php echo($projectdata[$i]["projectid"]); ?></td>
                                    <td class="maintd"><?php echo($projectdata[$i]["status"]); ?></td>
                                    <td class="maintd" colspan="3"><?php echo($projectdata[$i]["data"]); ?></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                ?>
            </table>
        </div>
        <script src="index.js"></script>
    </body>
</html>