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
            if(!isset($_SESSION["data"])||$_SESSION["data"]!=1){ header("location:index.php"); }
            if(!isset($_SESSION["updown"])){ $_SESSION["updown"]="up"; }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">專案討論系統</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='signupedit.php'" value="新增">
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='admin.php'" value="使用者管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='project.php'" value="專案管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='teamleader.php'" value="組長功能管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='statistics.php'" value="統計管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
            </div>
        </div>
        <div class="main mainmain macossectiondiv">
            <table>
                <form>
                    <tr>
                        <td class="maintd">id</td>
                        <td class="maintd">帳號<input type="submit" name="updown" value="排序"></td>
                        <td class="maintd">密碼</td>
                        <td class="maintd">名稱</td>
                    </tr>
                    <?php
                        $row=query($db,"SELECT*FROM `user`");
                        if(isset($_GET["updown"])){
                            if($_SESSION["updown"]=="up"){
                                usort($row,function($a,$b){ return $a[1]<$b[1]||($a[1]==$b[1]&&$a[0]>$b[0]); });
                                $_SESSION["updown"]="down";
                            }else{
                                usort($row,function($a,$b){ return $a[1]>$b[1]||($a[1]==$b[1]&&$a[0]>$b[0]); });
                                $_SESSION["updown"]="up";
                            }
                        }
                        for($i=0;$i<count($row);$i=$i+1){
                            ?>
                                <tr>
                                    <td class="maintd">
                                        <?php echo($row[$i][0]); ?>
                                        <input type="button" class="bluebutton" onclick="location.href='signupedit.php?edit=<?php echo($row[$i][0]); ?>'" value="修改">
                                        <input type="button" class="bluebutton" onclick="location.href='signupedit.php?del=<?php echo($row[$i][0]); ?>'" value="刪除">
                                    </td>
                                    <td class="maintd"><?php echo($row[$i][1]); ?></td>
                                    <td class="maintd"><?php echo($row[$i][2]); ?></td>
                                    <td class="maintd"><?php echo($row[$i][3]); ?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </form>
            </table>
        </div>
    </body>
</html>