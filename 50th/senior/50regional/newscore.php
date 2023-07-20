<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>管理者專區</title>
        <link href="index.css" rel="stylesheet">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <script src="plugin/js/macossection.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
            if(!isset($_GET["id"])){ header("location:project.php"); }
            if(!isset($_GET["opinionid"])){ header("location:project.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">專案討論系統</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='neweditproject.php?id=<?php echo($_GET['id']); ?>'" value="發表意見">
                <?php
                    if($_SESSION["data"]==1){ ?><input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理"><?php }
                ?>
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='project.php'" value="專案管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='teamleader.php'" value="組長功能管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='statistics.php'" value="統計管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
            </div>
        </div>
        <div class="main macossectiondiv">
            <form method="POST">
                分數: <input type="text" class="input" name="score" value="3"><br><br>
                <input type="submit" class="button" name="submit" value="送出">
                <input type="hidden" name="opinionid" value="<?php echo($_GET["opinionid"]); ?>">
                <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>">
            </form>
        </div>
        <?php
            if(isset($_POST["submit"])){
                $userdata=$_SESSION["data"];
                $score=$_POST["score"];
                $opinionid=$_POST["opinionid"];
                $id=$_POST["id"];
                if(1<=$score&&$score<=5){
                    query($db,"INSERT INTO `score`(`userid`,`opinionid`,`score`)VALUES(?,?,?)",[$userdata,$opinionid,$score]);
                    query($db,"INSERT INTO `log`(`username`,`move`,`movetime`,`ps`)VALUES(?,?,?,?)",[$userdata,"評分",$time,"opitionid=".$opinionid]);
                    ?><script>alert("新增成功");location.href="opinion.php?id=<?php echo($id); ?>"</script><?php
                }else{
                    ?><script>alert("分數不正確");location.href="newscore.php?id=<?php echo($id); ?>&opinionid=<?php echo($opinionid); ?>"</script><?php
                }
            }
        ?>
    </body>
</html>