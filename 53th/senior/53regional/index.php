<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>網站前台登入頁面</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){ header("location:verify.php"); }
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="logo.png" class="logo">
            </div>
            <div class="navigationbartitle center">咖啡商品展示系統</div>
        </div>
        <div class="main">
            <form method="POST">
                帳號: <input type="text" class="input" id="username" name="username" value="<?= @$_SESSION["username"] ?>"><br><br>
                密碼: <input type="text" class="input" id="password" name="password" value="<?= @$_SESSION["password"] ?>"><br><br>
                <div class="dragdiv">圖形驗證碼</div>
                <?php
                    $_SESSION["verifycode"]="";
                    for($i=0;$i<4;$i=$i+1){
                        $str=array_merge(range("a","z"),range(0,9),range("A","Z"))[rand(0,61)];
                        ?>
                        <div class="dragbox">
                            <img src="verifycode.php?str=<?= $str ?>" class="dragimg" id="<?= $i ?>" data-id="<?= $str ?>" draggable="true">
                        </div>
                        <?php
                        $_SESSION["verifycode"]=$_SESSION["verifycode"].$str;
                    }
                ?><br><br>
                <div class="dragdiv">
                    請拖動驗證碼圖片
                    <?php
                        $key=rand(0,1);
                        $string=array(
                            "'由大排到小'",
                            "'由小排到大'"
                        );
                        echo($string[$key]);
                        $_SESSION["key"]=$key;
                    ?>
                </div>
                <div class="dropbox" id="dropbox"></div><br><br>
                <input type="submit" class="button" name="reflashpng" value="重新產生">
                <input type="button" class="button" onclick="location.href='?clear='" value="清除">
                <input type="button" class="button" onclick="loginclick()" value="登入">
                <?php
                    if(isset($_POST["reflashpng"])){
                        $_SESSION["username"]=$_POST["username"];
                        $_SESSION["password"]=$_POST["password"];
                        header("location:index.php");
                    }
                    if(isset($_GET["clear"])){
                        unset($_SESSION["username"]);
                        unset($_SESSION["password"]);
                        header("location:index.php");
                    }
                ?>
            </form>
        </div>
        <script src="verifycode.js"></script>
    </body>
</html>