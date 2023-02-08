<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="admintitle">手機問卷管理系統</div><br>
        <form class="div">
            <span class="big3x">
                <input type="button" value="編輯問卷" class="button" id="editform">
            </span>
            <span class="big3x">
                <input type="button" value="新增問卷" class="button" id="newform">
            </span>
            <span class="big3x">
                <input type="submit" value="登出" class="button" name="logout">
            </span>
        </form>
        <div class="div">
            <div id="check" class="checkdiv">
                <form>
                    問卷名稱: <input type="text" placeholder="問卷名稱" name="title"><br>
                    問卷題數: <input type="text" placeholder="問卷題數" name="num"><br>
                    <input type="submit" value="取消" name="clear">
                    <input type="submit" value="確定" name="submit">
                </form>
            </div>
        </div>
        <div class="div">
            <div id="edit" class="checkdiv" style="height:50px">
                <form>
                    問卷名稱: <input type="text" placeholder="問卷名稱" name="edittitle"><br>
                    <input type="submit" value="取消" name="clear">
                    <input type="submit" value="確定" name="enter">
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
            if(isset($_GET["logout"])){
                session_unset();
                ?><script>alert("登出成功");location.href="index.php"</script><?php
            }
        ?>
        <script src="admin.js"></script>
    </body>
</html>