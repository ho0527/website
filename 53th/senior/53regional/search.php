<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>一般會員專區</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="plugin/css/macossection.css">
        <script src="plugin/js/macossection.js"></script>
    </head>
    <body>
        <div class="navigationbardiv">
            <?php
                include("link.php");
                if(!isset($_SESSION["data"])){ header("location:index.php"); }
                if($_SESSION["permission"]=="管理者"){
                    ?>
                    <div class="navigationbar">
                        <div class="navigationbarleft">
                            <div class="navigationbartitle">咖啡商品展示系統-查詢</div>
                        </div>
                        <div class="navigationbarright">
                            <input type="button" class="navigationbarbutton" onclick="location.href='main.php'" value="首頁">
                            <input type="button" class="navigationbarbutton" onclick="location.href='productindex.php'" value="上架商品">
                            <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='search.php'" value="查詢">
                            <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
                            <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="navigationbar">
                        <div class="navigationbarleft">
                            <div class="navigationbartitle">咖啡商品展示系統-查詢</div>
                        </div>
                        <div class="navigationbarright">
                            <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='main.php'" value="首頁">
                            <input type="button" class="navigationbarbutton" value="標題">
                            <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='search.php'" value="查詢">
                            <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div class="searchbar">
            <form>
                <div class="center">
                    價格範圍: <input type="radio" class="radio" name="key" id="numb" value="num">
                    關鍵字: <input type="radio" class="radio" name="key" id="text" value="text">
                </div>
                <div class="radiosearchtext" id="radiosearchtext"></div>
            </form>
        </div>
        <div class="productmain macossectiondiv">
            <?php
            if(isset($_GET["key"])){
                if($_GET["key"]=="num"){
                    $start=$_GET["start"];
                    $end=$_GET["end"];
                    $row=query($db,"SELECT*FROM `coffee` WHERE ?<=`cost`AND`cost`<=?",[$start,$end]);
                }else{
                    $type=$_GET["maintext"];
                    $row=query($db,"SELECT*FROM `coffee` WHERE `name`LIKE?or`introduction`LIKE?or`cost`LIKE?or`date`LIKE?or`link`LIKE?",["%$type%","%$type%","%$type%","%$type%","%$type%"]);
                }
            }else{
                $row=query($db,"SELECT*FROM `coffee`");
            }
            usort($row,function($a,$b){ return $b[0]-$a[0]; });
            $count=0;
            for($i=0;$i<count($row);$i=$i+1){
                $data="productleft";
                if($count%2==0){ ?><div class="productdiv"><?php }
                if($count%2==1){ $data="productright"; }
                $productrow=query($db,"SELECT*FROM `product` WHERE `id`=?",[$row[$i][7]])[0];
                ?>
                <div class="<?php echo($data); ?> product">
                    <div class="name macossectiondiv" style="<?php echo($productrow[1]) ?>">商品名稱: <?php echo($row[$i][2]); ?></div>
                    <div class="cost macossectiondiv" style="<?php echo($productrow[2]) ?>">費用: <?php echo($row[$i][4]); ?></div>
                    <div class="date macossectiondiv" style="<?php echo($productrow[3]) ?>">發布日期: <?php echo($row[$i][5]); ?></div>
                    <div class="link macossectiondiv" style="<?php echo($productrow[4]) ?>">相關連結: <?php echo($row[$i][6]); ?></div>
                    <div class="introduction macossectiondiv" style="<?php echo($productrow[5]) ?>">商品簡介: <?php echo($row[$i][3]); ?></div>
                    <div class="picture macossectiondiv" style="<?php echo($productrow[6]) ?>"><img src="<?php echo($row[$i][1]); ?>" class="img" width="175px"></div>
                </div>
                <?php
                if($count%2==1||count($row)-1==$i){ ?></div><?php }
                $count=$count+1;
            }
            ?>
        </div>
        <script src="usersearch.js"></script>
    </body>
</html>