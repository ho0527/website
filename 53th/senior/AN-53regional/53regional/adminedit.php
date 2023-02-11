<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>重設帳密</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <div class="admintitle">
            <form>
                <div class="navigationbar">
                    <div class="navigationbardiv">
                        咖啡商品展示系統-編輯使用者
                        <input type="button" class="adminbutton" onclick="location.href='signup.php'" value="新增">
                        <input type="button" class="adminbutton" onclick="location.href='adminWelcome.php'" value="首頁">
                        <input type="button" class="adminbutton" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="adminbutton selectbut" onclick="location.href='manage.php'" value="會員管理">
                        <input type="submit" class="adminbutton" name="logout" value="登出">
                    </div>
                </div>
            </form>
        </div>
        <div class="signupdiv">
            <form>
                <?php
                    include("link.php");
                    if(isset($_GET["number"])){
                        $number=$_GET["number"];
                        if($row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"))){
                            ?>
                            <from class="text">
                                編號: <input type="text" name="number" value="<?php echo($number); ?>" readonly><br><br>
                                帳號: <input type="text" name="username" value="<?php echo($row[1]); ?>"><br><br>
                                用戶名: <input type="text" name="name" value="<?php echo($row[3]); ?>"><br><br>
                                密碼: <input type="text" name="code" value="<?php echo($row[2]); ?>"><br><br>
                                <?php
                                if($row[5]=="管理者"){
                                    ?>管理員權限: <input type="checkbox" name="adminbox" checked><br><br><?php
                                }else{
                                    ?>管理員權限: <input type="checkbox" name="adminbox"><br><br><?php
                                }
                                ?>
                                <button type="button" id="go_back" onclick="location.href='manage.php'">返回主頁</button>
                                <button name="enter">更改帳號</button>
                            </from>
                            <?php
                        }else{
                            ?><script>alert("帳號已被刪除!");location.href="manage.php"</script><?php
                        }
                    }
                    ?>
            </form>
        </div>
        <?php
            if(isset($_GET["enter"])){
                $username=$_GET["username"];
                $code=$_GET["code"];
                $name=$_GET["name"];
                $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                if($username==""&&$code==""){
                    ?><script>alert("請填寫帳密!")</script><?php
                }elseif($row&&$row[4]!=$number){
                    ?><script>alert("帳號已存在")</script><?php
                }else{
                    if($_GET["adminbox"]){
                        query($db,"UPDATE `user` SET `username`='$username' ,`name`='$name',`password`='$code',`permission`='管理者' WHERE `number`='$number'");
                        ?><script>alert("更改成功!");location.href="manage.php"</script><?php
                    }else{
                        query($db,"UPDATE `user` SET `username`='$username' ,`name`='$name',`password`='$code',`permission`='一般使用者' WHERE `number`='$number'");
                        ?><script>alert("更改成功!");location.href="manage.php"</script><?php
                    }
                }
            }
        ?>
    </body>
</html>