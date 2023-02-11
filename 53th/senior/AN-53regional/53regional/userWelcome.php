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
                            咖啡商品展示系統
                            <input type="button" class="adminbutton selectbut" onclick="location.href='userWelcome.php'" value="首頁">
                            <input type="button" class="adminbutton" value="上架商品">
                            <input type="button" class="adminbutton" onclick="location.href='usersearch.php'" name="enter" value="查詢">
                            <input type="submit" class="adminbutton" name="logout" value="登出">
                        </form>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="maintable">
                        <?php
                            product(query($db,"SELECT*FROM `coffee`"));
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
                    session_unset();
                    ?><script>alert("登出成功!");location.href="index.php"</script><?php
                }else{
                    query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('未知','','','','','','登出成功')");
                    session_unset();
                    ?><script>alert("登出成功!");location.href="index.php"</script><?php
                }
            }
        ?>
    </body>
</html>