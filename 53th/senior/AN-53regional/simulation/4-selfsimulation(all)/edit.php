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
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if(isset($_GET["edit"])){

        }else{
            ?>
            <div class="head">
                <form action="">
                    <div class="title">咖啡商品展示系統-新增使用者</div>
                    <div class="hbut">
                        <input type="button" class="headbut selt" onclick="location.href='edit.php'" value="新增使用者">
                        <input type="button" class="headbut" onclick="location.href='main.php'" value="首頁">
                        <input type="button" class="headbut" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="headbut" onclick="location.href='search.php'" value="查詢">
                        <input type="button" class="headbut" onclick="location.href='admin.php'" value="會員管理">
                        <input type="submit" class="headbut" name="logout" value="登出">
                    </div>
                </form>
            </div>
            <div class="main">
                <form action="">
                    姓名: <input type="text" name="name" id=""><br>
                    帳號: <input type="text" name="username" id=""><br>
                    密碼: <input type="text" name="code" id=""><br>
                    管理員權限 <input type="checkbox" name="admin" id="">
                    <input type="button" onclick="location.href='main.php'" value="取消">
                    <input type="submit" name="new" value="送出">
                </form>
            </div>
            <?php
        }
        if(isset($_GET["new"])){
            $username=$_GET["username"];
            $code=$_GET["code"];
            $name=$_GET["name"];
            if($username==""||$code==""){
                ?><script>alert("請輸入帳密");location.href="edit.php"</script><?php
            }elseif($row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"))){
                ?><script>alert("帳號已被註冊");location.href="edit.php"</script><?php
            }else{
                if($_GET["admin"]){
                    query($db,"INSERT INTO `user`(`number`, `username`, `password`, `name`, `permission`) VALUES ('','$username','$code','$name','管理者')");
                }else{
                    query($db,"INSERT INTO `user`(`number`, `username`, `password`, `name`, `permission`) VALUES ('','$username','$code','$name','一般使用者')");
                }
                $row=fetch(query($db,"SELECT*FROM `user` WHERE `username`='$username'"));
                $number=str_pad($row[0]-1,4,"0",STR_PAD_LEFT);
                query($db,"UPDATE `user` SET `number`='$number' WHERE `username`='$username'");
                ?><script>alert("新增成功");location.href="main.php"</script><?php
            }
        }
    ?>
</body>
</html>