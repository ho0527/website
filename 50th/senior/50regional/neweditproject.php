<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>新增修改專案</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <link rel="stylesheet" href="plugin/css/sort.css">
        <link rel="stylesheet" href="plugin/css/chrisplugin.css">
        <script src="plugin/js/macossection.js"></script>
        <script src="plugin/js/sort.js"></script>
        <script src="plugin/js/chrisplugin.js"></script>
    </head>
    <body>
        <script> let key=""; </script>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
            if(isset($_GET["edit"])){
                $id=$_GET["edit"];
                $_SESSION["id"]=$id;
                $row=query($db,"SELECT*FROM `user` WHERE `id`='$id'")[0];
                ?>
                <script> key="edit"; </script>
                <div class="navigationbar">
                    <div class="navigationbarleft">
                        <div class="navigationbartitle">專案討論系統</div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='neweditproject.php'" value="修改">
                        <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='project.php'" value="專案管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='teamleader.php'" value="組長功能管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='statistics.php'" value="統計管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
                    </div>
                </div>
                <div class="main">
                    <form method="POST">
                        帳號: <input type="text" class="input" name="username" value="<?php echo($row[1]); ?>"><br><br>
                        密碼: <input type="password" class="input" name="password" value="<?php echo($row[2]); ?>"><br><br>
                        姓名: <input type="text" class="input" name="name" value="<?php echo($row[3]); ?>"><br><br>
                        <input type="button" class="button" onclick="location.href='admin.php'" value="返回">
                        <input type="submit" class="button" name="edit" value="送出"><br>
                    </form>
                </div>
                <?php
            }else{
                ?>
                <script> key="new"; </script>
                <div class="navigationbar">
                    <div class="navigationbarleft">
                        <div class="navigationbartitle">專案討論系統</div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='neweditproject.php'" value="新增">
                        <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='project.php'" value="專案管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='teamleader.php'" value="組長功能管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='statistics.php'" value="統計管理">
                        <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
                    </div>
                </div>
                <div class="main noborder">
                    <form method="POST">
                        <div class="projectgrid">
                            <div class="product">
                                <input type="text" class="middleinput" name="name" id="name" placeholder="專案名稱">
                                <input type="text" class="middleinput" name="desciption" id="desciption" placeholder="專案說明">
                                <input type="button" class="submitbutton" value="送出">
                            </div>
                            <div class="productmember grid">
                                <div class="leader sort macossectiondiv">
                                組長
                                    <hr>
                                </div>
                                <div class="member sort macossectiondiv">
                                    組員
                                    <hr>
                                </div>
                                <div class="userdiv sort macossectiondiv">
                                    使用者列表
                                    <hr>
                                    <?php
                                    $userrow=query($db,"SELECT*FROM `user`");
                                    for($i=0;$i<count($userrow);$i=$i+1){
                                        ?><div class="user"><?php echo($userrow[$i][1]); ?></div><?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="productfacing" id="productfacing">
                                <input type="button" class="button" id="newfacing" value="新增面向">
                                <div class="facingdiv">
                                    <div class="facing grid">
                                        <input type="text" class="input2 facingname" placeholder="面向名稱">
                                        <input type="text" class="input2 facingdesciption" placeholder="面向說明">
                                        <input type="button" class="noborderbutton facingdelect" value="X">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
            }
        ?>
    <?php
        if(isset($_POST["signup"])){
            $username=$_POST["username"];
            $password=$_POST["password"];
            $name=$_POST["name"];
            $row=query($db,"SELECT*FROM `user` WHERE `username`='$username'")[0];
            if($row){
                ?><script>alert("帳號已被註冊");location.href="signupedit.php"</script><?php
            }elseif($username==""||$password==""){
                ?><script>alert("請輸入帳密");location.href="signupedit.php"</script><?php
            }else{
                query($db,"INSERT INTO `user`(`username`,`password`,`name`)VALUES(?,?,?)",[$username,$password,$name]);
                $row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0];
                query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$row[0]','新增使用者','$time','')");
                ?><script>alert("新增成功");location.href="admin.php"</script><?php
            }
        }

        if(isset($_POST["edit"])){
            $id=$_SESSION["id"];
            $username=$_POST["username"];
            $password=$_POST["password"];
            $name=$_POST["name"];
            $row=query($db,"SELECT*FROM `user` WHERE `username`='$username'")[0];
            if($row&&$row[0]!=$id){
                ?><script>alert("帳號已被註冊");location.href="signupedit.php"</script><?php
            }elseif($username==""||$password==""){
                ?><script>alert("請輸入帳密");location.href="signupedit.php"</script><?php
            }else{
                query($db,"UPDATE `user` SET `username`=?,`password`=?,`name`=? WHERE `id`='$id'",[$username,$password,$name]);
                $row=query($db,"SELECT*FROM `user` WHERE `username`=?",[$username])[0];
                query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$row[0]','註冊使用者','$time','')");
                ?><script>alert("新增成功");location.href="admin.php"</script><?php
            }
        }

        if(isset($_GET["del"])){
            $id=$_GET["del"];
            if($row=query($db,"SELECT*FROM `user` WHERE `id`='$id'")[0]){
                query($db,"DELETE FROM `user` WHERE `id`='$id'");
                query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES('$row[0]','刪除使用者','$time','')");
                ?><script>alert("刪除成功!");location.href="admin.php"</script><?php
            }else{ ?><script>alert("帳號已被刪除!");location.href="admin.php"</script><?php }
        }
    ?>
    <script src="neweditproject.js"></script>
    </body>
</html>