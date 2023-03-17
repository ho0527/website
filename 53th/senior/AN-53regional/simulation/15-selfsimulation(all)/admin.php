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
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        unset($_SESSION["edit"]);
        unset($_SESSION["del "]);
    ?>
    <h1>咖啡商品展示系統</h1>
    <input type="button" class="but" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="but" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="but selt" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出"><hr>
    <div class="timer">
        <form action="">
            <input type="text" class="timer2" id="timer" value="<?= $_SESSION["timer"] ?>" readonly>
            <input type="number" name="timer" id="" value="<?= $_SESSION["timer"] ?>">
            <input type="submit" name="ref" value="重新計時">
        </form>
    </div>
    <div class="lightbox">
        <div class="main2">
            是否繼續操作?<br>
            <input type="button" onclick="location.reload()" value="Yes">
            <input type="button" onclick="location.href='link.php?logout='" value="否">
        </div>
    </div>
    <div class="main mag">
        <h2>會員管理</h2>
        <input type="button" class="but" onclick="location.href='edit.php'" value="新增使用者">
        <form action="">
            <input type="text" name="search" id="">
            <input type="submit" name="searchs" value="查尋">
        </form>
        <form action="">
            <table>
                <tr>
                    <td class="atd">編號<input type="submit" name="nb" id="nb" value="降冪"></td>
                    <td class="atd">帳號<input type="submit" name="un" id="un" value="降冪"></td>
                    <td class="atd">密碼</td>
                    <td class="atd">姓名<input type="submit" name="n" id="n" value="降冪"></td>
                    <td class="atd">權限</td>
                </tr>
                <?php
                    if(isset($_SESSION["edit"])){
                        $type=$_SESSION["edit"];
                        updown(fetchall(query($db,"SELECT*FROM `user` WHERE `username`LIKE'%$type%'or`name`LIKE'%$type%'or`code`LIKE'%$type%'or`number`LIKE'%$type%'or`permission`LIKE'%$type%'")));
                    }else{
                        updown(fetchall(query($db,"SELECT*FROM `user`")));
                    }
                ?>
            </table>
        </form>
    </div><br>
    <div class="main">
        <h2>登出登入紀錄</h2>
        <table>
            <tr>
                <td class="atd">使用者</td>
                <td class="atd">動作(登入/登出)</td>
                <td class="atd">成功/失敗</td>
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
                        <td class="atd"><?= $row[$i][4] ?></td>
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
            if($_GET["timer"]<=0){
                ?><script>alert("禁止輸入小於等於0的時間");location.href="admin.php"</script><?php
            }else{
                $_SESSION["timer"]=$_GET["timer"];
                ?><script>location.href="admin.php"</script><?php
            }
        }
    ?>
    <script src="timer.js"></script>
</body>
</html>