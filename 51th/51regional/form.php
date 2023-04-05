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
        <form>
            id: <input type="text" class="" name="id" value="<?= $id ?>" style="width:50px" readonly>
            標題: <input type="text" class="" name="title" value="<?= $title ?>" style="width:120px">
            總數: <input type="text" class="" name="num" value="<?= $num ?>" style="width:35px">
            <input type="submit" class="button" name="newqust" value="新增">
            <input type="submit" class="button" name="lestqust" value="減少">
            <input type="submit" class="button" name="save" value="儲存">
            <input type="submit" class="button" name="cancel" value="取消">
            <input type="submit" class="button" name="logout" value="登出">
            <div class="">
                <?php
                    for($i=0;$i<$num;$i=$i+1){
                        ?>
                        <div class="divform">
                            <div class="newform">
                                未設定<input type="radio" class="radio none" id="none <?= $i ?>" name="select<?= $i ?>" checked>
                                是非題<input type="radio" class="radio yesno" id="yesno <?= $i ?>" name="select<?= $i ?>">
                                單選題<input type="radio" class="radio single" id="single <?= $i ?>" name="select<?= $i ?>">
                                多選題<input type="radio" class="radio multi" id="multi <?= $i ?>" name="select<?= $i ?>">
                                問答題<input type="radio" class="radio question" id="question <?= $i ?>" name="select<?= $i ?>">
                            </div>
                            <div class="output" id="output<?= $i ?>"></div>
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
                ?>
            </div>
        </form>
        <script src="form.js"></script>
    </body>
</html>