<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>管理者專區</title>
        <link href="index.css" rel="stylesheet">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <script src="plugin/js/macossection.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">專案討論系統</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='neweditproject.php'" value="新增專案">
                <?php
                    if($_SESSION["data"]==1){ ?><input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理"><?php }
                ?>
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='project.php'" value="專案管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='teamleader.php'" value="組長功能管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='statistics.php'" value="統計管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
            </div>
        </div>
        <div class="main mainmain macossectiondiv">
            <table>
                <tr>
                    <td class="maintd">project name</td>
                    <td class="maintd">project desciption</td>
                    <td class="maintd">project function</td>
                </tr>
                <?php
                    $data=$_SESSION["data"];
                    $row=query($db,"SELECT*FROM `project`");
                    for($i=0;$i<count($row);$i=$i+1){
                        $leader=$row[$i][3];
                        $mamber=explode("|&|",$row[$i][4]);
                        $key=false;
                        for($j=0;$j<count($mamber);$j=$j+1){
                            if($mamber[$j]==$data){
                                $key=true;
                                break;
                            }
                        }
                        if($data=="1"||$leader==$data||$key==true){
                            ?>
                            <tr>
                                <td class="maintd"><?php echo($row[$i][1]); ?></td>
                                <td class="maintd"><?php echo($row[$i][2]); ?></td>
                                <td class="maintd">
                                    <input type="button" class="bluebutton" onclick="location.href='neweditproject.php?edit=<?php echo($row[$i][0]); ?>'" value="修改">
                                    <input type="button" class="bluebutton" onclick="location.href='neweditproject.php?del=<?php echo($row[$i][0]); ?>'" value="刪除"><br>
                                    <input type="button" class="bluebutton" onclick="location.href='choosefacing.php?id=<?php echo($row[$i][0]); ?>'" value="專案管理">
                                    <input type="button" class="bluebutton" onclick="location.href='planmember.php?id=<?php echo($row[$i][0]); ?>'" value="執行方案">
                                </td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </table>
        </div>
    </body>
</html>