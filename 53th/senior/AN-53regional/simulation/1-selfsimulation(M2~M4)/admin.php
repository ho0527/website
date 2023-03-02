<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="head">
        <form class="headf">
            咖啡商品展示系統-首頁
            <input type="button" class="ubutton" onclick="location.href='signupedit.php'" value="新增使用者">
            <input type="button" class="ubutton" onclick="location.href='user.php'" value="首頁">
            <input type="button" class="ubutton" onclick="location.href=''" value="上架商品">
            <input type="button" class="ubutton" onclick="location.href=''" value="查詢">
            <input type="button" class="ubutton select" onclick="location.href='admin.php'" value="會員管理">
            <input type="submit" class="ubutton" name="logout" value="登出">
            <input type="text" name="search" placeholder="查詢">
            <input type="submit" name="submit" value="送出">
        </form>
    </div>
    <table class="atable">
        <tr>
            <form>
                <td class="admtable">編號<input type="submit" name="num" id="num" value="升冪"></td>
                <td class="admtable">帳號<input type="submit" name="username" id="username" value="升冪"></td>
                <td class="admtable">密碼<input type="submit" name="code" id="code" value="升冪"></td>
                <td class="admtable">姓名<input type="submit" name="name" id="name" value="升冪"></td>
                <td class="admtable">權限</td>
                <td class="admtable">動作時間</td>
                <td class="admtable">動作</td>
                <?php
                    include("link.php");
                    if(isset($_GET["submit"])){
                        $search=$_GET["search"];
                        if($search==""){
                            header("location:admin.php");
                        }else{
                            updown(fetchall(query($db,"SELECT*FROM `data` WHERE `number`LIKE'%$search%' or `username`LIKE'%$search%' or `password`LIKE'%$search%' or `name`LIKE'%$search%' or `permission`LIKE'%$search%' or `time`LIKE'%$search%' or `move`LIKE'%$search%'")));
                        }
                    }else{
                        updown(fetchall(query($db,"SELECT*FROM `data`")));
                    }
                ?>
            </form>
        </tr>
    </table>
    <form>
        <table class="timer">
            <tr>
                <td rowspan="2" class="time">
                    <input type="text" id="timer" class="input1" value="<?= $_SESSION["timer"] ?>" readonly>
                </td>
                <td class="time">
                    <input type="text" name="time" class="input2" id="time" value="<?= $_SESSION["timer"] ?>">
                    <input type="submit" name="tsubmit" value="送出">
                </td>
            </tr>
            <tr>
                <td class="time">
                    <input type="button" onclick="location.reload()" value="重新計時">
                </td>
            </tr>
        </table>
        <div class="ask" id="ask">
            <div>
                是否繼續?<br>
                <input type="button" class="checkbut" onclick="location.reload()" value="Yes">
                <input type="submit" class="checkbut" name="logout" value="no">
            </div>
        </div>
    </form>
    <?php
        if(isset($_GET["del"])){
            $num=$_GET["del"];
            if($row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$num'"))){
                query($db,"DELETE FROM `user` WHERE `number`='$num'");
                ?><script>alert("刪除成功");location.href="admin.php"</script><?php
            }else{
                ?><script>alert("帳號已被刪除");location.href="admin.php"</script><?php
            }
        }
        if(isset($_GET["tsubmit"])){
            $_SESSION["timer"]=$_GET["time"];
            ?><script>alert("更改成功");location.href="admin.php"</script><?php
        }
    ?>
    <script src="timer.js"></script>
</body>
</html>