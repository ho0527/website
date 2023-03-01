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
                <form method="POST" class="formform">
                    <div class="title" id="loginheader"></div>
                    <div class="inputbox">
                        <img src="image/mail-outline.svg" class="loginicon" draggable="false">
                        <input type="text" name="username" class="loginsignupinput" autocomplete="off">
                        <div class="loginsignuptext">
                            <span id="email"></span>
                            <span class="warning" id="emailwarning"></span>
                        </div>
                    </div>
                    <div class="inputbox">
                        <img src="image/lock-closed-outline.svg" class="loginicon" draggable="false">
                        <input type="password" name="password" class="loginsignupinput" autocomplete="off">
                        <div class="loginsignuptext">
                            <span id="password"></span>
                            <span class="warning" id="passwordwarning"></span>
                        </div>
                    </div>
                    <div class="forget">
                        <div><input type="checkbox" class="loginsignupcheckbox"><span id="rememberme"></span></div>
                        <a href="#" class="a" id="forgetpassword"></a>
                    </div>
                    <input type="submit" class="loginbutton" id="loginbutton" value="">
                    <div class="loginsignup">
                        <class id="signuptext"></class>
                        <a href="signup.php" class="a" id="signuplink"></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer" id="footer"></div>
        <script src="js/index.js"></script>
        <script src="js/changelanguage/changelanguage.js"></script>
        <script src="js/changelanguage/changelanguagelogin.js"></script>
    </body>
</html>