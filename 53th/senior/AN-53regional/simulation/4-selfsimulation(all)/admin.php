<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewp or t" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="head">
            <div class="title">咖啡商品展示系統-會員管理</div>
            <div class="hbut">
                <form action="">
                    <input type="button" class="headbut" onclick="location.href='edit.php'" value="新增使用者">
                    <input type="button" class="headbut" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="headbut" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="headbut" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="headbut selt" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="headbut" name="logout" value="登出">
                </form><br>
                <form action="">
                    <input type="text" name="search" placeholder="查詢">
                    <input type="submit" name="submit" value="送出">
                </form>
            </div>
        </div>
        <form action="">
            <div class="top">
                <table>
                    <tr>
                        <td class="admintd">編號<input type="submit" name="numberupdown" value="升冪" id="number"></td>
                        <td class="admintd">帳號<input type="submit" name="usernameupdown" value="升冪" id="username"></td>
                        <td class="admintd">密碼<input type="submit" name="codeupdown" value="升冪" id="code"></td>
                        <td class="admintd">姓名<input type="submit" name="nameupdown" value="升冪" id="name"></td>
                        <td class="admintd">權限</td>
                        <td class="admintd">動作</td>
                        <td class="admintd">時間</td>
                    </tr>
                    <?php
                        if(isset($_GET["submit"])){
                            @$type=$_GET["search"];
                            updown(fetchall(query($db,"SELECT*FROM `data` WHERE `number`LIKE'%$type%' or `username`LIKE'%$type%' or `password`LIKE'%$type%' or `name`LIKE'%$type%' or `permission`LIKE'%$type%' or `move`LIKE'%$type%' or `movetime`LIKE'%$type%'")));
                        }else{
                            updown(fetchall(query($db,"SELECT*FROM `data`")));
                        }
                    ?>
                </table>
            </div>
        </form>
        <form action="">
            <div class="bottom">
                <table>
                    <tr>
                        <td class="admintd">編號</td>
                        <td class="admintd">帳號</td>
                        <td class="admintd">密碼</td>
                        <td class="admintd">姓名</td>
                        <td class="admintd">權限</td>
                    </tr>
                    <?php
                        $a=fetchall(query($db,"SELECT*FROM `user`"));
                        for($i=0;$i<count($a);$i++){
                            if($a[$i][1]=="0000"){
                                ?>
                                <tr>
                                    <td class="admintd"><?= $a[$i][1] ?>
                                        <input type="button" onclick="location.href='edit.php?edit=<?= $a[$i][1] ?>'" value="修改" disabled>
                                        <input type="submit" name="del" value="刪除" disabled>
                                    </td>
                                    <td class="admintd"><?= $a[$i][2] ?></td>
                                    <td class="admintd"><?= $a[$i][3] ?></td>
                                    <td class="admintd"><?= $a[$i][4] ?></td>
                                    <td class="admintd"><?= $a[$i][5] ?></td>
                                </tr>
                                <?php
                            }else{
                                ?>
                                <tr>
                                    <td class="admintd"><?= $a[$i][1] ?>
                                        <input type="button" onclick="location.href='edit.php?edit=<?= $a[$i][1] ?>'" value="修改">
                                        <input type="button" onclick="location.href='admin.php?del=<?= $a[$i][1] ?>'" value="刪除">
                                    </td>
                                    <td class="admintd"><?= $a[$i][2] ?></td>
                                    <td class="admintd"><?= $a[$i][3] ?></td>
                                    <td class="admintd"><?= $a[$i][4] ?></td>
                                    <td class="admintd"><?= $a[$i][5] ?></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
            </div>
        </form>
        <form action="">
            <div class="timer">
                <table class="timetable">
                    <tr>
                        <td class="timertd" rowspan="2">
                            <input type="text" name="" class="timeinputmain" value="<?= $_SESSION["timer"] ?>" id="timer" readonly>
                        </td>
                        <td class="timertd">
                            <input type="text" name="time" class="timeinput" value="<?= $_SESSION["timer"] ?>" id="">
                        </td>
                    </tr>
                    <tr>
                        <td class="timertd">
                            <input type="submit" name="timerreload" value="重新產生">
                        </td>
                    </tr>
                </table>
        </div>
        </form>
        <div class="ask main" id="lightbox">
            是否繼續操作?<br>
            <input type="button" onclick="location.reload()" value="Yes">
            <input type="button" onclick="location.href='link.php?logout='" value="否">
        </div>
        <?php
        if(isset($_GET["del"])){
            $data=$_GET["del"];
            query($db,"DELETE FROM `user` WHERE `number`='$data'");
            ?><script>alert("刪除成功");location.href="admin.php"</script><?php
        }
        if(isset($_GET["timerreload"])){
            $_SESSION["timer"]=$_GET["time"];
            ?><script>alert("更改成功");location.href="admin.php"</script><?php
        }
    ?>
    <script src="timer.js"></script>
</body>
</html>