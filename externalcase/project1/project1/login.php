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
        <div class="form">
            <div class="formbox">
                <form method="POST">
                    <h2 id="loginheader"></h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" name="username" autocomplete="off">
                        <div class="logintext" id="email"></div>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" autocomplete="off">
                        <div class="logintext" id="password"></div>
                    </div>
                    <div class="forget">
                        <div><input type="checkbox"><span id="rememberme"></span></div>
                        <a href="#" id="forgetpassword"></a>
                    </div>
                    <input type="submit" class="loginbutton" id="loginbutton" value="">
                    <div class="signup">
                        <p id="signuptext">
                            <a href="#" id="signuplink"></a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <input type="button" id="switchLangButton" value="切換語言">
        <div class="footer" id="footer"></div>
        <script src="index.js"></script>
        <script src="changelanguage.js"></script>
    </body>
</html>