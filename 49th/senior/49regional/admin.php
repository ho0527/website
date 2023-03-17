<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>咖啡商品展示系統</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
        ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="mainbutton selt" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="mainbutton logout" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <div class="timer mag">
            <form>
                <table class="table">
                    <tr>
                        <td class="td" rowspan="2"><input type="text" class="maintimer" id="timer" value="<?= @$_SESSION["timer"] ?>" readonly></td>
                        <td class="td"><input type="number" name="timer" value="<?= @$_SESSION["timer"] ?>"></td>
                    </tr>
                    <tr>
                        <td class="td"><input type="submit" name="ref" value="重新計時"></td>
                    </tr>
                </table>
            </form>
        </div><br>
        <div class="lightbox">
            <div class="lightboxbody">
                是否繼續操作?<br>
                <input type="button" class="mainbutton" onclick="location.reload()" value="Yes">
                <input type="button" class="mainbutton" onclick="location.href='link.php?logout='" value="否">
            </div>
        </div>
        <div class="adminmain mag">
            <h2>會員管理</h2>
            <input type="button" onclick="location.href='edit.php'" value="新增使用者">
            <form>
                <input type="text" name="search">
                <input type="submit" name="searchs" value="查尋">
            </form><br><br>
            <form>
                <table class="admintable">
                    <tr>
                        <td class="admintd">編號<input type="submit" name="udnb" id="udnb" value="升冪"></td>
                        <td class="admintd">帳號<input type="submit" name="udun" id="udun" value="升冪"></td>
                        <td class="admintd">密碼</td>
                        <td class="admintd">姓名<input type="submit" name="udn" id="udn" value="升冪"></td>
                        <td class="admintd">權限</td>
                        <td class="admintd">操作</td>
                    </tr>
                    <?php
                        if(isset($_SESSION["search"])){
                            $type=$_SESSION["search"];
                            updown(fetchall(query($db,"SELECT*FROM `user` WHERE `username`LIKE'%$type%'or`code`LIKE'%$type%'or`name`LIKE'%$type%'or`number`LIKE'%$type%'or`permission`LIKE'%$type%'")));
                        }else{
                            updown(fetchall(query($db,"SELECT*FROM `user`")));
                        }
                    ?>
                </table>
            </form>
        </div><br>
        <div class="adminmain mag">
            <h2>登入登出紀錄</h2><br>
            <table class="admintable">
                <tr>
                    <td class="admintd">使用者編號</td>
                    <td class="admintd">時間</td>
                    <td class="admintd">動作</td>
                </tr>
                <?php
                $row=fetchall(query($db,"SELECT*FROM `data`"));
                for($i=0;$i<count($row);$i++){
                    ?>
                    <tr>
                        <td class="admintd"><?= $row[$i][1] ?></td>
                        <td class="admintd"><?= $row[$i][2] ?></td>
                        <td class="admintd"><?= $row[$i][3] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
            if(isset($_GET["searchs"])){
                $_SESSION["search"]=$_GET["search"];
            }
            if(isset($_GET["ref"])){
                $timer=$_GET["timer"];
                if($timer<=0){
                    ?><script>alert("禁止輸入小於等於0的時間");location.href="admin.php"</script><?php
                }else{
                    $_SESSION["timer"]=$timer;
                }
            }
        ?>
        <script src="timer.js"></script>
    </body>
</html>