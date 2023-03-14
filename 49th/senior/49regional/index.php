<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>網站前台登入頁面</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <div class="main">
            <form>
                <?php
                    include("link.php");
                    if(isset($_SESSION["data"])){ header("location:verify.php"); }
                ?>
                <h1>電子競技網站管理</h1><hr>
                帳號: <input type="text" name="username" class="input" id="username" value="<?= @$_SESSION["username"] ?>"><br><br>
                密碼: <input type="text" name="code" class="input" id="code" value="<?= @$_SESSION["password"] ?>"><br><br>
                <?php
                    $_SESSION["verifycode1"]="";
                    $_SESSION["verifycode2"]="";
                    for($i=0;$i<2;$i=$i+1){
                        $str=rand(0,9);
                        ?>
                        <div class="dragbox">
                            <img src="verifycode.php?val=<?= $str ?>" draggable="false">
                        </div>
                        <?php
                        $_SESSION["verifycode1"]=$_SESSION["verifycode1"].$str;
                    }
                    $mid=rand(0,1);
                    $plus="+";
                    $mis="-";
                    if($mid==0){
                        ?>
                        <div class="dragbox">
                            <img src="verifycode.php?val=<?= $plus ?>" draggable="false">
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="dragbox">
                            <img src="verifycode.php?val=-" draggable="false">
                        </div>
                        <?php
                    }
                    for($i=0;$i<2;$i=$i+1){
                        $str=rand(0,9);
                        ?>
                        <div class="dragbox">
                            <img src="verifycode.php?val=<?= $str ?>" draggable="false">
                        </div>
                        <?php
                        $_SESSION["verifycode2"]=$_SESSION["verifycode2"].$str;
                    }
                    if($mid==0){
                        $_SESSION["verifycode"]=((int)$_SESSION["verifycode1"])+((int)$_SESSION["verifycode2"]);
                    }else{
                        $_SESSION["verifycode"]=((int)$_SESSION["verifycode1"])-((int)$_SESSION["verifycode2"]);
                        if($_SESSION["verifycode"]<=0){ header("location:index.php"); }
                    }
                ?>
                <input type="submit" class="button" name="reflashpng" value="驗證碼重新產生"><br><br>
                <?php
                    for($i=0;$i<=9;$i=$i+1){
                        ?>
                        <div class="dragbox">
                            <img src="verifycode.php?val=<?= $i ?>" id="<?= $i ?>" class="dragimg" draggable="true">
                        </div>
                        <?php
                    }
                ?><br><br>
                圖片驗證碼:<br>
                <div class="dropbox" id="dropbox"></div><br>
                <input type="submit" class="button" name="clear" value="重設">
                <input type="button" class="button" onclick="login()" value="送出"><br><br>
                <input type="button" onclick="location.href='index.php'" value="模組1" disabled>
                <input type="button" onclick="location.href='index.php'" value="模組2">
                <input type="button" onclick="location.href='verify.php'" value="模組3">
                <input type="button" onclick="location.href='admin.php'" value="模組4">
                <input type="button" onclick="location.href='main.php'" value="模組5">
                <?php
                    if(isset($_GET["reflashpng"])){
                        $_SESSION["username"]=$_GET["username"];
                        $_SESSION["password"]=$_GET["code"];
                        ?><script>location.href="index.php"</script><?php
                    }
                    if(isset($_GET["clear"])){
                        unset($_SESSION["username"]);
                        unset($_SESSION["password"]);
                        ?><script>location.href="index.php"</script><?php
                    }
                ?>
            </form>
        </div>
        <script src="verifycode.js"></script>
    </body>
</html>