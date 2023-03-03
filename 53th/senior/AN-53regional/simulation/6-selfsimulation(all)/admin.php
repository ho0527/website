<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>網站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <div class="head">
        <div class="title">咖啡商品展示系統-會員管理</div>
        <div class="but">
            <input type="button" class="hbut" onclick="location.href='edit.php'" value="新增使用者">
            <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="hbut" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="hbut" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="hbut selt" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
        </div>
    </div>
    <div class="top">
        <table class="admintable">
            <tr>
                <td class="admintd">使用者編號</td>
                <td class="admintd">使用者帳號</td>
                <td class="admintd">使用者密碼</td>
                <td class="admintd">使用者姓名</td>
                <td class="admintd">權限</td>
                <td class="admintd">動作</td>
                <td class="admintd">時間</td>
            </tr>
            <?php
                $a=fetchall(query($db,"SELECT*FROM `data`"));
                for($i=0;$i<count($a);$i++){
                    ?>
                    <tr>
                        <td class="admintd"><?= $a[$i][1] ?></td>
                        <td class="admintd"><?= $a[$i][2] ?></td>
                        <td class="admintd"><?= $a[$i][3] ?></td>
                        <td class="admintd"><?= $a[$i][4] ?></td>
                        <td class="admintd"><?= $a[$i][5] ?></td>
                        <td class="admintd"><?= $a[$i][6] ?></td>
                        <td class="admintd"><?= $a[$i][7] ?></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
    <div class="search">
        <form>
            <input type="text" name="search" placeholder="查詢">
            <input type="submit" name="searchsubmit" value="送出">
        </form>
    </div>
    <div class="bottom">
        <table class="admintable">
            <form>
                <tr>
                    <td class="admintd">使用者編號<input type="submit" name="updownnumber" value="升冪" id="updownnumber"></td>
                    <td class="admintd">使用者帳號<input type="submit" name="updownuname" value="升冪" id="updownuname"></td>
                    <td class="admintd">使用者密碼<input type="submit" name="updowncode" value="升冪" id="updowncode" ></td>
                    <td class="admintd">使用者姓名<input type="submit" name="updownname" value="升冪" id="updownname" ></td>
                    <td class="admintd">權限</td>
                </tr>
            </form>
            <?php
                if(isset($_GET["searchsubmit"])){
                    $type=$_GET["search"];
                    updown(fetchall(query($db,"SELECT*FROM `user` WHERE `number`LIKE'%$type%'or`username`LIKE'%$type%'or`code`LIKE'%$type%'or`name`LIKE'%$type%'or`permission`LIKE'%$type%'")));
                }else{
                    updown(fetchall(query($db,"SELECT*FROM `user`")));
                }
            ?>
        </table>
    </div>
    <div class="timer">
        <form>
            <table class="timertable">
                <tr>
                    <td class="timertd" rowspan="2">
                        <input type="text" name="" class="timershow" id="timer" value="<?= $_SESSION["timer"] ?>">
                    </td>
                    <td class="timertd">
                        <input type="text" name="time" class="timerinput" value="<?= $_SESSION["timer"] ?>">
                    </td>
                </tr>
                <tr>
                    <td class="timertd"><input type="submit" name="reftimer" value="重新計時"></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="lightbox main" id="lightbox">
        是否繼續操作?<br>
        <input type="button" onclick="location.reload()" value="Yes">
        <input type="button" onclick="location.href='link.php?logout='" value="否">
    </div>
    <?php
        if(isset($_GET["del"])){
            $number=$_GET["del"];
            query($db,"DELETE FROM `user` WHERE `number`='$number'");
            ?><script>alert("刪除成功");location.href="admin.php"</script><?php
        }
        if(isset($_GET["reftimer"])){
            $_SESSION["timer"]=$_GET["time"];
            ?><script>alert("更改成功");location.href="admin.php"</script><?php
        }
    ?>
    <script src="timer.js"></script>
</body>
</html>