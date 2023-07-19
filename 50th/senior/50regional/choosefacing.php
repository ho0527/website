<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>選擇討論面向</title>
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
                <input type="button" class="navigationbarbutton" onclick="location.href='neweditproject.php'" value="新增">
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
                    <td class="maintd">facing</td>
                    <td class="maintd">function</td>
                </tr>
                <?php
                    $id=$_GET["id"];
                    $row=query($db,"SELECT*FROM `project` WHERE `id`='$id'")[0];
                    if($row){
                        $data=explode("|&|",$row[5]);
                        for($i=0;$i<count($data);$i=$i+1){
                            ?>
                                <tr>
                                    <td class="maintd"><?php echo($data[$i]); ?></td>
                                    <td class="maintd">
                                        <input type="button" class="bluebutton" onclick="location.href='newopinion.php?id=<?php echo($id.'_'.$i); ?>'" value="進入討論">
                                    </td>
                                </tr>
                            <?php
                        }
                    }else{ ?><script>alert("專案不存在");location.href="project.php"</script><?php }
                ?>
            </table>
        </div>
    </body>
</html>