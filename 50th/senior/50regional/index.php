<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>網站前台登入介面</title>
        <link href="index.css" rel="stylesheet">
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){ header("location:main.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbartitle center">專案討論系統</div>
        </div>
        <div class="main">
            <form method="POST" action="login.php">
                帳號: <input type="text" class="input" name="username"><br><br>
                密碼: <input type="text" class="input" name="password"><br><br>
                <input type="reset" class="button" value="清除">
                <input type="submit" class="button" name="submit" value="登入">
            </form>
        </div>
    </body>
</html>