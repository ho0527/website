<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <form action="">
        <div class="nbar">
            <div class="title">咖啡商品管理系統-會員管理</div>
            <div class="divbut">
                <input type="button" class="hbutton" onclick="location.href='edit.php'" value="新增使用者">
                <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="hbutton" onclick="location.href='serch.php'" value="查詢">
                <input type="button" class="hbutton selt" onclick="location.href='admin.php'" value="會員管理">
                <input type="submit" class="hbutton" name="logout" value="登出">
            </div>
        </div>
    </form>
    <div class="admindivtop">
        <form>
            <table class="table">
                <tr>
                    <td class="admintd">編號</td>
                    <td class="admintd">帳號</td>
                    <td class="admintd">密碼</td>
                    <td class="admintd">姓名</td>
                    <td class="admintd">權限</td>
                    <td class="admintd">動作時間</td>
                    <td class="admintd">動作</td>
                </tr>
                <?php
                    include("link.php");
                    up($db,1);
                ?>
            </table>
        </form>
    </div>
    <div class="admindivbottom">
        <form>
            <table class="table">
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
                        if($a[$i][4]=="0000"||$a[$i][1]=="未知"){
                            ?>
                            <tr>
                                <td class="admintd">
                                    <?= $a[$i][4] ?>
                                    <input type="button" value="編輯" disabled>
                                    <input type="button" value="刪除帳號" disabled>
                                </td>
                                <td class="admintd"><?= $a[$i][1] ?></td>
                                <td class="admintd"><?= $a[$i][2] ?></td>
                                <td class="admintd"><?= $a[$i][3] ?></td>
                                <td class="admintd"><?= $a[$i][5] ?></td>
                            </tr>
                            <?php
                        }else{
                            ?>
                            <tr>
                                <td class="admintd">
                                    <?= $a[$i][4] ?>
                                    <input type="button" onclick="location.href='edit.php?e=<?= $a[$i][1] ?>'" value="編輯">
                                    <input type="button" onclick="location.href='admin.php?del=<?= $a[$i][1] ?>'" value="刪除帳號">
                                </td>
                                <td class="admintd"><?= $a[$i][1] ?></td>
                                <td class="admintd"><?= $a[$i][2] ?></td>
                                <td class="admintd"><?= $a[$i][3] ?></td>
                                <td class="admintd"><?= $a[$i][5] ?></td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </table>
        </form>
    </div>
    <table class="timertable">
        <tr>
            <td rowspan="2" class="ttd"><input type="text" class="timer" value="<?= $_SESSION["timer"] ?>" id="timer" readonly></td>
            <td class="ttd">
                <form action="">
                    <input type="text" class="time" name="timer" value="<?= $_SESSION["timer"] ?>">
                    <input type="submit" name="ct" value="送出">
                </form>
            </td>
        </tr>
        <tr>
            <td class="ttd"><input type="button" onclick="location.reload()" value="重新計時"></td>
        </tr>
    </table>
    <?php
        if(isset($_GET["ct"])){
            $_SESSION["timer"]=$_GET["timer"];
            ?><script>alert("更改成功");location.href="admin.php"</script><?php
        }
        if(isset($_GET["del"])){
            $num=$_GET["del"];
            if($row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$num'"))){
                query($db,"DELETE FROM `user` WHERE `number`='$num' ");
                ?><script>alert("刪除成功");location.href="admin.php"</script><?php
            }else{
                ?><script>alert("帳號已被刪除");location.href="admin.php"</script><?php
            }
        }
    ?>
    <script src="product.js"></script>
    <script src="timer.js"></script>
</body>
</html>