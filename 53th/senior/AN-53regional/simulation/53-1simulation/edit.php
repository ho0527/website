<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_GET["e"])){
                $id=$_GET["e"];
                if($row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$id'"))){
                ?>
                    <div class="nbar">
                        <div class="title">咖啡商品管理系統-編輯使用者</div>
                        <div class="divbut">
                            <input type="button" class="hbutton selt" onclick="location.href='edit.php'" value="編輯使用者">
                            <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                            <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="上架商品">
                            <input type="button" class="hbutton" onclick="location.href='serch.php'" value="查詢">
                            <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                            <input type="submit" class="hbutton" name="logout" value="登出">
                        </div>
                    </div>
                    <div class="main">
                        <form>
                            編號: <input type="text" name="number" value="<?= $row[4] ?>" readonly><br>
                            姓名: <input type="text" name="name" value="<?= $row[3] ?>" id="name"><br>
                            帳號: <input type="text" name="username" value="<?= $row[1] ?>" id="username"><br>
                            密碼: <input type="text" name="code" value="<?= $row[2] ?>" id="code"><br>
                            <?php
                                if($row[5]=="管理者"){
                                ?>
                                    管理員權限 <input type="checkbox" name="admin" checked>
                                    <?php
                                }else{
                                ?>
                                管理員權限 <input type="checkbox" name="admin">
                                <?php
                                }
                            ?>
                            <input type="submit" name="clear" onclick="location.reload()" value="清除">
                            <input type="submit" name="es" value="送出">
                        </form>
                    </div>
                <?php
                }else{
                    ?><script>alert("帳號已被刪除");location.href="admin.php"</script><?php
                }
            }else{
                ?>
                <div class="nbar">
                    <div class="title">咖啡商品管理系統-新增使用者</div>
                    <div class="divbut">
                        <input type="button" class="hbutton selt" onclick="location.href='edit.php'" value="新增使用者">
                        <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="hbutton" onclick="location.href='serch.php'" value="查詢">
                        <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="hbutton" name="logout" value="登出">
                    </div>
                </div>
                <div class="main">
                    <form>
                姓名: <input type="text" name="name" id="name"><br>
                帳號: <input type="text" name="username" id="username"><br>
                密碼: <input type="text" name="code" id="code"><br>
                管理員權限 <input type="checkbox" name="admin">
                <input type="submit" name="clear" onclick="location.reload()" value="清除">
                <input type="submit" name="new" value="送出">
            </form>
            </div>
            <?php
            }
        ?>  
        <?php
            if(isset($_GET["new"])){
                $username=$_GET["username"];
                $name=$_GET["name"];
                $code=$_GET["code"];
                if($username==""||$code==""){
                    ?><script>alert("請輸入用戶名及密碼");location.href="edit.php"</script><?php
                }elseif($row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"))){
                    ?><script>alert("帳號已被註冊");location.href="edit.php"</script><?php
                }else{
                    if(isset($_GET["admin"])){
                        query($db,"INSERT INTO `user`(`username`, `code`, `name`, `number`, `premission`) VALUES ('$username','$code','$name','','管理者')");
                        $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                        $number=str_pad($row[0]-1,4,"0",STR_PAD_LEFT);
                        query($db,"UPDATE `user` SET `number`='$number'WHERE `username`='$username'");
                        ?><script>alert("註冊成功");location.href="main.php"</script><?php
                    }else{
                        query($db,"INSERT INTO `user`(`username`, `code`, `name`, `number`, `premission`) VALUES ('$username','$code','$name','','一般使用者')");
                        $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                        $number=str_pad($row[0]-1,4,"0",STR_PAD_LEFT);
                        query($db,"UPDATE `user` SET `number`='$number'WHERE `username`='$username'");
                        ?><script>alert("註冊成功");location.href="main.php"</script><?php
                    }
                }
            }
            if(isset($_GET["es"])){
                $number=$_GET["number"];
                $username=$_GET["username"];
                $name=$_GET["name"];
                $code=$_GET["code"];
                $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$number'"));
                if($username==""||$code==""){
                    ?><script>alert("請輸入用戶名及密碼");location.href="edit.php"</script><?php
                }elseif($row&&$row[4]!=$number){
                    ?><script>alert("帳號已被註冊");location.href="edit.php"</script><?php
                }else{
                    if(isset($_GET["admin"])){
                        query($db,"UPDATE `user` SET `username`='$username',`code`='$code',`name`='$name',`premission`='管理者' WHERE `number`='$number'");
                        ?><script>alert("更改成功");location.href="main.php"</script><?php
                    }else{
                        query($db,"UPDATE `user` SET `username`='$username',`code`='$code',`name`='$name',`premission`='一般使用者' WHERE `number`='$number'");
                        ?><script>alert("更改成功");location.href="main.php"</script><?php
                    }
                }
            }
        ?>
    </body>
</html>