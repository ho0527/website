<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <input type="button" class="button2" onclick="location.href='../../'" value="回到首頁">
        <div class="main">
            <form>
                <input type="search" name="search" placeholder="查詢">
                <button name="enter">送出</button>
            </form>
            <table class="maintable">
                <form>
                    <tr>
                        <td class="admintable">編號</td>
                        <td class="admintable">網址</td>
                        <td class="admintable">問題</td>
                        <td class="admintable">詳細敘述</td>
                        <td class="admintable">聯絡方式</td>
                        <td class="admintable">其他回復</td>
                        <td class="admintable">結果</td>
                        <td class="admintable">新增時間</td>
                        <td class="admintable">完成時間</td>
                    </tr>
                    <?php
                        include("link.php");
                        if(isset($_GET["enter"])){
                            $_SESSION["type"]=$_GET["search"];
                            header("location:adminWelcome.php");
                        }
                        if(isset($_SESSION["type"])){
                            $type=$_SESSION["type"];
                            if($type==""){
                                unset($_SESSION["type"]);
                                header("location:adminWelcome.php");
                            }else{
                                $data=fetchall(query($db,"SELECT*FROM `log` WHERE `usernumber`LIKE'%$type%' or `username`LIKE'%$type%' or `password`LIKE'%$type%' or `name`LIKE'%$type%' or `permission`LIKE'%$type%' or `logintime`LIKE'%$type%' or `logouttime`LIKE'%$type%' or `move`LIKE'%$type%' or `movetime`LIKE'%$type%'"));
                            }
                        }else{
                            $data=fetchall(query($db,"SELECT*FROM `log`"));
                        }
                        for($row=0;$row<count($data);$row=$row+1){
                            ?>
                            <tr>
                                <td class="admintable"><?php echo($data[$row][0]); ?></td>
                                <td class="admintable"><?php echo($data[$row][1]); ?></td>
                                <td class="admintable"><?php echo($data[$row][2]); ?></td>
                                <td class="admintable"><?php echo($data[$row][3]); ?></td>
                                <td class="admintable"><?php echo($data[$row][4]); ?></td>
                                <td class="admintable"><?php echo($data[$row][5]); ?></td>
                                <td class="admintable"><?php echo($data[$row][6]); ?></td>
                                <td class="admintable"><?php echo($data[$row][7]); ?></td>
                                <td class="admintable"><?php echo($data[$row][8]); ?></td>
                            </tr>
                            <?php
                        }
                        if(isset($_GET["del"])){
                            $number=$_GET["del"];
                            $user=query($db,"SELECT*FROM `user` WHERE `userNumber`='$number'");
                            $admin=query($db,"SELECT*FROM `admin` WHERE `adminNumber`='$number'");
                            if($row=fetch($user)){
                            query($db,"INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)VALUES('$number','$row[1]','$row[2]','$row[3]','一般使用者','-','-','管理員刪除','$time')");
                            query($db,"DELETE FROM `user` WHERE `userNumber`='$number'");
                            ?><script>alert("刪除成功!");location.href="adminWelcome.php"</script><?php
                            }elseif($row=fetch($admin)){
                            query($db,"INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)VALUES('$number','$row[1]','$row[2]','$row[3]','管理者','-','-','管理員刪除','$time')");
                            query($db,"DELETE FROM `admin` WHERE `adminNumber`='$number'");
                            ?><script>alert("刪除成功!");location.href="adminWelcome.php"</script><?php
                            }else{
                            ?><script>alert("帳號已被刪除!");location.href="adminWelcome.php"</script><?php
                            }
                        }
                    ?>
                </form>
            </table>
        </div>
    </body>
</html>