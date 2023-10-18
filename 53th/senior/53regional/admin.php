<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>管理者專區</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="../../../plugin/css/chrisplugin.css">
        <script src="../../../plugin/js/chrisplugin.js"></script>
    </head>
    <body>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <div class="navigationbartitle">咖啡商品展示系統-會員管理</div>
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='main.html'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='productindex.html'" value="上架商品">
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="navigationbarbutton" id="logout" value="登出">
            </div>
        </div>
        <div class="adminmain main">
            <h2>
                會員管理
                <input type="button" class="button" id="newuser" value="新增使用者">
            </h2>
            <div>
                <input type="text" id="search">
                <input type="button" id="searchsubmit" value="查詢">
            </div>
            <form>
                <div class="admintable macossectiondiv">
                    <table id="usertable">
                        <tr>
                            <?php
                                if(isset($_GET["orderby"])){
                                    $ordertype=$_GET["ordertype"];
                                    $word="降冪";
                                    if($ordertype=="ASC"){
                                        $word="升冪";
                                    }
                                    if($_GET["orderby"]=="number"){
                                        ?>
                                        <td class="admintd">編號 <input type="button" onclick="location.href='?orderby=number&ordertype=<?= $ordertype ?>'" value="<?= $word ?>"></td>
                                        <td class="admintd">帳號 <input type="button" onclick="location.href='?orderby=username&ordertype=DESC'" value="升冪"></td>
                                        <td class="admintd">密碼</td>
                                        <td class="admintd">姓名 <input type="button" onclick="location.href='?orderby=name&ordertype=DESC'" value="升冪"></td>
                                        <td class="admintd">權限</td>
                                        <td class="admintd">功能</td>
                                        <?php
                                    }elseif($_GET["orderby"]=="username"){
                                        ?>
                                        <td class="admintd">編號 <input type="button" onclick="location.href='?orderby=number&ordertype=DESC'" value="升冪"></td>
                                        <td class="admintd">帳號 <input type="button" onclick="location.href='?orderby=number&ordertype=<?= $ordertype ?>'" value="<?= $word ?>"></td>
                                        <td class="admintd">密碼</td>
                                        <td class="admintd">姓名 <input type="button" onclick="location.href='?orderby=name&ordertype=DESC'" value="升冪"></td>
                                        <td class="admintd">權限</td>
                                        <td class="admintd">功能</td>
                                        <?php
                                    }elseif($_GET["orderby"]=="name"){
                                        ?>
                                        <td class="admintd">編號 <input type="button" onclick="location.href='?orderby=number&ordertype=DESC'" value="升冪"></td>
                                        <td class="admintd">帳號 <input type="button" onclick="location.href='?orderby=username&ordertype=DESC'" value="升冪"></td>
                                        <td class="admintd">密碼</td>
                                        <td class="admintd">姓名 <input type="button" onclick="location.href='?orderby=name&ordertype=<?= $ordertype ?>'" value="<?= $word ?>"></td>
                                        <td class="admintd">權限</td>
                                        <td class="admintd">功能</td>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <td class="admintd">編號 <input type="button" onclick="location.href='?orderby=number&ordertype=DESC'" value="升冪"></td>
                                    <td class="admintd">帳號 <input type="button" onclick="location.href='?orderby=username&ordertype=DESC'" value="升冪"></td>
                                    <td class="admintd">密碼</td>
                                    <td class="admintd">姓名 <input type="button" onclick="location.href='?orderby=name&ordertype=DESC'" value="升冪"></td>
                                    <td class="admintd">權限</td>
                                    <td class="admintd">功能</td>
                                    <?php
                                }
                            ?>
                        </tr>
                    </table>
                </div>
            </form><br><br>
            <h2>登入登出紀錄</h2>
            <div class="admintable macossectiondiv">
                <table id="logtable">
                    <tr>
                        <td class="admintd">使用者編號</td>
                        <td class="admintd">使用者帳號</td>
                        <td class="admintd">使用者姓名</td>
                        <td class="admintd">動作(登入/登出)</td>
                        <td class="admintd">成功/失敗</td>
                        <td class="admintd">時間</td>
                    </tr>
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
                    <input type="text" id="changetimer" class="timersec" id="changetimer">
                    <input type="submit" id="changetimersubmit" value="送出">
                </form>
                </td>
            </tr>
            <tr>
                <td class="timertd">
                <button class="timeerbutton" id="resetbutton">重新計時</button>
                </td>
            </tr>
        </table>
        <div id="lightbox"></div>
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
        <script src="logincheck.js"></script>
    </body>
</html>