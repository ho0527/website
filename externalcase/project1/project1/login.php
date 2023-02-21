<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>網站前台登入介面</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <img src="" alt="" class="mainimage">
        <img src="" alt="" class="mainlogo">
        <div class="navigationbar">
            <div class="navigationbardiv">
                <div class="maintitle">Chatcom</div>
                <div class="navigationbarbuttondiv" id="navigationbarbuttondiv"></div>
            </div>
        </div>
        <div class="main">
            <form class="logindiv">
                <div class="title"></div>
                帳號: <input type="text" class="logininput" name="username" id="username"><br><br>
                密碼: <input type="text" class="logininput" name="code" id="code"><br><br>
                <input type="reset" class="loginbutton" name="clear" value="清除">
                <input type="submit" class="loginbutton" value="送出">
            </form>
        </div>
        <div class="footer" id="footer"></div>
        <script src="index.js"></script>
    </body>
</html>