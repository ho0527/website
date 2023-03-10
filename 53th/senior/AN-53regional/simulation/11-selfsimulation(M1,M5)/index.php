<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網站前台登入頁面</title>
    <link rel="stylesheet" href="index.css">
    <style>
        h1{
            margin-top: 250px;
        }
        .main{
            width: 25%;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(isset($_SESSION["data"])){ header("location:main.php"); }
    ?>
    <h1>咖啡商品管理系統</h1>
    <hr><br><br>
    <div class="main">
        <form action="">
            帳號: <input type="text" name="username" id="username" value="<?= @$_SESSION["username"] ?>"><br><br>
            密碼: <input type="text" name="code" id="code" value="<?= @$_SESSION["code"] ?>"><br><br>
            驗證碼:<br><br>
            <?php
                $_SESSION["verify"]="";
                for($i=0;$i<4;$i++){
                    $str=array_merge(range("0","9"),range("A","Z"),range("a","z"))[rand(0,61)];
                    ?>
                    <div class="dragbox">
                        <img src="verifycode.php?val=<?= $str ?>" id="<?= $str ?>" class="drag">
                    </div>
                    <?php
                    $_SESSION["verify"].=$str;
                }
            ?>
            <br><br>
            請拖動驗證碼
            <?php
                $bos=["'由大排到小'","'由小排到大'"];
                $key=rand(0,1);
                echo($bos[$key]);
                $_SESSION["key"]=$key;
            ?><br><br>
            <div class="dropbox"></div><br><br>
            <input type="submit" class="button" name="ref" value="重新產生">
            <input type="submit" class="button" name="clear" value="重設">
            <input type="button" class="button" onclick="login()" value="送出">
        </form>
    </div>
    <?php
        if(isset($_GET["ref"])){
            $_SESSION["username"]=$_GET["username"];
            $_SESSION["code"]=$_GET["code"];
            header("location:index.php");
        }
        if(isset($_GET["clear"])){
            unset($_SESSION["username"]);
            unset($_SESSION["code"]);
            header("location:index.php");
        }
    ?>
    <script src="verifycode.js"></script>
</body>
</html>