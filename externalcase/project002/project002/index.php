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
                <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='index.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="貨幣">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="進行">
                <?php
                    if(isset($_SESSION["data"])){
                        ?><input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出"><?php
                    }else{
                        ?><input type="button" class="navigationbarbutton" onclick="location.href='login.php'" value="登入"><?php
                    }
                ?>
            </div>
        </div>
        <div class="main">
            <div class="grid">
                <div class="mainleft macossectiondiv">
                    <?php
                        $row=query($db,"SELECT*FROM `subject`");
                        for($i=0;$i<count($row);$i=$i+1){
                            ?>
                            <div class="mainleftgrid" id="<?php echo($row[$i][0]); ?>">
                                <div class="mainleftleft"><?php echo($row[$i][1]); ?></div>
                                <div class="mainleftright"><?php echo($row[$i][2]); ?></div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
                <div class="mainright">
                    <div class="mainrightgrid">
                        <img src="icon/image-01.jpg" class="mainimage"><br>
                        <div class="context">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque aliquam officiis modi eaque nisi voluptates incidunt eos architecto inventore beatae non doloribus ab tempora animi eligendi officia, quos dolore. Obcaecati!</div><br>
                        <div class="indexbuttondiv">
                            <a class="a" href="">Line</a>
                            <a class="a" href="">Messenger</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="index.js"></script>
        <script src="windowsize.js"></script>
    </body>
</html>