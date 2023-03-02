<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>網站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <div class="headbut">
        <div class="title">咖啡商品管理系統-會員管理</div>
        <div class="but">
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
        <form action="">
            <input type="text" name="search" id="" placeholder="查詢"><br>
            <input type="submit" name="searchsubmit" value="送出">
        </form>
    </div>
    <div class="bottom">
        <form action="">
            <table class="admintable">
                <tr>
                    <td class="admintd">編號 <input type="submit" name="updownnumber" value="升冪" id="updownnumber"></td>
                    <td class="admintd">帳號 <input type="submit" name="updownusername" value="升冪" id="updownusername"></td>
                    <td class="admintd">密碼 <input type="submit" name="updowncode" value="升冪" id="updowncode"></td>
                    <td class="admintd">姓名 <input type="submit" name="updownname" value="升冪" id="updownname"></td>
                    <td class="admintd">權限</td>
                </tr>
                <?php
                if(isset($_GET["searchsubmit"])){
                    $search=$_GET["search"];
                    updown(fetchall(query($db,"SELECT*FROM `user` WHERE `number`LIKE'%$search%'or`username`LIKE'%$search%'or`password`LIKE'%$search%'or`name`LIKE'%$search%'or`permission`LIKE'%$search%'")));
                }else{
                    updown(fetchall(query($db,"SELECT*FROM `user`")));
                }
                ?>
            </table>
        </form>
    </div>
    <div class="timer">
        <form action="">
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
        if(isset($_GET["reftimer"])){
            $_SESSION["timer"]=$_GET["time"];
            ?><script>alert("更改成功");location.href="admin.php"</script><?php
        }
    ?>
    <script src="timer.js"></script>
</body>
</html>