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
            if(isset($_SESSION["data"])){ header("location:check.php"); }
        ?>
        <div class="main">
            <form method="POST" enctype="multipart/form-data">
                <h2>新增使用者</h2>
                <hr>
                email <input type="text" class="input" name="email"><br><br>
                密碼 <input type="text" class="input" name="password"><br><br>
                暱稱 <input type="text" class="input" name="nickname"><br><br>
                管理員權限<input type="checkbox" class="checkbox" name="admin">
                <input type="button" class="button" name="password" onclick="document.getElementById('selfimage').click()" value="上傳頭像"><br><br>
                <input type="button" class="longbutton" onclick="location.href='index.php'" value="返回主頁">
                <input type="submit" class="longbutton" name="signupsubmit" value="送出">
                <input type="file" class="file" id="selfimage" name="selfimage" accept="image/*">
            </form>
        </div>
        <?php
            if(isset($_POST["signupsubmit"])){
                $username=$_POST["email"];
                $password=$_POST["password"];
                $nickname=$_POST["nickname"];
                if(!(block($username))&&!(block($password))){
                    $row=fetch(query($dbuser,"SELECT*FROM `user` WHERE `username`='$username'"));
                    if($username==""||$password==""){
                        ?><script>alert("請填寫帳密!");location.href="signupedit.php"</script><?php
                    }elseif($row){
                        ?><script>alert("帳號已存在");location.href="signupedit.php"</script><?php
                    }else{
                        $selfimage="";
                        if(isset($_FILES["selfimage"]["name"])){
                            $selfimage="image/selfimage/".$_FILES["selfimage"]["name"];
                            if(file_exists($file)){
                                $j=1;
                                while(file_exists($file)){
                                    $selfimage="image/selfimage/".$j."_".$_FILES["selfimage"]["name"];
                                    $j=$j+1;
                                }
                            }
                            move_uploaded_file($_FILES["image"]["tep_name"],$selfimage);
                        }
                        if(isset($_POST["admin"])){
                            query($dbuser,"INSERT INTO `user`(`selfimage`,`email`,`nickname`,`password`,`permission`)VALUES('$selfimage','$email','$nickname','$password','admin')");
                        }else{
                            query($dbuser,"INSERT INTO `user`(`selfimage`,`email`,`nickname`,`password`,`permission`)VALUES('$selfimage','$email','$nickname','$password','user')");
                        }
                        $row=fetch(query($dbuser,"SELECT*FROM `user` WHERE `username`='$username'"));
                        $number=str_pad($row[0]-1,8,"0",STR_PAD_LEFT);
                        query($dbuser,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                        ?><script>alert("新增成功!");location.href="index.php"</script><?php
                    }
                }else{
                    ?><script>alert("禁止輸入特殊字元!");location.href="signupedit.php"</script><?php
                }
            }
        ?>
    </body>
</html>