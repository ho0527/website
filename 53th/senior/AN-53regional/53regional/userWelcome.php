<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>一般會員專區</title>
        <link href="index.css" rel="stylesheet">
    </head>
    <body>
        <div class="navigationbar">
            <form class="navigationbardiv">
                咖啡商品展示系統
                <input type="button" class="adminbutton selectbut" onclick="location.href='userWelcome.php'" value="首頁">
                <input type="button" class="adminbutton" value="上架商品">
                <input type="button" class="adminbutton" onclick="location.href='usersearch.php'" name="enter" value="查詢">
                <input type="submit" class="adminbutton" name="logout" value="登出">
            </form>
        </div>
        <table class="maintable">
            <?php
                include("link.php");
                include("def.php");
                product(query($db,"SELECT*FROM `coffee`"),1);
            ?>
        </table>
        <?php
        ?>
    </body>
</html>