<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
        ?>
        <div class="center">
            <table class="table">
                <tr>
                    <td class="td" id="td1"></td>
                    <td class="td" id="td2"></td>
                </tr>
                <tr>
                    <td class="td" id="td3"></td>
                    <td class="td" id="td4"></td>
                </tr>
            </table>
            <form class="gamebar">
                <input type="submit" class="verifybutton" name="logout" value="返回">
                <input type="button" class="verifybutton" onclick="location.reload()" value="清除">
                <input type="button" class="verifybutton" onclick="check()" value="確定">
                <input type="hidden" class="verifybutton" id="permission" value="<?= $_SESSION["permission"] ?>">
            </form>
        </div>
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
        ?>
        <div id="maskdiv"></div>
        <script src="verify.js"></script>
    </body>
</html>