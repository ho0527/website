<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>咖啡商品管理系統</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <div class="head">
        <div class="title">咖啡商品管理系統-會員管理</div>
        <div class="hbutdiv">
            <input type="button" class="hbut" onclick="location.href='edit.php'" value="新增使用者">
            <input type="button" class="hbut" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="hbut" onclick="location.href=''" value="上架商品">
            <input type="button" class="hbut" onclick="location.href=''" value="查詢">
            <input type="button" class="hbut selt" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="hbut" onclick="location.href='link.php?logout='" value="登出">
        </div>
    </div>
    <div class="top">
        <table class="admintable">
            <tr>
                <td class="admintd">編號</td>
                <td class="admintd">帳號</td>
                <td class="admintd">密碼</td>
                <td class="admintd">姓名</td>
                <td class="admintd">權限</td>
                <td class="admintd">動作</td>
                <td class="admintd">時間</td>
            </tr>
            <?php
                $row=fetchall(query($db,"SELECT*FROM `data`"));
                for($i=0;$i<count($row);$i++){
                    ?>
                    <tr>
                        <td class="admintd"><?= $row[$i][1] ?></td>
                        <td class="admintd"><?= $row[$i][2] ?></td>
                        <td class="admintd"><?= $row[$i][3] ?></td>
                        <td class="admintd"><?= $row[$i][4] ?></td>
                        <td class="admintd"><?= $row[$i][5] ?></td>
                        <td class="admintd"><?= $row[$i][6] ?></td>
                        <td class="admintd"><?= $row[$i][7] ?></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
    <div class="search">
        <form action="">
            <input type="text" name="search" placeholder="查詢">
            <input type="submit" name="searchsubmit" value="送出">
        </form>
    </div>
    <div class="bottom">
        <form action="">
            <table class="admintable">
                <tr>
                    <td class="admintd">編號<input type="submit" name="updownnumber" value="升冪" id="updownnumber"></td>
                    <td class="admintd">帳號<input type="submit" name="updownusername" value="升冪" id="updownusername"></td>
                    <td class="admintd">密碼<input type="submit" name="updowncode" value="升冪" id="updowncode"></td>
                    <td class="admintd">姓名<input type="submit" name="updownname" value="升冪" id="updownname"></td>
                    <td class="admintd">權限</td>
                </tr>
                <?php
                    if(isset($_GET["searchsubmit"])){
                        $type=$_GET["search"];
                        updown(fetchall(query($db,"SELECT*FROM `user` WHERE `username`LIKE'%$type%'or`code`LIKE'%$type%'or`name`LIKE'%$type%'or`number`LIKE'%$type%'or`permission`LIKE'%$type%'")));
                    }else{
                        updown(fetchall(query($db,"SELECT*FROM `user`")));
                    }
                ?>
            </table>
        </form>
    </div>
    <div class="timer">
        <form action="">
            <table>
                <tr>
                    <td rowspan="2" class="timetd">
                        <input type="text" class="timers" id="timer" value="<?= $_SESSION["timer"] ?>">
                    </td>
                    <td class="timetd">
                        <input type="text" name="time" id="timer" value="<?= $_SESSION["timer"] ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="ref" value="重新計時">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="lightbox" id="lightbox">
            <div class="main">
            是否繼續操作?<br>
            <input type="button" onclick="location.reload()" value="Yes">
            <input type="button" onclick="location.href='link.php?logout='" value="否">
        </div>
    </div>
    <?php
        if(isset($_GET["ref"])){
            $_SESSION["timer"]=$_GET["time"];
            ?><script>alert("更改成功");location.href="admin.php"</script><?php
        }
    ?>
    <script src="timer.js"></script>
</body>
</html>