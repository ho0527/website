<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 75%;
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
        unset($_SESSION["edit"]);
        unset($_SESSION["del"]);
        $data=$_SESSION["data"];
        $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"));
    ?>
    <h1>咖啡商品展示系統</h1>
    <input type="button" class="but" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="but" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="but selt" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
    <hr>
    <div class="timer">
        <form action="">
            <table class="ttalbe">
                <tr>
                    <td class="ttd" rowspan="2"><input type="text" class="mtimer" id="timer" value="<?= $row[6] ?>" readonly></td>
                    <td class="ttd"><input type="text" name="timer" id="" value="<?= $row[6] ?>"></td>
                </tr>
                <tr>
                    <td class="ttd"><input type="submit" name="ref" value="重新計時"></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="lightbox">
        <div class="main2">
            是否繼續操作?<br>
            <input type="button" onclick="location.href='admin.php'" value="Yes">
            <input type="button" onclick="location.href='link.php?logout='" value="否">
        </div>
    </div><br><br>
    <div class="main">
        <h2>會員管理</h2>
        <input type="button" class="but" onclick="location.href='edit.php'" value="新增使用者">
        <form action="">
            <input type="text" name="search" id="">
            <input type="submit" name="searchs" value="查尋">
        </form>
        <br><br>
        <table>
            <form action="">
                <tr>
                    <td class="atd">使用者編號<input type="submit" name="udnb" id="udnb" value="升冪"></td>
                    <td class="atd">帳號<input type="submit" name="udun" id="udun" value="升冪"></td>
                    <td class="atd">密碼</td>
                    <td class="atd">姓名<input type="submit" name="udn" id="udn" value="升冪"></td>
                    <td class="atd">權限</td>
                </tr>
                <?php
                    if(isset($_SESSION["search"])){
                        $type=$_SESSION["search"];
                        updown(fetchall(query($db,"SELECT*FROM `user` WHERE `username`LIKE'%$type%'or`code`LIKE'%$type%'or`name`LIKE'%$type%'or`permission`LIKE'%$type%'or`number`LIKE'%$type%'")));
                    }else{
                        updown(fetchall(query($db,"SELECT*FROM `user`")));
                    }
                ?>
            </form>
        </table>
    </div><br><br>
    <div class="main">
        <h2>登入登出紀錄</h2><br><br>
        <table>
            <tr>
                <td class="atd">使用者</td>
                <td class="atd">動作</td>
                <td class="atd">時間</td>
            </tr>
            <?php
            $row=fetchall(query($db,"SELECT*FROM `data`"));
            for($i=0;$i<count($row);$i++){
                ?>
                <tr>
                    <td class="atd"><?= $row[$i][1] ?></td>
                    <td class="atd"><?= $row[$i][2] ?></td>
                    <td class="atd"><?= $row[$i][3] ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <?php
        if(isset($_GET["searchs"])){
            $_SESSION["search"]=$_GET["search"];
            ?><script>location.href="admin.php"</script><?php
        }
        if(isset($_GET["ref"])){
            $timer=$_GET["timer"];
            if($timer<=0){
                ?><script>alert("禁止輸入小於等於0的數");location.href="admin.php"</script><?php
            }else{
                query($db,"UPDATE `user` SET `timer`='$timer' WHERE `number`='$data'");
                ?><script>location.href="admin.php"</script><?php
            }
        }
    ?>
    <script src="timer.js"></script>
</body>
</html>