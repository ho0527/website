<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>網站前台登入頁面</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php")
        ?>  
        <div class="main">
            <form>
                咖啡商品展示系統<br>
                帳號: <input type="text" name="username" id="username" value="<?= @$_SESSION["username"] ?>"><br>
                密碼: <input type="text" name="code" id="code" value="<?= @$_SESSION["code"] ?>"><br>
                驗證碼:<br>
                <?php
                    $_SESSION["verify"]="";
                    for($i=0;$i<4;$i++){
                        $str=array_merge(range("0","9"),range("A","Z"),range("a","z"))[rand(0,61)];
                        ?>
                        <div class="dragbox">
                            <img src="verifycode.php?val=<?= $str ?>" id="<?= $str ?>" class="dragimg">
                        </div>
                        <?php
                        $_SESSION["verify"].=$str;
                    }
                ?>
                <input type="submit" name="ref" value="重新產生"><br>
                <input type="submit" name="ref" value="驗證碼重新產生"><br>
                請拖動驗證碼
                <?php
                    $bos=["'由大排到小'","'由小排到大'"];
                    $key=rand(0,1);
                    echo($bos[$key]);
                    $_SESSION["key"]=$key;
                ?><br>
                <div class="dropbox"></div><br>
                <input type="submit" name="clear" value="清除">
                <input type="submit" name="clear" value="重設">
                <input type="button" onclick="login()" value="登入">
                <input type="button" onclick="login()" value="送出按鈕">
            </form>
        </div>
        <?php
            if(isset($_GET["ref"])){
                $_SESSION["username"]=$_GET["username"];
                $_SESSION["code"]=$_GET["code"];
                header("location:index.php");
            }
        ?>
    <script src="verifycode.js"></script>
    </body>
</html>