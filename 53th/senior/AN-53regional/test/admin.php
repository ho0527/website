<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>管理者專區</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="header">
            <form class="headerform">
                <div class="headtitle">咖啡商品展示系統-會員管理</div>
                <div class="headbut">
                    <input type="button" class="hbutton" onclick="location.href='signupedit.php'" value="新增">
                    <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                    <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="hbutton" onclick="location.href='search.php'" value="查詢">
                    <input type="button" class="hbutton selectbut" onclick="location.href='admin.php'" value="會員管理">
                    <input type="submit" class="hbutton" name="logout" value="登出">
                </div>
            </form>
        </div>
        <table>
            <form>
                <tr>
                <td class="admintable">編號<input type="submit" name="num-up-down" id="num-up-down" value="升冪"></td>
                <td class="admintable">使用者帳號<input type="submit" name="user-up-down" id="user-up-down" value="升冪"></td>
                <td class="admintable">密碼<input type="submit" name="code-up-down" id="code-up-down" value="升冪"></td>
                <td class="admintable">名稱<input type="submit" name="name-up-down" id="name-up-down" value="升冪"></td>
                <td class="admintable">權限</td>
                <td class="admintable">時間</td>
                <td class="admintable">動作</td>
                </tr>
                <?php
                    include("link.php");
                    if(isset($_SESSION["type"])){
                        $type=$_SESSION["type"];
                        if($type==""){
                            unset($_SESSION["type"]);
                            header("location:admin.php");
                        }else{
                            $data=query($db,"SELECT*FROM `data` WHERE `number`LIKE'%$type%' or `username`LIKE'%$type%' or `password`LIKE'%$type%' or `name`LIKE'%$type%' or `permission`LIKE'%$type%' or `time`LIKE'%$type%' or `move`LIKE'%$type%'");
                            issetgetupdown($data);
                        }
                    }else{
                        $data=query($db,"SELECT*FROM `data`");
                        issetgetupdown($data);
                    }
                ?>
            </form>
        </table>
        <table class="timer">
            <tr>
                <td class="timertd" rowspan="2">
                    <input type="text" class="time" id="timer" value="<?= $_SESSION["timer"] ?>">
                </td>
                <td class="timertd">
                    <form action="">
                        <input type="text" class="inputime" name="time" value="<?= $_SESSION["timer"] ?>">
                        <input type="submit" name="timersubmit" value="送出">
                    </form>
                </td>
            </tr>
            <tr>
                <td class="timertd">
                    <input type="button" value="重新計時" onclick="location.reload()">
                </td>
            </tr>
        </table>
        <div class="lightbox" id="lightbox">
            <div class="body">
                是否繼續操作?<br>
                <input type="button" class="lightboxbut" value="Yes" onclick="location.reload()">
                <input type="button" class="lightboxbut" id="no" value="否">
            </div>
        </div>
        <?php
            if(isset($_GET["timersubmit"])){
                $_SESSION["timer"]=$_GET["time"];
                ?><script>alert("更改成功!");location.href="admin.php"</script><?php
            }
        ?>
        <script src="timer.js"></script>
    </body>
</html>