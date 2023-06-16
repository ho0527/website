<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:login.php"); }
            $data=$_SESSION["data"];
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="icon/logo.png" class="logo">
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="貨幣">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="進行">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
            </div>
        </div>
        <div class="loginmain">
            <form method="POST">
                名稱: <input type="text" class="input" name="name"><br><br>
                敘述: <input type="text" class="input" name="context"><br><br>
                <input type="reset" class="button" value="清除">
                <input type="submit" class="button" name="submit" value="登入">
            </form>
        </div>
        <?php
            if(isset($_POST["submit"])){
                $name=$_POST["name"];
                $context=$_POST["context"];
                if($name==""){
                    query($db,"INSERT INTO `log`(`username`,`move`,`movetime`)VALUES(?,'新增分類失敗','$time')",[$data]);
                    ?><script>alert("請輸入名稱");location.href="subject.php"</script><?php
                }else{
                    if(!query($db,"SELECT*FROM `subject` WHERE `name`=?",[$name])){
                        query($db,"INSERT INTO `subject`(`name`,`context`)VALUES(?,?)",[$name,$context]);
                        query($db,"INSERT INTO `log`(`username`,`move`,`movetime`)VALUES(?,'新增分類成功','$time')",[$data]);
                        ?><script>alert("新增成功");location.href="index.php"</script><?php
                    }else{
                        query($db,"INSERT INTO `log`(`name`,`move`,`movetime`)VALUES(?,'新增分類失敗','$time')",[$data]);
                        ?><script>alert("分類已存在");location.href="subject.php"</script><?php
                    }
                }
            }
        ?>
    </body>
</html>