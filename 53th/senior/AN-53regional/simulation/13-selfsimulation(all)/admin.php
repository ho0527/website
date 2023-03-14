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
            height: 300px;
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
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
        unset($_SESSION["del"]);
        unset($_SESSION["edit"]);
        $number=$_SESSION["data"];
        $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"));
    ?>
    <h1>咖啡商品展示系統</h1>
    <input type="button" class="mbutton" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="mbutton" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="mbutton selt" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="mbutton" onclick="location.href='search.php'" value="查尋">
    <input type="button" class="mbutton logout" onclick="location.href='link.php?logout='" value="登出">
    <hr>
    <div class="timert">
        <form action="">
            <table>
                <tr>
                    <td class="timer" rowspan="2"><input type="text" class="btime" name="timer" id="timer" value="<?= $row[6] ?>" readonly></td>
                    <td class="timer"><input type="number" name="timer" value="<?= $row[6] ?>"></td>
                </tr>
                <tr>
                    <td class="timer"><input type="submit" name="ref" value="重新產生"></td>
                </tr>
            </table>
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
        <input type="button" class="mbutton" onclick="location.href='edit.php'" value="新增使用者"><br>
        <form action="">
            <input type="text" name="search" id="">
            <input type="submit" name="searchsubmit" value="查尋">
        </form>
        <table>
            <form action="">
                <tr>
                    <td class="admintd">編號<input type="submit" name="udnb" id="udnb" value="升冪"></td>
                    <td class="admintd">帳號<input type="submit" name="udun" id="udun" value="升冪"></td>
                    <td class="admintd">密碼</td>
                    <td class="admintd">姓名<input type="submit" name="udn" id="udn" value="升冪"></td>
                    <td class="admintd">權限</td>
                </tr>
                <?php
                    if(isset($_SESSION["search"])){
                        $type=$_SESSION["search"];
                        updown(fetchall(query($db,"SELECT*FROM `user` WHERE `username`LIKE'%$type%'or`code`LIKE'%$type%'or`name`LIKE'%$type%'or`number`LIKE'%$type%'or`permission`LIKE'%$type%'")));
                    }else{
                        updown(fetchall(query($db,"SELECT*FROM `user`")));
                    }
                ?>
            </form>
        </table>
    </div>
    <div class="main">
        <table>
            <tr>
                <td class="admintd">使用者</td>
                <td class="admintd">動作</td>
                <td class="admintd">時間</td>
            </tr>
            <?php
                $row=fetchall(query($db,"SELECT*FROM `data`"));
                for($i=0;$i<count($row);$i++){
                    ?>
                    <tr>
                        <td class="admintd"><?= $row[$i][1] ?></td>
                        <td class="admintd"><?= $row[$i][6] ?></td>
                        <td class="admintd"><?= $row[$i][7] ?></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
    <?php
        if(isset($_GET["searchsubmit"])){
            $_SESSION["search"]=$_GET["search"];
            ?><script>alert("查尋成功");location.href="admin.php"</script><?php
        }
        
        if(isset($_GET["ref"])){
            $timer=$_GET["timer"];
            if($timer<=0){
                ?><script>alert("請勿新增<=的數");location.href="admin.php"</script><?php
            }else{
                query($db,"UPDATE `user` SET `timer`='$timer' WHERE `number`='$number'");
                ?><script>alert("更新成功");location.href="admin.php"</script><?php
            }
        }
    ?>
    <script src="timer.js"></script>
</body>
</html>