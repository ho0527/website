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
        if(isset($_SESSION["data"])){ header("location:main.php"); }
    ?>
    <div class="maindiv">
        <h1 class="hometitle">咖啡商品展示系統</h1><br>
        <div class="main">
            <form>
                <div class="center mag">
                    <div class="text">帳號: </div><input type="text" name="username" id="username" value="<?= @$_SESSION["username"] ?>"><br><br>
                    <div class="text">密碼: </div><input type="text" name="code" id="code" value="<?= @$_SESSION["code"] ?>"><br>
                </div>
                <div class="center mag">
                    驗證碼:<br>
                    <?php
                        $_SESSION["verify"]="";
                        for($i=0;$i<4;$i++){
                            $str=array_merge(range("0","9"),range("A","Z"),range("a","z"))[rand(0,61)];
                            ?>
                            <div class="dragbox">
                                <img src="verifycode.php?val=<?= $str ?>" alt="" id="<?= $str ?>" class="dragimg">
                            </div>
                            <?php
                            $_SESSION["verify"].=$str;
                        }
                    ?>
                </div>
                <div class="center mag">
                    請拖動驗證碼
                    <?php
                        $bos=["'由大排到小'","'由小排到大'"];
                        $key=rand(0,1);
                        echo($bos[$key]);
                        $_SESSION["key"]=$key;
                    ?><br>
                    <div class="dropbox"></div>
                    <div class="test"></div>
                </div>
                <div class="center mag">
                    <input type="submit" class="inputbutton" name="ref" value="重新產生">
                    <input type="submit" class="inputbutton" name="clear" value="重設">
                    <input type="button" class="inputbutton" onclick="login()" value="送出按鈕">
                </div>
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
    </div>
</body>
</html>