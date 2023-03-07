<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品管理系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 75%;
            height: 350px;
            max-height: 350px;
            overflow-y: auto;
        }
        table{
            margin: 0px auto;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
    ?>
    <h1>咖啡商品管理系統</h1>
    <input type="button" class="mainbutton" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="mainbutton selt" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查詢">
    <input type="button" class="logout" onclick="location.href='link.php?logout='" value="登出">
    <hr><br><br>
    <div class="timer">
        <form action="">
            <table>
                <tr>
                    <td class="timetd" rowspan="2"><input type="text" name="timer" class="timerot" id="timer" value="<?= $_SESSION["timer"] ?>"></td>
                    <td class="timetd"><input type="text" name="timer" id="" value="<?= $_SESSION["timer"] ?>"></td>
                </tr>
                <tr>
                    <td class="timetd"><input type="submit" name="ref" value="重新計時"></td>
                </tr>
            </table>
        </form>
    </div><br>
    <div class="lightbox" id="lightbox">
        是否繼續操作?<br>
        <input type="button" onclick="location.reload()" value="Yes">
        <input type="button" onclick="location.href='link.php?logout='" value="否">
    </div>
    <div class="main mag">
        <h2>會員管理</h2>
        <input type="button" class="mainbutton" onclick="location.href='edit.php'" value="新增使用者">
        <form action="">
            <div style="float:right;">
                <input type="text" name="search" id="">
                <input type="submit" name="searchsubmit" value="查尋">
            </div>
        </form>
        <table>
            <form action="">
                <tr>
                    <td class="td">使用者編號<input type="submit" name="udnb" id="udnb" value="升冪"></td>
                    <td class="td">使用者帳號<input type="submit" name="udun" id="udun" value="升冪"></td>
                    <td class="td">使用者密碼</td>
                    <td class="td">使用者姓名<input type="submit" name="udn" id="udn" value="升冪"></td>
                    <td class="td">使用者權限</td>
                </tr>
                <?php
                    if(isset($_SESSION["search"])){
                        $type=$_SESSION["search"];
                        updown(fetchall(query($db,"SELECT*FROM `user` WHERE `username`LIKE'%$type%'or`code`LIKE'%$type%'or`number`LIKE'%$type%'or`name`LIKE'%$type%'or`permission`LIKE'%$type%'")));
                    }else{
                        updown(fetchall(query($db,"SELECT*FROM `user`")));
                    }
                ?>
            </form>
        </table>
    </div>
    <div class="main">
        <h2>登出登入紀錄</h2>
        <table>
            <tr>
                <td class="td">使用者編號</td>
                <td class="td">使用者帳號</td>
                <td class="td">使用者密碼</td>
                <td class="td">使用者姓名</td>
                <td class="td">使用者權限</td>
                <td class="td">動作</td>
                <td class="td">時間</td>
            </tr>
            <?php
                $row=fetchall(query($db,"SELECT*FROM `data`"));
                for($i=0;$i<count($row);$i++){
                    ?>
                    <tr>
                        <td class="td"><?= $row[$i][1] ?></td>
                        <td class="td"><?= $row[$i][2] ?></td>
                        <td class="td"><?= $row[$i][3] ?></td>
                        <td class="td"><?= $row[$i][4] ?></td>
                        <td class="td"><?= $row[$i][5] ?></td>
                        <td class="td"><?= $row[$i][6] ?></td>
                        <td class="td"><?= $row[$i][7] ?></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
    <?php
        if(isset($_GET["searchsubmit"])){
            $_SESSION["search"]=$_GET["search"];
            ?><script>alert("查尋成功");location.href='admin.php'</script><?php
        }
        if(isset($_GET["ref"])){
            $_SESSION["timer"]=$_GET["timer"];
            ?><script>alert("調整成功");location.href='admin.php'</script><?php
        }
    ?>
    <script src="timer.js"></script>
</body>
</html>