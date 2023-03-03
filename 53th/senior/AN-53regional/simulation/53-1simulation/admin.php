<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>望站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <form>
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
    <table class="table">
        <form>
            <td class="admintd">編號</td>
            <td class="admintd">帳號</td>
            <td class="admintd">密碼</td>
            <td class="admintd">姓名</td>
            <td class="admintd">權限</td>
            <td class="admintd">動作時間</td>
            <td class="admintd">動作</td>
            <?php
                include("link.php");
                up($db,1);
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
        </form>
    </table>
    <table class="timertable">
        <tr>
            <td rowspan="2" class="ttd"><input type="text" class="timer" value="<?= $_SESSION["timer"] ?>" id="timer" readonly></td>
            <td class="ttd">
                <form>
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
    ?>
    <script src="product.js"></script>
    <script src="timer.js"></script>
</body>
</html>