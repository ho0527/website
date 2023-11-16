<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
        ?>
        <div class="nbar">
            <img src="media/icon/mainicon.gif" class="logo">
            <h1 class="title">咖啡商品展示系統</h1>
        </div>
        <div class="main">
            <form method="POST" action="api/login.php">
                帳號: <input type="text" name="username" id="username"><br><br>
                密碼: <input type="text" name="password" id="password"><br><br>
                圖形驗證碼:<br><br>
                <?php
                    $_SESSION["verifycode"]="";
                    for($i=0;$i<4;$i=$i+1){
                        $str="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789"[rand(0,61)];
                        ?>
                        <img src="api/verifycode.php?str=<?= $str ?>" class="verifycodeimage" id="<?= $i ?>" data-id="<?= $str ?>">
                        <?php
                        $_SESSION["verifycode"]=$_SESSION["verifycode"].$str;
                    }
                ?><br><br>
                輸入框提示規則<br>
                請拖動驗證碼<span id="val">
                    <?php
                        $code=[$_SESSION["verifycode"][0],$_SESSION["verifycode"][1],$_SESSION["verifycode"][2],$_SESSION["verifycode"][3]];
                        $rand=rand(0,1);
                        if($rand==0){
                            echo("'由小排到大'");
                            sort($code);
                        }else{
                            echo("'由大排到小'");
                            rsort($code);
                        }
                        $_SESSION["verifycode"]=implode("",$code);
                    ?>
                </span>:<br><br>
                <div class="box" id="drop"></div><br>
                <input type="hidden" name="ans" id="ans">
                <div class="buttondiv">
                    <input type="button" id="ref" value="重新產生">
                    <input type="button" id="ref2" value="重設">
                    <input type="submit" name="submit" value="送出">
                </div>
            </form>
        </div>
        <script src="index.js"></script>
    </body>
</html>