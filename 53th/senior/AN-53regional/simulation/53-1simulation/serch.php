<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>望站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <form>
        <?php
            include("link.php");
            if($_SESSION["permission"]=="管理者"){
                ?>
                <div class="nbar">
                    <div class="title">咖啡商品管理系統-查詢</div>
                    <div class="divbut">
                        <input type="button" class="hbutton" onclick="location.href='edit.php'" value="新增使用者">
                        <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="hbutton selt" onclick="location.href='serch.php'" value="查詢">
                        <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="hbutton" name="logout" value="登出">
                    </div>
                </div>
                <?php
            }else{
                ?>
                <div class="nbar">
                    <div class="title">咖啡商品管理系統-查詢</div>
                    <div class="divbut">
                        <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="hbutton" value="上架商品">
                        <input type="button" class="hbutton selt" onclick="location.href='serch.php'" value="查詢">
                        <input type="submit" class="hbutton" name="logout" value="登出">
                    </div>
                </div>
                <?php
            }
        ?>
    </form>
</body>
</html>