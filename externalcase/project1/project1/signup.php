<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Chatcom</title>
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
        <div class="form">
            <div class="formbox">
                <form method="POST">
                    <h2 id="signupheader"></h2>
                    <div class="inputbox">
                        <img src="image/mail-outline.svg" class="loginicon">
                        <input type="text" name="name" autocomplete="off">
                        <div class="logintext" id="name"></div>
                    </div>
                    <div class="inputbox">
                        <img src="image/mail-outline.svg" class="loginicon">
                        <input type="text" name="email" autocomplete="off">
                        <div class="logintext" id="email"></div>
                    </div>
                    <div class="inputbox">
                        <img src="image/lock-closed-outline.svg" class="loginicon">
                        <input type="password" name="password" autocomplete="off">
                        <div class="logintext" id="password"></div>
                    </div>
                    <input type="submit" class="loginbutton" id="signupbutton" value="">
                    <div class="signup">
                        <class id="logintext"></class>
                        <a href="login.php" id="loginlink" class="loginsignupa"></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer" id="footer"></div>
        <script src="js/index.js"></script>
        <script src="js/changelanguage/"></script>
        <script src="js/changelanguage/changelanguage.js"></script>
        <script src="js/changelanguage/changelanguagesignup.js"></script>
    </body>
</html>