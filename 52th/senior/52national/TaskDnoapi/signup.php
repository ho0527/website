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
            if(isset($_SESSION["data"])){ header("location:main.php"); }
        ?>
        <div class="main">
            <form method="POST" enctype="multipart/form-data">
                <h2>新增使用者</h2>
                <hr>
                email <input type="text" class="input" name="email"><br><br>
                密碼 <input type="password" class="input" name="password"><br><br>
                暱稱 <input type="text" class="input" name="nickname"><br><br>
                管理員權限<input type="checkbox" class="checkbox" name="admin">
                <input type="button" class="button" name="password" onclick="document.getElementById('file').click()" value="上傳頭像"><br><br>
                <input type="button" class="longbutton" onclick="location.href='index.php'" value="返回主頁">
                <input type="submit" class="longbutton" name="signupsubmit" value="送出">
                <input type="file" class="file" id="file" name="selfimage" accept=".png,.jpg">
            </form>
        </div>
        <?php
            if(isset($_POST["signupsubmit"])){
                $email=$_POST["email"];
                $password=$_POST["password"];
                $nickname=$_POST["nickname"];
                $row=query($db,"SELECT*FROM `user` WHERE `email`='$email'");
                if($email==""||$password==""){
                    ?><script>alert("請填寫帳密!");location.href="signupedit.php"</script><?php
                }elseif($row){
                    ?><script>alert("帳號已存在");location.href="signupedit.php"</script><?php
                }else{
                    $file="";
                    if(isset($_FILES["selfimage"]["name"])){
                        $file="image/selfimage/".$_FILES["selfimage"]["name"];
                        $j=1;
                        while(file_exists($file)){
                            $file="image/selfimage/".$j."_".$_FILES["selfimage"]["name"];
                            $j=$j+1;
                        }
                        move_uploaded_file($_FILES["selfimage"]["tmp_name"],$file);
                    }
                    if(isset($_POST["admin"])){
                        query($db,"INSERT INTO `user`(`selfimage`,`email`,`nickname`,`password`,`permission`)VALUES(?,?,?,?,'admin')",[$file,$email,$nickname,$password]);
                    }else{
                        query($db,"INSERT INTO `user`(`selfimage`,`email`,`nickname`,`password`,`permission`)VALUES(?,?,?,?,'user')",[$file,$email,$nickname,$password]);
                    }
                    $row=query($db,"SELECT*FROM `user` WHERE `email`='$email'")[0];
                    query($db,"INSERT INTO `log`(`number`,`move`,`time`)VALUES('$row[0]','註冊成功','$time')");
                    ?><script>alert("註冊成功!");location.href="index.php"</script><?php
                }
            }
        ?>
    </body>
</html>