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
        table{
            margin: 0px auto;
            width: 55%;
        }
        td{
            border: 1px black solid;
            width: 50%;
        }
    </style>
</head>
<body>
    <?php
        include("link.php");
        if(!isset($_SESSION["data"])||$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
    ?>
    <h1>網站前台登入頁面</h1>
    <input type="button" class="mbutton" onclick="location.href='main.php'" value="首頁">
    <input type="button" class="mbutton selt" onclick="location.href='productindex.php'" value="上架商品">
    <input type="button" class="mbutton" onclick="location.href='admin.php'" value="會員管理">
    <input type="button" class="mbutton logout" onclick="location.href='link.php?logout='" value="登出">
    <hr>
    <input type="button" class="mbutton selt" onclick="location.href='productindex.php'" value="選擇版型">
    <input type="button" class="mbutton" onclick="location.href='productinput.php'" value="填寫資料">
    <input type="button" class="mbutton" onclick="location.href='productperview.php'" value="預覽">
    <input type="button" class="mbutton" onclick="location.href='productsubmit.php'" value="確定送出"><br><br>
    <div class="main">
        <table>
            <tr>
                <td id="1">1</td>
                <td id="2">2</td>
            </tr>
            <tr>
                <td id="3">3</td>
                <td id="4">4</td>
            </tr>
            <tr>
                <td id="5">5</td>
                <td id="6">6</td>
            </tr>
            <tr>
                <td id="7">7</td>
                <td id="8">8</td>
            </tr>
        </table><br><br>
        <div>
            <form action="">
                <?php
                    for($i=1;$i<=8;$i++){
                        echo($i);
                        ?>
                        <select name="s<?= $i ?>" id="s<?= $i ?>" class="select">
                            <option value="none">請選擇</option>
                            <option value="picture">圖片</option>
                            <option value="name">商品名稱</option>
                            <option value="link">相關連結</option>
                            <option value="cost">費用</option>
                            <option value="date">發佈日期</option>
                            <option value="intr">商品簡介</option>
                        </select>
                        <?php
                    }
                ?>
                <input type="submit" name="submit" value="送出">
            </form>
        </div>
    </div>
    <?php
        if(isset($_GET["submit"])){
            $none=0;
            $picture=0;
            $name=0;
            $link=0;
            $cost=0;
            $date=0;
            $intr=0;
            $picturei="";
            for($i=1;$i<=8;$i++){
                if($_GET["s".$i]=="picture"){
                    $picture++;
                    $picturei.=$i;
                }elseif($_GET["s".$i]=="name"){
                    $name++;
                }elseif($_GET["s".$i]=="link"){
                    $link++;
                }elseif($_GET["s".$i]=="cost"){
                    $cost++;
                }elseif($_GET["s".$i]=="intr"){
                    $intr++;
                }elseif($_GET["s".$i]=="date"){
                    $date++;
                }else{
                    $none++;
                }
            }
            if($none==0&&$name==1&&$link==1&&$cost==1&&$date==1&&$intr==1&&($picturei=="135"||$picturei=="246"||$picturei=="357"||$picturei=="468")){
                $s1=$_GET["s1"];
                $s2=$_GET["s2"];
                $s3=$_GET["s3"];
                $s4=$_GET["s4"];
                $s5=$_GET["s5"];
                $s6=$_GET["s6"];
                $s7=$_GET["s7"];
                $s8=$_GET["s8"];
                query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('$s1','$s2','$s3','$s4','$s5','$s6','$s7','$s8')");
                ?><script>alert("新增成功");location.href="productindex.php"</script><?php
            }else{
                ?><script>alert("資料填寫錯誤");location.href="newproduct.php"</script><?php
            }
        }
        if(isset($_GET["val"])){
            if($_GET["val"]=="no"){
                if(!isset($_SESSION["val"])){
                    $_SESSION["val"]="1";
                }
            }else{
                $_SESSION["val"]=$_GET["val"];
            }
            ?><script>location.href="newproduct.php"</script><?php
        }else{
            if(!isset($_SESSION["val"])){
                $_SESSION["val"]="1";
                ?><script>location.href="newproduct.php"</script><?php
            }
        }
    ?>
    <script src="product.js"></script>
</body>
</html>