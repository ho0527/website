<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TaskD</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <script src="plugin/js/macossection.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
            if(isset($_SESSION["data"])){
                $data=$_SESSION["data"];
                $row=query($db,"SELECT*fROM `user` WHERE `id`='$data'")[0];
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft" id="user">
                        <img src="<?php echo($row[1]) ?>" class="slefimage">
                        <div class="nickname"><?php echo($row[3]) ?></div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
                    </div>
                </div>
                <div class="mainmain">
                    <input type="button" class="button" id="newpost" value="新增貼文">
                    <div class="postmain macossectiondiv">
                        <?php
                        $row=query($db,"SELECT*FROM `post` WHERE `permission`='public'");
                        for($i=0;$i<count($row);$i=$i+1){
                            $postid=$row[$i][0];
                            $userid=$row[$i][1];
                            $userrow=query($db,"SELECT*FROM `user` WHERE `id`='$userid'")[0];
                            ?>
                            <div class="grid">
                                <div class="postuser" id="postuser<?php echo($userrow[0]) ?>">
                                    <img src="<?php echo($userrow[1]) ?>" class="slefimage" draggable="false">
                                    <div class="nickname"><?php echo($userrow[3]) ?></div>
                                </div>
                                <div class="posttime">
                                    發布時間:<?php echo($row[$i][6]) ?>
                                </div>
                                <div class="postpermission">
                                    權限:<?php echo($row[$i][4]) ?>
                                </div>
                                <div class="postcontext" colspan="3">
                                    <?php echo($row[$i][3]) ?>
                                </div>
                                <div class="postimage macossectiondiv" colspan="3">
                                    <?php
                                        $imagerow=query($db,"SELECT*FROM `postimage` WHERE `postid`='$postid'");
                                        for($j=0;$j<count($imagerow);$j=$j+1){
                                            ?><img src="<?php echo($imagerow[$j][2]) ?>" class="image"><?php
                                        }
                                    ?>
                                </div>
                                <div class="postsave">
                                    <?php
                                        if(!query($db,"SELECT*FROM `postfollow` WHERE `postid`='$postid'AND`user`='$data'")){
                                            ?><img src="icon/pricetag-outline.svg" class="icon save" data-id="<?php echo($postid) ?>" draggable="false"><?php
                                        }else{
                                            ?><img src="icon/pricetag.svg" class="icon" data-id="<?php echo($postid) ?>" draggable="false"><?php
                                        }
                                        ?>
                                </div>
                                <div class="postcomment">
                                    <img src="icon/chatbox-ellipses.svg" class="icon comment" draggable="false">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }else{
                ?>
                <div class="navigationbar">
                    <div class="navigationbarleft" id="user">
                        <div class="nickname">未登入</div>
                    </div>
                    <div class="navigationbarright">
                        <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="登入">
                    </div>
                </div>
                <?php
            }
        ?>
        <script src="main.js"></script>
    </body>
</html>