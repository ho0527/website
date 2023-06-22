<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>網站前台登入介面</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">專案討論系統</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="使用者管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="專案管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="組長功能管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
            </div>
        </div>
    </body>
</html>