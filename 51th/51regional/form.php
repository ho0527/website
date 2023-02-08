<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>編輯問卷</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            $title=$_SESSION["title"];
            $num=$_SESSION["num"];
            $id=fetch(query($db,"SELECT*FROM `form` WHERE `title`='$title'"))[0];
        ?>
        <div class="div">
            <div class="formtitle">編輯問卷</div><br>
        </div>
        <form class="mainform">
            <div class="formhead">
                <div class="verticalcenter">
                    id: <input type="text" class="formtext" value="<?= $id ?>" name="title" style="width:50px" readonly>
                    標題: <input type="text" class="formtext" value="<?= $title ?>" name="title" style="width:120px">
                    總數: <input type="text" class="formtext" value="<?= $num ?>" style="width:35px" name="num">
                    <input type="submit" value="新增" name="newqust" class="button">
                    <input type="submit" value="減少" name="lestqust" class="button">
                    <input type="submit" value="儲存" name="save" class="button">
                    <input type="submit" value="取消" name="cancel" class="button">
                    <input type="submit" value="登出" name="logout" class="button">
                <div>
            </div>
            <div class="formdiv">
                <?php
                    for($i=0;$i<$num;$i=$i+1){
                        ?>
                        <div class="divform">
                            <div class="newform">
                                未設定<input type="radio" name="select<?= $i ?>" class="radio none" id="none <?= $i ?>" checked>
                                是非題<input type="radio" name="select<?= $i ?>" class="radio yesno" id="yesno <?= $i ?>">
                                單選題<input type="radio" name="select<?= $i ?>" class="radio single" id="single <?= $i ?>">
                                多選題<input type="radio" name="select<?= $i ?>" class="radio multi" id="multi <?= $i ?>">
                                問答題<input type="radio" name="select<?= $i ?>" class="radio question" id="question <?= $i ?>">
                            </div>
                            <div class="output" id="output"></div>
                        </div>
                        <?php
                    }
                    if(isset($_GET["newqust"])){
                        $_SESSION["num"]=$_SESSION["num"]+1;
                        ?><script>location.href="form.php"</script><?php
                    }
                    if(isset($_GET["lestqust"])){
                        $_SESSION["num"]=$_SESSION["num"]-1;
                        ?><script>location.href="form.php"</script><?php
                    }
                    if(isset($_GET["save"])){
                        $title=$_GET["title"];
                        $num=$_GET["num"];
                        query($db,"UPDATE `form` SET `title`='$title',`num`='$num' WHERE `id`='$id'");
                        ?><script>alert("儲存成功");location.href="form.php"</script><?php
                    }
                    if(isset($_GET["cancel"])){
                        session_unset();
                        ?><script>alert("取消成功");location.href="admin.php"</script><?php
                    }
                    if(isset($_GET["logout"])){
                        session_unset();
                        ?><script>alert("登出成功");location.href="index.php"</script><?php
                    }
                ?>
            </div>
        </form>
        <script src="form.js"></script>
    </body>
</html>