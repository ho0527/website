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
        if(!isset($_SESSION["data"])){ header("location:index.php"); }
        if(!isset($_SESSION["val"])){ $_SESSION["val"]=1; }
        function data($p){
            if($p=="name"){
                ?>商品名稱<?php
            }elseif($p=="link"){
                ?>相關連結<?php
            }elseif($p=="cost"){
                ?>費用<?php
            }elseif($p=="time"){
                ?>發佈日期<?php
            }else{
                ?>商品簡介<?php
            }
        }
    ?>
    <h1>咖啡商品展示系統</h1>
    <input type="button" class="but" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="but selt" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
    <hr>
    <form action="">
        <input type="submit" class="but" name="newproduct" value="新增版型">
        <input type="button" class="but selt" onclick="location.href='productindex.php'" value="選擇版型">
        <input type="button" class="but" onclick="check('productinput.php')" value="填寫資料">
        <input type="button" class="but" onclick="check('productperview.php')" value="預覽">
        <input type="button" class="but" onclick="check('productsubmit.php')" value="確定送出"><br><br>
    </form>
    <div class="main">
        <h2>選擇版型</h2>
        <table class="ptable">
            <?php
                $product=fetchall(query($db,"SELECT*FROM `product`"));
                for($j=0;$j<count($product);$j++){
                    ?>
                    <tr>
                        <td>
                            版型<?= $product[$j][0] ?>
                            <table class="ctable" id="<?= $product[$j][0] ?>">
                                <?php
                                    if($product[$j][1]=="picture"){
                                        ?>
                                        <tr>
                                            <td class="coffee" rowspan="3">圖片</td>
                                            <td class="coffee"><?php data($product[$j][2]); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][4]); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][6]); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][7]); ?></td>
                                            <td class="coffee"><?php data($product[$j][8]); ?></td>
                                        </tr>
                                        <?php
                                    }elseif($product[$j][2]=="picture"){
                                        ?>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][1]); ?></td>
                                            <td class="coffee" rowspan="3">圖片</td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][3]); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][5]); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][7]); ?></td>
                                            <td class="coffee"><?php data($product[$j][8]); ?></td>
                                        </tr>
                                        <?php
                                    }elseif($product[$j][3]=="picture"){
                                        ?>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][1]); ?></td>
                                            <td class="coffee"><?php data($product[$j][2]); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee" rowspan="3">圖片</td>
                                            <td class="coffee"><?php data($product[$j][4]); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][6]); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][8]); ?></td>
                                        </tr>
                                        <?php
                                    }elseif($product[$j][4]=="picture"){
                                        ?>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][1]); ?></td>
                                            <td class="coffee"><?php data($product[$j][2]); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][3]); ?></td>
                                            <td class="coffee" rowspan="3">圖片</td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][5]); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="coffee"><?php data($product[$j][7]); ?></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </table><br><br>
                        </td>
                    </tr>
                    <?php
                }
                if(isset($_GET["newproduct"])){
                    $s1=rand(0,7);
                    if($s1==0){
                        query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('time','picture','intr','picture','link','picture','cost','name')");
                    }elseif($s1==1){
                        query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('cost','time','picture','intr','picture','name','picture','link')");
                    }elseif($s1==2){
                        query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('time','name','cost','picture','intr','picture','link','picture')");
                    }elseif($s1==3){
                        query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('picture','intr','picture','time','picture','cost','name','link')");
                    }elseif($s1==4){
                        query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('name','picture','intr','picture','time','picture','link','cost')");
                    }elseif($s1==5){
                        query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('cost','name','picture','time','picture','intr','picture','link')");
                    }elseif($s1==6){
                        query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('link','cost','intr','picture','name','picture','time','picture')");
                    }elseif($s1==7){
                        query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('picture','name','picture','intr','picture','cost','link','time')");
                    }else{
                        query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('cost','name','intr','picture','time','picture','link','picture')");
                    }
                    ?><script>alert("新增成功");location.href="productindex.php"</script><?php
                }
            ?>
        </table>
    </div>
    <script src="product.js"></script>
    <script>
        document.getElementById("<?= $_SESSION["val"] ?>").style.backgroundColor="rgb(255, 255, 175)"
    </script>
</body>
</html>