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
                    <div class="title" id="signupheader"></div>
                    <!-- <div class="inputbox">
                        <img src="image/person-sharp.svg" class="loginicon" draggable="false">
                        <input type="text" name="name" class="loginsignupinput" autocomplete="off">
                        <div class="loginsignuptext">
                            <span id="name"></span>
                            <span class="warning" id="namewarning"></span>
                        </div>
                    </div> -->
                    <div class="inputbox">
                        <img src="image/mail-outline.svg" class="loginicon" draggable="false">
                        <input type="text" name="email" class="loginsignupinput" autocomplete="off">
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
                    <div class="check">
                        <div>
                            <input type="checkbox" class="loginsignupcheckbox">
                            <span id="check"></span>
                            <a href="terms.php" class="a" id="checklink"></a>
                        </div>
                        <a href="#" class="a" id="signupformal"></a>
                    </div>
                    <input type="submit" class="loginbutton" id="signupbutton">
                    <div class="loginsignup">
                        <class id="logintext"></class>
                        <a href="login.php" class="a" id="loginlink"></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer" id="footer"></div>
        <script src="js/index.js"></script>
        <script src="js/changelanguage/changelanguage.js"></script>
        <script src="js/changelanguage/changelanguagesignup.js"></script>
    </body>
</html>