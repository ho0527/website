<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡商品展示系統</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .main{
            width: 75%;
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if($_SESSION["permission"]=="管理者"){
            ?>
            <h1>咖啡商品展示系統</h1>
            <input type="button" class="mainbutton selt" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mainbutton" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查尋">
            <input type="button" class="mainbutton logout" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <table class="producttable">
                    <?php
                        $row=fetchall(query($db,"SELECT*FROM `coffee`"));
                        $product=fetchall(query($db,"SELECT*FROM `product`"));
                        usort($row,function($a,$b){ return $a[0]<$b[0]; });
                        for($i=0;$i<count($row);$i++){
                            ?>
                            <tr>
                                <td class="producttd">
                                    <table class="coffeetable">
                                        <?php
                                        for($j=0;$j<count($product);$j++){
                                            if($row[$i][7]==$product[$j][0]&&$product[$j][1]=="picture"){
                                                ?>
                                                <tr>
                                                    <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="175px"></td>
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
                                                    <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="175px"></td>
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
                                                    <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="175px"></td>
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
                                                    <td class="coffee" rowspan="3"><img src="<?= $row[$i][1] ?>" alt="圖片" width="175px"></td>
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
                                    <input type="button" onclick="location.href='edit.php?pedit=<?= $row[$i][0] ?>'" value="修改">
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
            <input type="button" class="mainbutton selt" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="mainbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="mainbutton" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="mainbutton" onclick="location.href='search.php'" value="查尋">
            <input type="button" class="mainbutton logout" onclick="location.href='link.php?logout='" value="登出">
            <hr>
            <div class="main">
                <table class="producttable">
                    <?php product(fetchall(query($db,"SELECT*FROM `coffee`")),$db); ?>
                </table>
            </div>
            <?php
        }
    ?>
</body>
</html>