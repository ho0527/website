<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <link rel="stylesheet" href="plugin/css/sort.css">
        <script src="plugin/js/macossection.js"></script>
        <script src="plugin/js/sort.js"></script>
    </head>
    <body>
        <?php include("link.php"); ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="icon/logo.png" class="logo">
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="貨幣">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="進行">
                <?php
                    if(isset($_SESSION["login"])){
                        ?><input type="button" class="navigationbarbutton" onclick="location.href='login.php'" value="登出"><?php
                    }else{
                        ?><input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登入"><?php
                    }
                ?>
            </div>
        </div>
        <div class="main">
            <div class="grid">
                <div class="mainleft macossectiondiv">
                    <div class="mainleftgrid" id="1">
                        <div class="mainleftleft"></div>
                        <div class="mainleftright"></div>
                    </div>
                    <div class="mainleftgrid">
                        <div class="mainleftleft"></div>
                        <div class="mainleftright"></div>
                    </div>
                    <div class="mainleftgrid">
                        <div class="mainleftleft"></div>
                        <div class="mainleftright"></div>
                    </div>
                    <div class="mainleftgrid">
                        <div class="mainleftleft"></div>
                        <div class="mainleftright"></div>
                    </div>
                    <div class="mainleftgrid">
                        <div class="mainleftleft"></div>
                        <div class="mainleftright"></div>
                    </div>
                </div>
                <div class="mainright">
                    <div class="mainrightgrid">
                        <img src="" class="mainimage"><br>
                        <div class="context"></div><br>
                        <input type="button" class="button" onclick="location.href='index.php'" value="line">
                        <input type="button" class="button" onclick="location.href='index.php'" value="message">
                    </div>
                </div>
            </div>
        </div>
        <script src="index.js"></script>
    </body>
</html>