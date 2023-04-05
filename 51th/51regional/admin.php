<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="navigationbar">
            <div class="navigationbartitle">手機問卷管理系統</div>
            <div class="navigationbarbuttondiv">
                <input type="button" class="navigationbarbutton" id="editform" value="編輯問卷">
                <input type="button" class="navigationbarbutton" id="newform" value="新增問卷">
                <input type="submit" class="navigationbarbutton" onclick="location.href='link.php?logout='" value="登出">
            </div>
        </div>
        <div id="check">
            <div class="mask"></div>
            <div class="main">
                <form>
                    問卷名稱: <input type="text" class="input" name="title" placeholder="問卷名稱"><br><br>
                    問卷題數: <input type="text" class="input" name="num" placeholder="問卷題數"><br><br>
                    <input type="submit" class="button" name="clear" value="取消">
                    <input type="submit" class="button" name="submit" value="確定">
                </form>
            </div>
        </div>
        <div id="edit">
            <div class="mask"></div>
            <div class="main">
                <form>
                    問卷名稱: <input type="text" class="input" name="edittitle" placeholder="問卷名稱"><br>
                    <input type="submit" class="button" name="clear" value="取消">
                    <input type="submit" class="button" name="enter" value="確定">
                </form>
            </div>
        </div>
        <?php
            include("link.php");
            if(isset($_GET["submit"])){
                $title=$_GET["title"];
                $num=$_GET["num"];
                $row=fetch(query($db,"SELECT*FROM `form` WHERE `title`='$title'"));
                if($title==""){
                    ?><script>alert("請輸入問卷標題");location.href="admin.php"</script><?php
                }elseif($row){
                    ?><script>alert("問卷已存在");location.href="admin.php"</script><?php
                }elseif(preg_match("/^[0-9]+$/",$num)){
                    query($db,"INSERT INTO `form`(`title`, `num`) VALUES ('$title','$num')");
                    $_SESSION["title"]=$title;
                    $_SESSION["num"]=$num;
                    ?><script>alert("登入成功");location.href="form.php"</script><?php
                }else{
                    ?><script>alert("問卷題數請輸入數字");location.href="admin.php"</script><?php
                }
            }
            if(isset($_GET["enter"])){
                $title=$_GET["edittitle"];
                $row=fetch(query($db,"SELECT*FROM `form` WHERE `title`='$title'"));
                if($title==""){
                    ?><script>alert("請輸入問卷標題");location.href="admin.php"</script><?php
                }elseif($row){
                    $_SESSION["title"]=$title;
                    $_SESSION["num"]=$row[2];
                    ?><script>alert("登入成功");location.href="form.php"</script><?php
                }else{
                    ?><script>alert("查無此問卷");location.href="admin.php"</script><?php
                }
            }
            if(isset($_GET["clear"])){
                session_unset();
                header("location:admin.php");
            }
        ?>
        <script src="admin.js"></script>
    </body>
</html>