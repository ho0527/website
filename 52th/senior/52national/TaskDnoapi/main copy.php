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
                $row=query($db,"SELECT*fROM `user` WHERE `id`='$data'")[0];
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft" id="user">
                        <img src="<?= $row[1] ?>" class="slefimage">
                        <div class="nickname"><?php echo($row[3]) ?></div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton" onclick="location.href='link.php?logout='" value="登出">
                    </div>
                </div>
                <div class="mainmain">
                    <input type="button" class="button" id="newpost" value="新增貼文">
                </div>
                <?php
            }else{
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft" id="user">
                        <div class="nickname">未登入</div>
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