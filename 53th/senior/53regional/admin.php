<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>管理者專區</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <script src="plugin/js/macossection.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
            include("admindef.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">咖啡商品展示系統-會員管理</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='signupedit.php'" value="新增使用者">
                <input type="button" class="navigationbarbutton" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查詢">
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
            </div>
        </div>
        <div class="adminmain">
            <h2>會員管理</h2>
            <form>
                <input type="text" name="search">
                <input type="submit" name="searchsubmit" value="查尋">
            </form>
            <form>
                <div class="admintable macossectiondiv">
                    <table>
                        <tr>
                            <td class="admintd">編號<input type="submit" name="number" id="number" value="升冪"></td>
                            <td class="admintd">帳號<input type="submit" name="username" id="username" value="升冪"></td>
                            <td class="admintd">密碼</td>
                            <td class="admintd">姓名<input type="submit" name="name" id="name" value="升冪"></td>
                            <td class="admintd">權限</td>
                        </tr>
                        <?php
                            if(isset($_SESSION["search"])){
                                $type=$_SESSION["search"];
                                updown(query($db,"SELECT*FROM `user` WHERE `username`LIKE'%$type%'or`name`LIKE'%$type%'or`number`LIKE'%$type%'or`password`LIKE'%$type%'or`permission`LIKE'%$type%'"));
                            }else{
                                updown(query($db,"SELECT*FROM `user`"));
                            }
                        ?>
                    </table>
                </div>
            </form><br><br>
            <h2>登入登出紀錄</h2>
            <div class="admintable macossectiondiv">
                <table>
                    <tr>
                        <td class="admintd">使用者編號</td>
                        <td class="admintd">使用者帳號</td>
                        <td class="admintd">使用者姓名</td>
                        <td class="admintd">動作(登入/登出)</td>
                        <td class="admintd">成功/失敗</td>
                        <td class="admintd">時間</td>
                    </tr>
                    <?php
                        $row=query($db,"SELECT*FROM `data`");
                        for($i=0;$i<count($row);$i++){
                            ?>
                            <tr>
                                <td class="admintd"><?= $row[$i][1] ?></td>
                                <td class="admintd"><?= $row[$i][2] ?></td>
                                <td class="admintd"><?= $row[$i][4] ?></td>
                                <td class="admintd"><?= $row[$i][6] ?></td>
                                <td class="admintd"><?= $row[$i][7] ?></td>
                                <td class="admintd"><?= $row[$i][8] ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
        <table class="timer">
            <tr>
                <td class="timertd" rowspan="2">
                <input type="text" class="timerbox" id="timer" value="<?= @$_SESSION["timer"] ?>" readonly>
                </td>
                <td class="timertd">
                <form>
                    <input type="text" id="changetimer" class="timersec" name="changetimer" value="<?= @$_SESSION["timer"] ?>" placeholder="秒">
                    <input type="submit" name="changetimersubmit" value="送出">
                </form>
                </td>
            </tr>
            <tr>
                <td class="timertd">
                <button class="timeerbutton" id="resetbutton">重新計時</button>
                </td>
            </tr>
        </table>
        <div class="lightboxdiv" id="ask">
            <div class="mask"></div>
            <div class="body">
                是否繼續操作?<br>
                <input type="button" class="button" id="yes" value="Yes">
                <input type="button" class="button" id="no" value="否">
            </div>
        </div>
        <?php
            if(isset($_GET["searchsubmit"])){
                $_SESSION["search"]=$_GET["search"];
                ?><script>location.href="admin.php"</script><?php
            }

            if(isset($_GET["changetimersubmit"])){
                $_SESSION["timer"]=$_GET["changetimer"];
                ?><script>location.href="admin.php"</script><?php
            }
        ?>
        <script src="admin.js"></script>
    </body>
</html>