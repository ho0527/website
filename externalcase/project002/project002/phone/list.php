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
                    $row=query($db,"SELECT*FROM `subject` WHERE `id`='$id'")[0];
                ?>
                <div class="listtopgrid" id="<?php echo($row[0]); ?>">
                    <div class="listname"><?php echo($row[1]); ?></div>
                    <div class="listcontext"><?php echo($row[2]); ?></div>
                    <input type="button" class="listupload button" onclick="location.href='login.php'" value="上架商品">
                </div>
                <div class="listleft macossectiondiv">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum harum dolor provident odio eum corporis, ratione alias, doloribus voluptate labore, repellat animi? Molestiae fugiat non doloribus in. Illum, consectetur aliquam.<br>
                </div>
                <div class="listright macossectiondiv">
                    <?php
                        $row=query($db,"SELECT*FROM `item` WHERE `subjectid`='$id'");
                        if(count($row)>0){
                            for($i=0;$i<count($row);$i=$i+1){
                                @$imagerow=query($db,"SELECT*FROM `itemimage` WHERE `itemid`='{$row[$i][0]}'")[0];
                                ?>
                                <div class="item" id="<?php echo($row[$i][0]); ?>">
                                    <?php
                                    if(isset($imagerow)){ ?><img src="<?php echo($imagerow[2]); ?>" class="itemimage"><?php }
                                    ?>
                                </div>
                                <?php
                            }
                        }else{
                            ?><div class="warning">目前無商品</div><?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <script src="list.js"></script>
    </body>
</html>