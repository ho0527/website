<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:login.php"); }
            $data=$_SESSION["data"];
        ?>
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="icon/logo.png" class="logo">
            </div>
            <div class="navigationbarright">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="首頁">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="貨幣">
                <input type="button" class="navigationbarbutton" onclick="location.href='index.php'" value="進行">
                <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
            </div>
        </div>
        <div class="loginmain">
            <form method="POST" enctype="multipart/form-data">
                <div class="right">
                    價格: <input type="text" class="input" name="price" placeholder="只支援正整數"><br><br>
                    主題: <select name="subject">
                        <?php
                            $row=query($db,"SELECT*FROM `subject`");
                            for($i=0;$i<count($row);$i=$i+1){
                                ?><option value="<?php echo($row[$i][0]); ?>"><?php echo($row[$i][1]); ?></option><?php
                            }
                            ?>
                    </select><br><br>
                    圖片(可複選): <input type="file" name="file[]" accept="image/*" multiple><br><br>
                    內文: <textarea name="context" cols="30" rows="10"></textarea><br><br>
                </div>
                <div class="left">
                    line: <input type="text" class="input" name="linelink"><br><br>
                    messenger: <input type="text" class="input" name="messenglink"><br><br>
                    8591: <input type="text" class="input" name="8591link"><br><br>
                    <input type="reset" class="button" value="清除">
                    <input type="submit" class="button" name="submit" value="送出">
                </div>
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
                    query($db,"INSERT INTO `item`(`subjectid`,`context`,`imagecount`,`linelink`,`messengerlink`,`8591link`)VALUES(?,?,?,?,?,?)",[$subject,$context,count($_FILES["file"]["name"]),$linkline,$linkmessenger,$link8591]);
                    $row=query($db,"SELECT*FROM `item`");
                    $row=$row[count($row)-1][0];
                    echo "\$row ="; print_r($row); echo "<br>";
                    if($_FILES["file"]["name"][0]!=""){
                        for($i=0;$i<count($_FILES["file"]["name"]);$i=$i+1){
                            $fileurl="upload/".$_FILES["file"]["name"][$i];
                            if(file_exists($fileurl)){
                                $j=1;
                                while(file_exists($fileurl)){
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
    </body>
</html>