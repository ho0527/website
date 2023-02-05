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
            $id=fetch(query("SELECT*FROM `form` WHERE `title`='$title'"))[0];
        ?>
        <div class="div">
            <div class="formtitle">編輯問卷</div><br>
        </div>
        <div class="div">
            <form class="mainform">
                id <input type="text" class="formtext" value="<?= $id ?>" name="title" style="width:50px">
                標題 <input type="text" class="formtext" value="<?= $title ?>" name="title">
                <input type="text" class="formtext" value="<?= $num ?>" style="width:25px" name="num">
                <input type="submit" value="新增" name="newqust">
                <input type="submit" value="減少" name="lestqust">
                <input type="submit" value="儲存" name="save">
                <input type="submit" value="取消" name="cancel">
                <input type="submit" value="登出" name="logout">
            </form>
        </div>
        <hr>
        <div class="formdiv">
            <?php
                for($i=0;$i<$num;$i=$i+1){
                    ?>
                    <div class="divform">
                            <form class="newform">
                                123
                            </form>
                        </div>
                    <?php
                }
                if(isset($_GET["newqust"])){
                    $_SESSION["num"]=$_SESSION["num"]+1;
                    header("location:form.php");
                }
                if(isset($_GET["lestqust"])){
                    $_SESSION["num"]=$_SESSION["num"]-1;
                    header("location:form.php");
                }
                if(isset($_GET["save"])){
                    $title=$_GET["title"];
                    $num=$_GET["num"];
                    query("UPDATE `form` SET `title`='$title',`num`='$num' WHERE `id`='$id'");
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
    </body>
</html>