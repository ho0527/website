<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>重設帳密</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
        ?>
        <div class="main">
            <form>
                <?php
                    if(isset($_GET["number"])){
                        $number=$_GET["number"];
                        $user=query($db,"SELECT*FROM `user` WHERE `number`='$number'");
                        ?>
                        <from class="text">
                            編號: <input type="text" name="number" value="<?php echo($row[1]); ?>" readonly><br><br>
                            姓名: <input type="text" name="name" value="<?php echo($row[4]); ?>"><br><br>
                            帳號: <input type="text" name="username" value="<?php echo($row[2]); ?>"><br><br>
                            密碼: <input type="text" name="password" value="<?php echo($row[3]); ?>"><br><br>
                            <?php
                                if($row[5]=="管理者"){
                                    ?><input type="checkbox" name="admin" checked><?php
                                }else{
                                    ?><input type="checkbox" name="admin"><?php
                                }
                            ?>
                            <button name="enter">更改帳號</button>
                            <button type="button" onclick="location.href='admin.php'">返回主頁</button>
                        </from>
                        <?php
                    }else{
                        ?><script>alert("未知錯誤!");location.href="admin.php"</script><?php
                    }
                ?>
            </form>
        </div>
        <?php
            if(isset($_GET["enter"])){
                $number=$_GET["number"];
                $username=$_GET["username"];
                $password=$_GET["password"];
                $name=$_GET["name"];
                $user=query($db,"SELECT*FROM `user` WHERE `number`='$number'");
                if(block($username)||block($password)||block($name)){
                    ?><script>alert("禁止輸入特殊字元!");location.href="admin.php"</script><?php
                }else{
                    if($username==""||$password==""){
                        ?><script>alert("請填寫帳密!");location.href="admin.php"</script><?php
                    }elseif($row&&$row[1]!=$number){
                        ?><script>alert("帳號已存在");location.href="admin.php"</script><?php
                    }else{
                        if(isset($_GET["admin"])){
                            query($db,"UPDATE `user` SET `username`='$username',`password`='$password',`name`='$name',`permission`='管理者' WHERE `number`='$number'");
                        }else{
                            query($db,"UPDATE `user` SET `username`='$username',`password`='$password',`name`='$name',`permission`='一般使用者' WHERE `number`='$number'");
                        }
                        ?><script>alert("更改成功!");location.href="admin.php"</script><?php
                    }
                }
            }
        ?>
    </body>
</html>