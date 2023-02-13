<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>網站前台登入頁面</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <div class="indexdiv">
            <form>
                <?php session_start(); ?>
                <class class="indextitle">咖啡商品展示系統</class><br>
                帳號: <input type="text" name="username" id="username" value="<?= @$_SESSION["username"] ?>" class="input"><br>
                密碼: <input type="text" name="code" id="code" value="<?= @$_SESSION["password"] ?>" class="input"><br>
                驗證碼:<br>
                <?php
                    $_SESSION["verifycode"]="";
                    for($i=0;$i<4;$i=$i+1){
                        $finalstr=array_merge(range("a","z"),range(0,9),range("A","Z"))[rand(0,61)];
                        ?>
                        <div class="dragbox">
                            <img src="verifycode.php?val=<?= $finalstr ?>" id="<?= $finalstr ?>" class="dragimg" draggable="true">
                        </div>
                        <?php
                        $_SESSION["verifycode"]=$_SESSION["verifycode"].$finalstr;
                    }
                ?>
                <input type="submit" name="reflashpng" value="重新產生" class="button"><br>
                請拖動驗證碼圖片
                <?php
                    $key=rand(0,1);
                    $string=array(
                        "'由大排到小'",
                        "'由小排到大'"
                    );
                    echo($string[$key]);
                    $_SESSION["key"]=$key;
                ?><br>
                <div class="dropbox" id="dropbox"></div><br>
                <input type="submit" value="清除" name="clear" class="button">
                <button type="button" class="button" onclick="loginclick()">登入</button><br><br>
                <?php
                    if(isset($_GET["reflashpng"])){
                        @$_SESSION["username"]=$_GET["username"];
                        @$_SESSION["password"]=$_GET["code"];
                        header("location:index.php");
                    }
                    if(isset($_GET["clear"])){
                        session_unset();
                        header("location:index.php");
                    }
                ?>
            </form>
        </div>
        <script src="verifycode.js"></script>
    </body>
</html>