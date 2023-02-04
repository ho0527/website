<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>編輯問卷</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            $title=$_SESSION["title"];
            $num=$_SESSION["num"];
        ?>
        <div class="div">
            <div class="formtitle">編輯問卷</div><br>
        </div>
        <div class="div">
            <div class="mainform">
                標題 <input type="text" class="formtext" value="<?= $title ?>">
            </div>
        </div>
        <?php
            for($i=0;$i<$num;$i=$i+1){
                ?>
                <div class="div">
                    <div class="newform">
                    </div>
                </div>
                <?php
            }
        ?>
    </body>
</html>