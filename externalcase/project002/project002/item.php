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
                <img src="icon/logo.jpg" class="logo">
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="首頁">
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
                <?php
                    $id=$_GET["id"];
                    if($row=query($db,"SELECT*FROM `item` WHERE `id`='$id'")[0]){
                        $imagerow=query($db,"SELECT*FROM `itemimage` WHERE `itemid`='$id'");
                        ?>
                        <div class="carousel">
                            <?php
                                for($i=0;$i<count($imagerow);$i=$i+1){
                                    ?>
                                    <div class="carouselitem">
                                        <img src="<?php echo($imagerow[$i][2]) ?>" class="carouselimage">
                                    </div>
                                    <?php
                                }
                            ?>
                            <div class="carouselbuttondiv">
                                <input type="button" class="carouselbutton prevnext" id="prev" value="prev">
                                <?php
                                    for($i=0;$i<count($imagerow);$i=$i+1){
                                        ?><input type="button" class="carouselbutton indicator" value="<?php echo($i+1) ?>"><?php
                                    }
                                ?>
                                <input type="button" class="carouselbutton prevnext" id="next" value="next">
                            </div>
                        </div>
                        <div class="subject">主題:<?php echo(query($db,"SELECT*FROM `subject` WHERE `id`='$row[1]'")[0][1]); ?></div>
                        <div class="itemcontext">
                            詳細介紹:<br>
                            <?php echo($row[2]); ?>
                        </div>
                        <div class="price">價格: <?php echo($row[3]); ?> TWD</div>
                        <a class="linkline a" href="<?php echo($row[5]); ?>">Line</a>
                        <a class="linkmessenger a" href="<?php echo($row[6]); ?>">Messenger</a>
                        <a class="link8591 a" href="<?php echo($row[7]); ?>">8591</a>
                        <?php
                    }else{ ?><script>alert("查無此商品");location.href="index.php"</script><?php }
                ?>
            </div>
        </div>
        <script src="item.js"></script>
    </body>
</html>