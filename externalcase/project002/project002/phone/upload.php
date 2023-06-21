<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="../plugin/css/macossection.css">
        <link rel="stylesheet" href="../plugin/css/sort.css">
        <script src="../plugin/js/macossection.js"></script>
        <script src="../plugin/js/sort.js"></script>
        <script src="../upload.js"></script>
    </head>
    <body>
        <?php
            include("../link.php");
            if(!isset($_SESSION["data"])){ header("location:login.php"); }
            $data=$_SESSION["data"];
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="../icon/logo.png" class="logo">
            </div>
            <div class="navigationbarright">
                <img src="../icon/menu-outline.svg" class="menu" id="menubutton" draggable="false">
            </div>
            <div class="menudiv" id="menu">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="貨幣">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="進行">
                <?php
                    if(isset($_SESSION["data"])){
                        ?><input type="button" class="navigationbarbutton" onclick="location.href='../api.php?logout='" value="登出"><?php
                    }else{
                        ?><input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='login.php'" value="登入"><?php
                    }
                ?>
            </div>
        </div>
        <div class="uploadmain">
            <form method="POST" enctype="multipart/form-data">
                價格(只支援正整數) <input type="text" class="input" name="price" placeholder=""><br><br>
                主題(只支援正整數) <select class="select" name="subject">
                    <?php
                        $row=query($db,"SELECT*FROM `subject`");
                        for($i=0;$i<count($row);$i=$i+1){
                            ?><option value="<?php echo($row[$i][0]); ?>"><?php echo($row[$i][1]); ?></option><?php
                        }
                        ?>
                </select><input type="button" onclick="location.href='subject.php'" value="新增主題"><br><br>
                <input type="reset" class="button" onclick="fileclick('file')" value="上傳圖片(可複選)"><br><br>
                <textarea class="textarea" name="context" cols="30" rows="10" placeholder="內文"></textarea><br><br>
                line<br>
                <input type="text" class="input" name="linelink"><br><br>
                messenger<br>
                <input type="text" class="input" name="messenglink"><br><br>
                8591<br>
                <input type="text" class="input" name="8591link"><br><br>
                <input type="reset" class="button" value="清除">
                <input type="submit" class="button" name="submit" value="送出">
                <input type="file" class="file" name="file[]" id="file" accept="image/*" multiple>
            </form>
        </div>
        <?php
            if(isset($_POST["submit"])){
                $price=$_POST["price"];
                $subject=$_POST["subject"];
                $context=$_POST["context"];
                $linkline=$_POST["linelink"];
                $linkmessenger=$_POST["messenglink"];
                $link8591=$_POST["8591link"];
                $count=0;
                if(!preg_match("/^[0-9]+$/",$price)){
                    ?><script>alert("價格有誤(只支援正整數)");location.href="upload.php"</script><?php
                }else{
                    query($db,"INSERT INTO `item`(`subjectid`,`context`,`price`,`imagecount`,`linelink`,`messengerlink`,`8591link`)VALUES(?,?,?,?,?,?,?)",[$subject,$context,$price,count($_FILES["file"]["name"]),$linkline,$linkmessenger,$link8591]);
                    $row=query($db,"SELECT*FROM `item`");
                    $row=$row[count($row)-1][0];
                    echo "\$row ="; print_r($row); echo "<br>";
                    if($_FILES["file"]["name"][0]!=""){
                        for($i=0;$i<count($_FILES["file"]["name"]);$i=$i+1){
                            $fileurl="upload/".$_FILES["file"]["name"][$i];
                            if(file_exists("../".$fileurl)){
                                $j=1;
                                while(file_exists("../".$fileurl)){
                                    $fileurl="upload/".$j."_".$_FILES["file"]["name"][$i];
                                    $j=$j+1;
                                }
                            }
                            move_uploaded_file($_FILES["file"]["tmp_name"][$i],$fileurl);
                            query($db,"INSERT INTO `itemimage`(`itemid`,`imageurl`)VALUES('$row',?)",[$fileurl]);
                        }
                    }
                    query($db,"INSERT INTO `log`(`username`,`move`,`movetime`)VALUES(?,'新增商品成功','$time')",[$data]);
                    ?><script>alert("新增成功");location.href="item.php?id=<?php echo($row); ?>"</script><?php
                }
            }
        ?>
        <script src="menu.js"></script>
    </body>
</html>