<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Shanghai Battle!</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <img src="logo.png" class="logo">
        <div class="head">
            <form>
                <input type="button" id="index" value="玩家留言" class="indexbutton" onclick="location.href='index.php'">
                <input type="button" id="view" value="玩家參賽" class="indexbutton selectbut" onclick="location.href='post.php'">
                <input type="button" id="signup" value="網站管理" class="indexbutton" onclick="location.href='login.php'">
                <input type="submit" id="loggout-button" class="indexbutton" name="logout" value="登出">
            </form>
        </div>
        <div class="post">
            <div class="newpostdiv">
                <div class="signupdiv">
                    <form>
                        <div class="posttitle">玩家參賽畫面</div>
                        姓&nbsp&nbsp名: <input type="text" class="indexinput" name="username" value="<?= @$_SESSION["name"] ?>"><br>
                        email: <input type="text" class="indexinput" name="email" placeholder="要有@及一個以上的." value="<?= @$_SESSION["email"] ?>"><br>
                        電&nbsp&nbsp話: <input type="text" class="indexinput" name="tel" placeholder="只能包含數字或-" value="<?= @$_SESSION["tel"] ?>"><br>
                        <input type="file" name="picture" accept="image/*" style="width:70px">64KB以下<br>
                        <input type="button" onclick="location.href='post.php'" class="button" value="重設">
                        <input type="submit" name="submit" class="button" value="參賽"><br>
                    </form>
                </div>
            </div>
        </div>
        <?php
            include("link.php");
            if(isset($_GET["submit"])){
                @$username=$_GET["username"];
                @$email=$_GET["email"];
                @$tel=$_GET["tel"];
                @$picture=$_FILES["picture"]["picture"];
                @$_SESSION["name"]=$username;
                @$_SESSION["email"]=$email;
                @$_SESSION["tel"]=$tel;
                if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) {
                    ?><script>alert("email驗證失敗!");location.href="post.php"</script><?php
                }elseif(!preg_match("/^[0-9-]+$/",$tel)){
                    ?><script>alert("電話驗證失敗!");location.href="post.php"</script><?php
                }elseif($username==""){
                    ?><script>alert("請輸入名字!");location.href="post.php"</script><?php
                }else{
                    if(isset($picture)){
                        // 轉換圖片為二進位資料
                        @$image=base64_encode(file_get_contents($picture));
                        query("INSERT INTO `comp`(`username`, `email`,`tel`, `picture`,`ingame`) VALUES ('$username','$email','$tel','$image','no')");
                        ?><script>alert("新增成功!");location.href="post.php"</script><?php
                        @$_SESSION["name"]="";
                        @$_SESSION["email"]="";
                        @$_SESSION["tel"]="";
                        @$_SESSION["message"]="";
                        @$_SESSION["sn"]="";
                    }else{
                        query("INSERT INTO `comp`(`username`, `email`,`tel`, `ingame`) VALUES ('$username','$email','$tel','no')");
                        ?><script>alert("新增成功!");location.href="post.php"</script><?php
                        @$_SESSION["name"]="";
                        @$_SESSION["email"]="";
                        @$_SESSION["tel"]="";
                        @$_SESSION["message"]="";
                        @$_SESSION["sn"]="";
                    }
                }
            }
            if(isset($_GET["logout"])){
                if(isset($_SESSION["data"])){
                    ?><script>alert("登出成功!");location.href="login.php"</script><?php
                    session_unset();
                }else{
                    ?><script>alert("請先登入!");location.href="login.php"</script><?php
                    session_unset();
                }
            }
        ?>
        <script src="index.js"></script>
    </body>
</html>