<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>網站前台登入介面</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php session_start() ?>
        <div class="index">
            <form>
                <div class="title">咖啡商品展示系統</div>
                帳號: <input type="text" name="username" id="username" value="<?= @$_SESSION["username"] ?>"><br>
                密碼: <input type="text" name="code" id="code" value="<?= @$_SESSION["code"] ?>"><br>
                驗證碼:<br>
                <?php
                    $_SESSION["verify"]="";
                    for($i=0;$i<4;$i=$i+1){
                        $finalstr=array_merge(range(0,9),range("A","Z"),range("a","z"))[rand(0,61)];
                        ?>
                        <div class="dragbox">
                            <img src="verifycode.php?val=<?= $finalstr ?>" alt="" id="<?= $finalstr ?>" class="dragimg">
                        </div>
                        <?php
                        $_SESSION["verify"]=$_SESSION["verify"].$finalstr;
                    }
                ?>
                <input type="submit" name="reflash" value="重新產生"><br>
                請託動驗證碼
                <?php
                    $bos=["'由大排到小'","'由小排到大'"];
                    $key=rand(0,1);
                    echo($bos[$key]);
                    $_SESSION["key"]=$key;
                ?><br>
                <div class="dropbox" id="dropbox"></div><br>
                <input type="submit" name="clear" value="清除">
                <input type="button" onclick="login()" value="送出">
            </form>
        </div>
        <?php
            if(isset($_GET["reflash"])){
                $_SESSION["username"]=$_GET["username"];
                $_SESSION["code"]=$_GET["code"];
                header("location:index.php");
            }
            if(isset($_GET["clear"])){
                session_unset();
                header("location:index.php");
            }
        ?>
        <script src="verifycode.js"></script>
    </body>
</html>