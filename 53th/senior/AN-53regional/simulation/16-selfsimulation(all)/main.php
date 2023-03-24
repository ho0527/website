<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>咖啡商品展示系統</title>
        <link rel="stylesheet" href="index.css">
        <style>
            .main{
                width: 75%;
                height: 650px;
                max-height: 650px;
                overflow-y: auto;
            }
            table{
                width: 90%;
            }
        </style>
    </head>
    <body>
        <?php
            include("link.php");
            function data($row,$i,$p){
                if($p=="name"){
                    ?>商品名稱 <?= $row[$i][2] ?><?php
                }elseif($p=="cost"){
                    ?>費用 <?= $row[$i][3] ?><?php
                }elseif($p=="link"){
                    ?>相關連結 <?= $row[$i][4] ?><?php
                }elseif($p=="time"){
                    ?>發佈日期 <?= $row[$i][5] ?><?php
                }else{
                    ?>商品簡介 <?= $row[$i][6] ?><?php
                }
            }
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
            unset($_SESSION["pedit"]);
            if($_SESSION["permission"]=="管理者"){
                ?>
                <h1>咖啡商品展示系統</h1> 
                <input type="button" class="but selt" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="but" onclick="location.href='productindex.php'" value="上架商品">
                <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
                <hr>
                <div class="main">
                    <div>
                        <form action="">
                            價格範圍: <input type="number" name="start" value="-100000">~
                            <input type="number" name="end" value="100000">
                            <input type="submit" name="num" value="查尋">
                        </form>
                        <form action="">
                            關鍵字: <input type="text" name="text" id="">
                            <input type="submit" name="tex" value="查尋">
                        </form>
                    </div><br>
                    <table class="ptable">
                        <?php
                            if(isset($_GET["num"])){
                                $start=$_GET["start"];
                                $end=$_GET["end"];
                                $row=fetchall(query($db,"SELECT*FROM `coffee` WHERE `$start`<=`cost`AND`cost`<='$end'"));
                            }elseif(isset($_GET["tex"])){
                                $type=$_GET["text"];
                                $row=fetchall(query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$type%'or`time`LIKE'%$type%'or`cost`LIKE'%$type%'or`link`LIKE'%$type%'or`intr`LIKE'%$type%'"));
                            }else{
                                $row=fetchall(query($db,"SELECT*FROM `coffee`"));
                            }
                            usort($row,function($a,$b){ return $a[5]<$b[5]; });
                            $product=fetchall(query($db,"SELECT*FROM `product`"));
                            for($i=0;$i<count($row);$i++){
                                ?>
                                <tr>
                                    <td>
                                        <table>
                                            <?php
                                            for($j=0;$j<count($product);$j++){
                                                if($row[$i][7]==$product[$j][0]&&$product[$j][1]=="picture"){
                                                    ?>
                                                    <tr>
                                                        <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][2]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][4]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][6]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][7]) ?></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][8]) ?></td>
                                                    </tr>
                                                    <?php
                                                }elseif($row[$i][7]==$product[$j][0]&&$product[$j][2]=="picture"){
                                                    ?>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][1]) ?></td>
                                                        <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][3]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][5]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][7]) ?></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][8]) ?></td>
                                                    </tr>
                                                    <?php
                                                }elseif($row[$i][7]==$product[$j][0]&&$product[$j][3]=="picture"){
                                                    ?>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][1]) ?></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][2]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][4]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][6]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][8]) ?></td>
                                                    </tr>
                                                    <?php
                                                }elseif($row[$i][7]==$product[$j][0]&&$product[$j][4]=="picture"){
                                                    ?>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][1]) ?></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][2]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][3]) ?></td>
                                                        <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][5]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][7]) ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </table>
                                        <input type="button" class="but" onclick="location.href='edit.php?pedit=<?= $row[$i][0] ?>'" value="修改"><br><br>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </table>
                </div>
                <?php
            }else{
                ?>
                <h1>咖啡商品展示系統</h1> 
                <input type="button" class="but selt" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="but" onclick="" value="上架商品">
                <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
                <hr>
                <div class="main">
                    <div>
                        <form action="">
                            價格範圍: <input type="number" name="start" value="-100000">~
                            <input type="number" name="end" value="100000">
                            <input type="submit" name="num" value="查尋">
                        </form>
                        <form action="">
                            關鍵字: <input type="text" name="text" id="">
                            <input type="submit" name="tex" value="查尋">
                        </form>
                    </div><br>
                    <table class="ptable">
                        <?php
                            if(isset($_GET["num"])){
                                $start=$_GET["start"];
                                $end=$_GET["end"];
                                $row=query($db,"SELECT*FROM `coffee` WHERE `$start`<=`cost`AND`cost`<='$end'");
                            }elseif(isset($_GET["tex"])){
                                $type=$_GET["text"];
                                $row=query($db,"SELECT*FROM `coffee` WHERE `name`LIKE'%$type%'or`time`LIKE'%$type%'or`cost`LIKE'%$type%'or`link`LIKE'%$type%'or`intr`LIKE'%$type%'");
                            }else{
                                $row=query($db,"SELECT*FROM `coffee`");
                            }
                            usort($row,function($a,$b){ return $a[5]<$b[5]; });
                            $product=fetchall(query($db,"SELECT*FROM `product`"));
                            for($i=0;$i<count($row);$i++){
                                ?>
                                <tr>
                                    <td>
                                        <table>
                                            <?php
                                            for($j=0;$j<count($product);$j++){
                                                if($row[$i][7]==$product[$j][0]&&$product[$j][1]=="picture"){
                                                    ?>
                                                    <tr>
                                                        <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][2]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][4]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][6]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][7]) ?></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][8]) ?></td>
                                                    </tr>
                                                    <?php
                                                }elseif($row[$i][7]==$product[$j][0]&&$product[$j][2]=="picture"){
                                                    ?>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][1]) ?></td>
                                                        <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][3]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][5]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][7]) ?></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][8]) ?></td>
                                                    </tr>
                                                    <?php
                                                }elseif($row[$i][7]==$product[$j][0]&&$product[$j][3]=="picture"){
                                                    ?>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][1]) ?></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][2]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][4]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][6]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][8]) ?></td>
                                                    </tr>
                                                    <?php
                                                }elseif($row[$i][7]==$product[$j][0]&&$product[$j][4]=="picture"){
                                                    ?>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][1]) ?></td>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][2]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][3]) ?></td>
                                                        <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="200px" height="175px"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][5]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="coffee"><?php data($row,$i,$product[$j][7]) ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </table><br><br>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </table>
                </div>
                <?php
            }
        ?>
    </body>
</html>