<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>A06</title>
    </head>
    <body>
        <form>
            <!-- Display the captcha image -->
            <img src="verifycode.php" alt="Captcha image"><input type="button" value="重新產生" onclick="location.href='06.php'"><br>
            <!-- Captcha code input field -->
            輸入驗證碼:<input type="text" name="captcha_code" id="captcha_code"><br>
            <!-- Submit button -->
            <input type="submit" value="送出">
        </form>
        <?php
            session_start();
            if(isset($_GET["captcha_code"])){
                //判斷輸入值是否與SESSION值相同
                if($_GET["captcha_code"]==$_SESSION["captcha_code"]){
                    //做成功圖片
                    ?>
                    <p style="font-size:48px;font-weight:bold;color:#008800">成功</p>
                    <?php
                }else{
                    // 做失敗圖片
                    ?>
                    <p style="font-size:48px;font-weight:bold;color:#880000">失敗</p>
                    <?php
                }
            }
        ?>
    </body>
</html>