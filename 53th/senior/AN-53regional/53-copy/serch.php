<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>網站前台登入頁面</title>
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
        <div class="search1">
            <div class="searchdiv">
                <form>
                    數字範圍:
                    <input type="text" name="start">~<input type="text" name="end">
                    <input type="submit" name="num" value="送出">
                </form>
            </div>
            <div class="searchdiv">
                <form>
                    關鍵字:
                    <input type="text" name="tex">
                    <input type="submit" name="text" value="送出">
                </form>
            </div>
        </div>
        <table class="maintable">
            <?php
                if(isset($_GET["num"])){
                    $start=$_GET["start"];
                    $end=$_GET["end"];
                    product(fetchall(query($db,"SELECT*FROM `coffee` WHERE '$start'<=`cost` AND `cost`<='$end'")),1,$db);
                }elseif(isset($_GET["text"])){
                    $text=$_GET["tex"];
                    product(fetchall(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$text%' or `intr`LIKE'%$text%' or `cost`LIKE'%$text%' or `date`LIKE'%$text%' or `link`LIKE'%$text%'")),1,$db);
                }else{
                    product(fetchall(query($db,"SELECT*FROM `coffee`")),1,$db);
                }
            ?>
        </table>
    </body>
</html>