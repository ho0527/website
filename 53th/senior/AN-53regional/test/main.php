<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>咖啡商品展示系統</title>
        <link href="index.css" rel="stylesheet">
    </head>
    <body>
        <?php
            include("link.php");
            if($_SESSION["permission"]=="管理者"){
                ?>
                <div class="navigationbar">
                    <form class="navigationbardiv">
                        咖啡商品展示系統-&nbsp&nbsp首頁&nbsp&nbsp
                        <input type="button" class="adminbutton" onclick="location.href='signupedit.php'" value="新增">
                        <input type="button" class="adminbutton selectbut" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="adminbutton" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="adminbutton" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
                        <input type="submit" class="adminbutton" name="logout" value="登出">
                    </form>
                </div>
                <table class="maintable">
                    <?php
                    product(query($db,"SELECT*FROM `coffee`"),0,$db);
                    ?>
                </table>
                <?php
            }else{
                ?>
                <div class="navigationbar">
                    <form class="navigationbardiv">
                        咖啡商品展示系統-&nbsp&nbsp首頁&nbsp&nbsp
                        <input type="button" class="adminbutton" onclick="location.href='signupedit.php'" value="新增">
                        <input type="button" class="adminbutton selectbut" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="adminbutton" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="adminbutton" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
                        <input type="submit" class="adminbutton" name="logout" value="登出">
                    </form>
                </div>
                <table class="maintable">
                    <?php
                    product(query($db,"SELECT*FROM `coffee`"),1,$db);
                    ?>
                </table>
                <?php
            }
        ?>
    </body>
</html>