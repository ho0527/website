<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>登入錯誤</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){ header("location:verify.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbartitle center">咖啡商品展示系統</div>
        </div>
        <div class="main">
            <h2>登入失敗</h2>
            <h3>登入連續誤錯3次</h3>
            <input type="button" class="button" onclick="location.href='index.php'" value="返回登入介面">
        </div>
    </body>
</html>