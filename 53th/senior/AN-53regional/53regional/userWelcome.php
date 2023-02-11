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
                        <div class="navigationbardiv" style="position: relative;top:20px;font-size:45px">
                            咖啡商品展示系統
                            <input type="button" class="adminbutton" onclick="location.href='productindex.php'" value="上架商品">
                            <input type="submit" class="adminbutton" name="logout" value="登出">
                            <button class="adminbutton" name="enter">查詢</button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="maintable">
                        <?php
                            product($db);
                        ?>
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
                </td>
                <td class="user-table4">
                </td>
            </tr>
        </table>
        <form>
            <?php
                // if(isset($_SESSION["priority"])||isset($_SESSION["deal"])){
                //     @$priority=$_SESSION["priority"];
                //     @$deal=$_SESSION["deal"];
                //     $todo_conditions="`date`='$date'";
                //     if($deal!="篩選器"){
                //         $todo_conditions=$todo_conditions." AND `deal`='$deal'";
                //     }
                //     if($priority!="篩選器"){
                //         $todo_conditions=$todo_conditions." AND `priority`='$priority'";
                //     }
                //     $todo=mysqli_query($db,"SELECT*FROM `todo` WHERE $todo_conditions");
                //     if($start=="升冪"){
                //         uper($todo);
                //     }else{
                //         lower($todo);
                //     }
                // }else{
                //     $todo=mysqli_query($db, "SELECT*FROM `todo` WHERE `date`='$date'");
                //     if($start=="升冪"){
                //         uper($todo);
                //     }else{
                //         lower($todo);
                //     }
                // }
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
        </form>
        <script src="todobox.js"></script>
    </body>
</html>