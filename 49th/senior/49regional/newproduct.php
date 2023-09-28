<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>新增版型</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="../../../plugin/css/chrisplugin.css">
        <script src="../../../plugin/js/chrisplugin.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
        ?>
        <div class="navigationbar">
            <div class="maintitle">電子競技網站管理-新增版型</div>
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
        <div class="main newproductmain">
            <div class="grid newproductgrid">
                <div class="newproductleft newproduct">
                    <div class="list small date" id="date">競賽日期</div>
                    <div class="list mid introduction" id="introduction">電競活動 簡介</div>
                    <div class="list small link" id="link">活動新聞連結</div>
                    <div class="list small signup" id="signup">報名(按鈕)</div>
                </div>
                <div class="newproductright newproduct">
                    <div class="list small name" id="name">電競名稱</div>
                    <div class="list large picture" id="picture">圖片</div>
                </div>
            </div>
            <input type="button" class="button" onclick="location.href='productindex.php'" value="返回">
            <input type="button" class="button" id="submit" value="送出">
        </div>
        <?php
            // if(isset($_GET["submit"])){
            //     $none=0;
            //     $picture=0;
            //     $name=0;
            //     $link=0;
            //     $cost=0;
            //     $date=0;
            //     $intr=0;
            //     $picturer="";
            //     for($i=1;$i<=8;$i++){
            //         if($_GET["s".$i]=="picture"){
            //             $picture++;
            //             $picturer.=$i;
            //         }elseif($_GET["s".$i]=="name"){
            //             $name++;
            //         }elseif($_GET["s".$i]=="link"){
            //             $link++;
            //         }elseif($_GET["s".$i]=="cost"){
            //             $cost++;
            //         }elseif($_GET["s".$i]=="date"){
            //             $date++;
            //         }elseif($_GET["s".$i]=="intr"){
            //             $intr++;
            //         }else{
            //             $none++;
            //         }
            //     }
            //     if($none==0&&$picture==3&&$name==1&&$link==1&&$cost==1&&$date==1&&$intr==1&&($picturer==("135")||$picturer==("246")||$picturer==("357")||$picturer==("248"))){
            //         $s1=$_GET["s1"];
            //         $s2=$_GET["s2"];
            //         $s3=$_GET["s3"];
            //         $s4=$_GET["s4"];
            //         $s5=$_GET["s5"];
            //         $s6=$_GET["s6"];
            //         $s7=$_GET["s7"];
            //         $s8=$_GET["s8"];
            //         query($db,"INSERT INTO `product`(`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`)VALUES('$s1','$s2','$s3','$s4','$s5','$s6','$s7','$s8')");
            //         ?><script>// alert("新增成功");location.href="productindex.php"</script><?php
            //     }else{
            //         ?><script>// alert("輸入錯誤");location.href="newproduct.php"</script><?php
            //     }
            // }
        ?>
        <script src="newproduct.js"></script>
        <script src="logincheck.js"></script>
    </body>
</html>