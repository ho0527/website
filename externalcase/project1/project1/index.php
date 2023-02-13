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
                <input type="reset" value="清除" name="clear" class="button">
                <button type="button" class="button" onclick="loginclick()">登入</button><br><br>
            </form>
        </div>
        <script src="verifycode.js"></script>
    </body>
</html>