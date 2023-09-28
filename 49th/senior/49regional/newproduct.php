<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>新增版型</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            // if(!isset($_SESSION["data"])&&$_SESSION["permission"]!="管理者"){ header("location:index.php"); }
        ?>
        <div class="navigationbar">
            <div class="maintitle">電子競技網站管理-選擇版型</div>
            <div class="navigationbarbuttondiv">
                <input type="button" class="navigationbarbutton" onclick="location.href='main.php'" value="首頁">
                <input type="button" class="navigationbarbutton selectbutton" onclick="location.href='productindex.php'" value="電競活動管理精靈">
                <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查尋">
                <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
                <input type="button" class="navigationbarbutton" onclick="location.href='link.php?logout='" value="登出">
            </div>
        </div>
        <div class="productbar">
            <div class="center">
                <input type="button" class="navigationbarbutton" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="navigationbarbutton" onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="navigationbarbutton" onclick="location.href='productpreview.php'" value="預覽">
                <input type="button" class="navigationbarbutton" onclick="location.href='productsumbit.php'" value="確定送出">
                <input type="button" class="navigationbarbutton selectbutton" onclick="location.reload()" value="新增版型">
            </div>
        </div>
        <div class="main">
            <form>
                <h2>新增版型</h2>
                <table class="producttable">
                    <tr>
                        <td class="coffee" id="1">1</td>
                        <td class="coffee" id="2">2</td>
                    </tr>
                    <tr>
                        <td class="coffee" id="3">3</td>
                        <td class="coffee" id="4">4</td>
                    </tr>
                    <tr>
                        <td class="coffee" id="5">5</td>
                        <td class="coffee" id="6">6</td>
                    </tr>
                    <tr>
                        <td class="coffee" id="7">7</td>
                        <td class="coffee" id="8">8</td>
                    </tr>
                    <tr>
                        <td class="coffee" id="9">9</td>
                        <td class="coffee" id="10">10</td>
                    </tr>
                </table><br><br>
                圖片會往下佔2格<br>
                <?php
                    for($i=1;$i<=10;$i=$i+1){
                        ?>
                        <?= $i ?>
                        <select name="s<?= $i ?>" class="select" id="<?= $i ?>">
                            <option value="none">請選擇</option>
                            <option value="picture">圖片</option>
                            <option value="name">電競名稱</option>
                            <option value="date">競賽日期</option>
                            <option value="link">電競活動簡介</option>
                            <option value="intr">活動新聞連結</option>
                            <option value="cost">報名</option>
                        </select>
                        <?php
                    }
                ?><br>
                <input type="button" onclick="location.href='productindex.php'" value="取消">
                <input type="submit" name="submit" value="送出">
            </form>
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
                $picturer="";
                for($i=1;$i<=8;$i++){
                    if($_GET["s".$i]=="picture"){
                        $picture++;
                        $picturer.=$i;
                    }elseif($_GET["s".$i]=="name"){
                        $name++;
                    }elseif($_GET["s".$i]=="link"){
                        $link++;
                    }elseif($_GET["s".$i]=="cost"){
                        $cost++;
                    }elseif($_GET["s".$i]=="date"){
                        $date++;
                    }elseif($_GET["s".$i]=="intr"){
                        $intr++;
                    }else{
                        $none++;
                    }
                }
                if($none==0&&$picture==3&&$name==1&&$link==1&&$cost==1&&$date==1&&$intr==1&&($picturer==("135")||$picturer==("246")||$picturer==("357")||$picturer==("248"))){
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
                    ?><script>alert("輸入錯誤");location.href="newproduct.php"</script><?php
                }
            }
        ?>
        <script src="porduct.js"></script>
        <script src="logincheck.js"></script>
    </body>
</html>