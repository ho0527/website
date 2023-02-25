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
        <input type="button" id="switchlanguagebutton" value="切換語言">
        <div class="form">
            <div class="formbox">
                <form method="POST">
                    <h2 id="loginheader"></h2>
                    <div class="inputbox">
                        <img src="image/mail-outline.svg" class="loginicon">
                        <input type="text" name="username" autocomplete="off">
                        <div class="logintext" id="email"></div>
                    </div>
                    <div class="inputbox">
                        <img src="image/lock-closed-outline.svg" class="loginicon">
                        <input type="password" name="password" autocomplete="off">
                        <div class="logintext" id="password"></div>
                    </div>
                    <div class="forget">
                        <div><input type="checkbox" class="remembermecheckbox"><span id="rememberme"></span></div>
                        <a href="#" class="loginsignupa" id="forgetpassword"></a>
                    </div>
                    <input type="submit" class="loginbutton" id="loginbutton" value="">
                    <div class="signup">
                        <class id="signuptext"></class>
                        <a href="signup.php" id="signuplink" class="loginsignupa"></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer" id="footer"></div>
        <script src="js/index.js"></script>
        <script src="js/changelanguage/"></script>
        <script src="js/changelanguage/changelanguage.js"></script>
        <script src="js/changelanguage/changelanguagelogin.js"></script>
    </body>
</html>