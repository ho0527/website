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
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
    ?>
    <h1>咖啡商品展示系統</h1>
    <input type="button" class="but" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="but selt" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="but" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="but" onclick="location.href='link.php?logout='" value="登出">
    <hr>
    <input type="button" class="but selt" onclick="location.href='productindex.php'" value="選擇版型">
    <input type="button" class="but" onclick="location.href='productinput.php'" value="新增版型">
    <input type="button" class="but" onclick="location.href='productperview.php'" value="預覽">
    <input type="button" class="but" onclick="location.href='productsubmit.php'" value="確定送出">
    <input type="button" class="but" onclick="location.href='productindex.php?clear='" value="取消">
    <br><br>
    <div class="main">
        <h2>新增版型</h2>
        <form action="">
            <table class="prodcttable">
                <tr>
                    <td class="ntd">1</td>
                    <td class="ntd">2</td>
                </tr>
                <tr>
                    <td class="ntd">3</td>
                    <td class="ntd">4</td>
                </tr>
                <tr>
                    <td class="ntd">5</td>
                    <td class="ntd">6</td>
                </tr>
                <tr>
                    <td class="ntd">7</td>
                    <td class="ntd">8</td>
                </tr>
            </table>
            <p>圖片會往下佔2格</p>
            <?php
                for($i=1;$i<=8;$i++){
                    ?>
                    <select name="s<?= $i ?>" id="<?= $i ?>" class="select">
                        <option value="none">請選擇</option>
                        <option value="picture">圖片</option>
                        <option value="name">商品名稱</option>
                        <option value="intr">商品簡介</option>
                        <option value="date">發佈日期</option>
                        <option value="cost">費用</option>
                        <option value="link">相關連結</option>
                    </select>
                    <?php
                }
            ?>
            <input type="button" class="but" onclick="location.href='productindex.php'" value="返回">
            <input type="submit" class="but" name="submit" value="送出">
        </form>
    </div>
    <?php
        if(isset($_GET["submit"])){
            $none=0;
            $picture=0;
            $name=0;
            $intr=0;
            $date=0;
            $cost=0;
            $link=0;
            $pr="";
            for($i=1;$i<=8;$i++){
                if($_GET["s".$i]=="name"){
                    $name++;
                }elseif($_GET["s".$i]=="picture"){
                    $picture++;
                    $pr=$pr.$i;
                }elseif($_GET["s".$i]=="intr"){
                    $intr++;
                }elseif($_GET["s".$i]=="date"){
                    $date++;
                }elseif($_GET["s".$i]=="cost"){
                    $cost++;
                }elseif($_GET["s".$i]=="link"){
                    $link++;
                }else{
                    $none++;
                }
            }
            if($name==1&&$intr==1&&$date==1&&$cost==1&&$link==1&&$picture==3&&$none==0&&($pr="135"||$pr="246"||$pr="357"||$pr="468")){
                $s1=$_GET["s1"];
                $s2=$_GET["s2"];
                $s3=$_GET["s3"];
                $s4=$_GET["s4"];
                $s5=$_GET["s5"];
                $s6=$_GET["s6"];
                $s7=$_GET["s7"];
                $s8=$_GET["s8"];
                query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('$s1','$s2','$s3','$s4','$s5','$s6','$s7','$s8')");
                ?><script>alert("上傳成功");location.href="productindex.php"</script><?php
            }else{
                ?><script>alert("格式錯誤");location.href="newproduct.php"</script><?php
            }
        }
    ?>
    <script src="product.js"></script>
</body>
</html>