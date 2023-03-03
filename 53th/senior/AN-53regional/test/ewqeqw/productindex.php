<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="header">
        <form class="headerform">
            咖啡商品展示系統-選擇版型
            <input type="button" class="hbutton" onclick="location.href='signupedit.php'" value="新增">
            <input type="button" class="hbutton selectbut" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="hbutton" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="hbutton" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
            <input type="submit" class="hbutton" name="logout" value="登出">
        </form>
    </div>
    <div class="pbar">
        <div class="pber2">
            <input type="button" class="pbut" id="index" onclick="" value="選擇版型">
            <input type="button" class="pbut" id="input" onclick="" value="填寫資料">
            <input type="button" class="pbut" id="perview" onclick="" value="預覽">
            <input type="button" class="pbut" id="submit" onclick="" value="確定送出">
            <div style="float:right">
               <button onclick="location.href='newproduct.php'">新增版型</button>
            </div>
        </div>
    </div>
    <div id="indexdiv">
        <?php
            include("link.php");
            $a=fetchall(query($db,"SELECT*FROM `product`"));
            function ifadta2($a,$i,$data){
                if($a[$i][$data]=="name"){
                    ?>商品名稱:<?php
                }elseif($a[$i][$data]=="cost"){
                    ?>金額:0000<?php
                }elseif($a[$i][$data]=="date"){
                    ?>發佈日期:<?php
                }elseif($a[$i][$data]=="link"){
                    ?>相關連結:<?php
                }else{
                    ?>商品簡介:<?php
                }
            }
            for($i=0;$i<count($a);$i=$i+1){
                ?>
                <table class="maintable" id="version<?= $i+1 ?>">
                    <tr>
                        <td class="producttd">
                        <?php
                            if($a[$i][1]=="picture"){
                                ?>
                                <table class="show">
                                    <tr>
                                        <td class="coffeedata" rowspan="3">圖片</td>
                                        <td class="coffeedata"><?= ifadta2($a,$i,2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeedata"><?= ifadta2($a,$i,4) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeedata"><?= ifadta2($a,$i,6) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeedata"><?= ifadta2($a,$i,7) ?></td>
                                        <td class="coffeedata"><?= ifadta2($a,$i,8) ?></td>
                                    </tr>
                                </table>
                                <?php
                            }elseif($a[$i][2]=="picture"){
                                ?>
                                <table class="show">
                                    <tr>
                                    <td class="coffeedata"><?= ifadta2($a,$i,1) ?></td>
                                    <td class="coffeedata" rowspan="3">圖片</td>
                                    </tr>
                                    <tr>
                                    <td class="coffeedata"><?= ifadta2($a,$i,3) ?></td>
                                    </tr>
                                    <tr>
                                    <td class="coffeedata"><?= ifadta2($a,$i,5) ?></td>
                                    </tr>
                                    <tr>
                                    <td class="coffeedata"><?= ifadta2($a,$i,7) ?></td>
                                    <td class="coffeedata"><?= ifadta2($a,$i,8) ?></td>
                                    </tr>
                                </table>
                                <?php
                            }elseif($a[$i][3]=="picture"){
                                ?>
                                <table class="show">
                                    <tr>
                                    <td class="coffeedata"><?= ifadta2($a,$i,1) ?></td>
                                    <td class="coffeedata"><?= ifadta2($a,$i,2) ?></td>
                                    </tr>
                                    <tr>
                                    <td class="coffeedata" rowspan="3">圖片</td>
                                    <td class="coffeedata"><?= ifadta2($a,$i,4) ?></td>
                                    </tr>
                                    <tr>
                                    <td class="coffeedata"><?= ifadta2($a,$i,6) ?></td>
                                    </tr>
                                    <tr>
                                    <td class="coffeedata"><?= ifadta2($a,$i,8) ?></td>
                                    </tr>
                                </table>
                                <?php
                            }else{
                                ?>
                                <table class="show">
                                    <tr>
                                    <td class="coffeedata"><?= ifadta2($a,$i,1) ?></td>
                                    <td class="coffeedata"><?= ifadta2($a,$i,2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeedata"><?= ifadta2($a,$i,3) ?></td>
                                        <td class="coffeedata" rowspan="3">圖片</td>
                                    </tr>
                                    <tr>
                                        <td class="coffeedata"><?= ifadta2($a,$i,5) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="coffeedata"><?= ifadta2($a,$i,7) ?></td>
                                    </tr>
                                </table>
                                <?php
                            }
                        ?>
                        </td>
                    </tr>
                    <div class="thisdiv">這是版型<?= $i+1 ?></div>
                </table>
            <?php
            }
        ?>
    </div>
    <div id="inputdiv">
        <div class="productinput">
            <form id="form" action="productinput.php" method="POST" enctype="multipart/form-data">
                商品名稱: <input type="text" class="input" name="name" value="<?= @$_SESSION["name"] ?>"><br>
                費用: <input type="number" class="input" name="cost" placeholder="只能是數字" value="<?= @$_SESSION["cost"] ?>"><br>
                相關連結: <input type="text" class="input" name="link" value="<?= @$_SESSION["link"] ?>"><br>
                <textarea name="introduction" cols="30" rows="4" placeholder="商品簡介"><?= @$_SESSION["introduction"] ?></textarea><br>
                <input type="file" name="picture" accept="image/*" ><br>
                <input type="button" onclick="location.href='productinput.php?clear='" class="button" value="重設">
                <input type="submit" class="button" name="submit" value="完成"><br>
            </form>
        </div>
    </div>
    <div id="perviewdiv"></div>
    <div id="submitdiv"></div>

    <?php
        function clear(){
            unset($_SESSION["name"]);
            unset($_SESSION["introduction"]);
            unset($_SESSION["cost"]);
            unset($_SESSION["link"]);
            unset($_SESSION["val"]);
            unset($_SESSION["picture"]);
            header("location:productindex.php");
        }
        if(isset($_POST["submit"])){
            @$_SESSION["name"]=$_POST["name"];
            @$_SESSION["introduction"]=$_POST["introduction"];
            @$_SESSION["cost"]=$_POST["cost"];
            @$_SESSION["link"]=$_POST["link"];
            if($_SESSION["name"]==""){
                ?><script>alert("請輸入商品!");location.href="productinput.php"</script><?php
            }else{
                if(!empty($_FILES["picture"]["name"])){
                    move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
                    $_SESSION["picture"]="image/".$_FILES["picture"]["name"];
                }
                header("location:productindex.php");
            }
        }
        if(isset($_GET["clear"])){
            clear();
        }
        if(isset($_GET["val"])){
            $_SESSION["val"]=$_GET["val"];
        }
    ?>
    <script src="product.js"></script>
</body>
</html>