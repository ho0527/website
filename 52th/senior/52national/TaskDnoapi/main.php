<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TaskD</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){
                $data=$_SESSION["data"];
                $row=fetch(query($db,"SELECT*fROM `user` WHERE `id`='$data'"));
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft" id="user">
                        <img src="<?= $row[3] ?>" class="slefimage">
                        <div class="nickname">1223344</div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton" onclick="location.href='link.php?logout='" value="登出">
                    </div>
                </div>
                <?php
            }else{
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft" id="user">
                        <img src="defalut.png" class="slefimage">
                        <div class="nickname">1223344</div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="登入">
                    </div>
                </div>
                <?php
            }
        ?>
        <script src="main.js"></script>
    </body>
</html>