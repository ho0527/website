<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>管理者專區</title>
        <link href="index.css" rel="Stylesheet">
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
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="專案管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="組長功能管理">
            </div>
        </div>
        <table>
            <tr>
            <td class="admin-title">
                <form>
                    管理者專區
                    <button type="button" onclick="location.href='signup.php'">新增</button>
                    <button name="logout">登出</button>
                </form>
            </td>
            <td class="admin-find">
                <form>
                    <input type="search" name="search" placeholder="查詢">
                    <button name="enter">送出</button>
                </form>
            </td>
            </tr>
            <tr>
            <td>
                <div class="admin">
                    <table class="main-table">
                        <form>
                        <tr>
                            <td class="admin-table-num">編號<input type="submit" name="num-up-down" id="num-up-down" value="升冪"></td>
                            <td class="admin-table">使用者帳號<input type="submit" name="user-up-down" id="user-up-down" value="升冪"></td>
                            <td class="admin-table">密碼<input type="submit" name="code-up-down" id="code-up-down" value="升冪"></td>
                            <td class="admin-table">名稱<input type="submit" name="name-up-down" id="name-up-down" value="升冪"></td>
                            <td class="admin-table">權限</td>
                            <td class="admin-table">登入時間</td>
                            <td class="admin-table">登出時間</td>
                            <td class="admin-table">動作</td>
                            <td class="admin-table">動作時間</td>
                        </tr>
                        <?php
                            include("link.php");
                            include("admindef.php");
                            @$admin_data=$_SESSION["data"];
                            if(isset($_GET["logout"])){
                                $admin=query("SELECT*FROM `admin` WHERE `adminNumber`='$admin_data'");
                                $row=fetch($admin);
                                if(isset($admin_data)){
                                    query("UPDATE `data` SET `logouttime`='$time' WHERE `usernumber`='$admin_data' AND `logouttime`=''");
                                    query("INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)VALUES('$admin_data','$row[1]','$row[2]','$row[3]','管理者','-','-','登出','$time')");
                                    session_unset();
                                    ?><script>alert("登出成功!");location.href="index.php"</script><?php
                                }else{
                                    query("INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)VALUES('null','','','','','','','登出','$time')");
                                    session_unset();
                                    ?><script>alert("登出成功!");location.href="index.php"</script><?php
                                }
                            }
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
                                    $data=query("SELECT*FROM `data` WHERE `usernumber`LIKE'%$type%' or `username`LIKE'%$type%' or `password`LIKE'%$type%' or `name`LIKE'%$type%' or `permission`LIKE'%$type%' or `logintime`LIKE'%$type%' or `logouttime`LIKE'%$type%' or `move`LIKE'%$type%' or `movetime`LIKE'%$type%'");
                                    issetgetupdown($data);
                                }
                            }else{
                                $data=query("SELECT*FROM `data`");
                                issetgetupdown($data);
                            }
                            if(isset($_GET["del"])){
                                $number=$_GET["del"];
                                $user=query("SELECT*FROM `user` WHERE `userNumber`='$number'");
                                $admin=query("SELECT*FROM `admin` WHERE `adminNumber`='$number'");
                                if($row=fetch($user)){
                                    query("INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)VALUES('$number','$row[1]','$row[2]','$row[3]','一般使用者','-','-','管理員刪除','$time')");
                                    query("DELETE FROM `user` WHERE `userNumber`='$number'");
                                    ?><script>alert("刪除成功!");location.href="adminWelcome.php"</script><?php
                                }elseif($row=fetch($admin)){
                                    query("INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)VALUES('$number','$row[1]','$row[2]','$row[3]','管理者','-','-','管理員刪除','$time')");
                                    query("DELETE FROM `admin` WHERE `adminNumber`='$number'");
                                    ?><script>alert("刪除成功!");location.href="adminWelcome.php"</script><?php
                                }else{
                                    ?><script>alert("帳號已被刪除!");location.href="adminWelcome.php"</script><?php
                                }
                            }
                        ?>
                        </form>
                    </table>
                </div>
            </td>
            </tr>
        </table>
    </body>
</html>