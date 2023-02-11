<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>一般會員專區</title>
        <link href="index.css" rel="stylesheet">
    </head>
    <body>
        <?php
            include("link.php");
            include("userdef.php");
        ?>
        <table class="usermaintable">
            <tr>
                <td class="title">
                    <div class="navigationbar">
                        <form class="navigationbardiv" style="position: relative;top:20px;font-size:45px">
                            咖啡商品展示系統-查詢
                            <input type="button" class="adminbutton" onclick="location.href='userWelcome.php'" value="首頁">
                            <input type="button" class="adminbutton" value="上架商品">
                            <input type="button" class="adminbutton selectbut" onclick="location.href='usersearch.php'" name="enter" value="查詢">
                            <input type="submit" class="adminbutton" name="logout" value="登出">
                        </form>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="searchtd1">
                    <form>
                        <div class="radiobox">
                            數字範圍:<input type="radio" class="radio" name="but" id="numb" value="num">
                            關鍵字:<input type="radio" class="radio" name="but" id="text" value="text">
                        </div>
                        <div class="radiosearchtext" id="radiosearchtext">
                        </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="maintable">
                        <?php
                            if(isset($_GET["submit"])){
                                if($_GET["but"]=="num"){
                                    $start=$_GET["start"];
                                    $end=$_GET["end"];
                                    product(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost` AND `cost`<='$end'"));
                                }elseif($_GET["but"]=="text"){
                                    $text=$_GET["maintext"];
                                    product(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$text%' or `introduction`LIKE'%$text%' or `cost`LIKE'%$text%' or `date`LIKE'%$text%' or `link`LIKE'%$text%'"));
                                }
                            }else{
                                product(query($db,"SELECT*FROM `coffee`"));
                            }
                        ?>
                    </table>
                </td>
            </tr>
        </table>
        <?php
            @$data=$_SESSION["data"];
            if(isset($_GET["logout"])){
                $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"));
                if(isset($data)){
                query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登出成功')");
                ?><script>alert("登出成功!");location.href="index.php"</script><?php
                session_unset();
                }else{
                query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('未知','','','','','','登出成功')");
                ?><script>alert("登出成功!");location.href="index.php"</script><?php
                session_unset();
                }
            }
            if(isset($_GET["changetimersubmit"])){
                $_SESSION["timer"]=$_GET["changetimer"];
                ?><script>alert("更改成功!");location.href="adminWelcome.php"</script><?php
            }
        ?>
        <script src="usersearch.js"></script>
    </body>
</html>