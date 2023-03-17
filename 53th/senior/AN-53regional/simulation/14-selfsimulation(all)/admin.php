<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>咖啡商品展示系統</title>
        <link rel="stylesheet" href="index.css">
        <style>
            .main{
                width: 75%;
                height: 300px;
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
            $number=$_SESSION["data"];
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"))
        ?>
        <h1>咖啡商品展示系統</h1>
        <input type="button" class="button" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="button" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="button selt" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="button" onclick="location.href='link.php?logout='" value="登出">
        <hr>
        <div class="timer mag">
            <form action="">
                <table>
                    <tr>
                        <td class="time" rowspan="2"><input type="text" id="timer" value="<?= $row[6] ?>"></td>
                        <td class="time"><input type="text" name="timer" value="<?= $row[6] ?>"></td>
                    </tr>
                    <tr>
                        <td class="time">
                            <input type="submit" name="ref" value="重新產生">
                        </td>
                    </tr>
                </table>
            </form>
        </div><br>
        <div class="lightbox">
            <div class="main2">
                是否繼續操作?<br>
                <input type="button" onclick="location.reload()" value="Yes">
                <input type="button" onclick="location.href='link.php?logout='" value="否">
            </div>
        </div>
        <div class="main mag">
            <h2>會員管理</h2>
            <input type="button" onclick="location.href='edit.php'" value="新增使用者">
            <form action="">
                <input type="text" name="search" id="">
                <input type="submit" name="searchs" value="送出">
            </form>
            <table>
                <form action="">
                    <tr>
                        <td class="admintd">使用者編號<input type="submit" name="udnb" id="udnb" value="升冪"></td>
                        <td class="admintd">帳號<input type="submit" name="udun" id="udun" value="升冪"></td>
                        <td class="admintd">密碼</td>
                        <td class="admintd">姓名<input type="submit" name="udn" id="udn" value="升冪"></td>
                        <td class="admintd">權限</td>
                    </tr>
                    <?php
                        if(isset($_SESSION["search"])){
                            $type=$_SESSION["search"];
                            updown(fetchall(query($db,"SELECT*FROM `user` WHERE `username`LIKE'%$type%'or`number`LIKE'%$type%'or`name`LIKE'%$type%'or`code`LIKE'%$type%'or`permission`LIKE'%$type%'")));
                        }else{
                            updown(fetchall(query($db,"SELECT*FROM `user`")));
                        }
                    ?>
                </form>
            </table>
        </div><br>
        <div class="main">
            <h2>登入登出紀錄</h2>
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
                            <td class="admintd"><?= $row[$i][2] ?></td>
                            <td class="admintd"><?= $row[$i][3] ?></td>
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
                    ?><script>alert("禁止輸入小於等於0的數");location.href="admin.php"</script><?php
                }else{
                    $number=$_SESSION["data"];
                    $timer=$_GET["timer"];
                    query($db,"UPDATE `user` SET `timer`='$timer' WHERE `number`='$number'");
                    ?><script>location.href="admin.php"</script><?php
                }
            }
        ?>
        <script src="timer.js"></script>
    </body>
</html>