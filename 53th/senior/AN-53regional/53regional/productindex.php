<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>管理者專區</title>
      <link href="index.css" rel="stylesheet">
   </head>
   <body>
      <div class="navigationbar">
         <form class="navigationbardiv">
            咖啡商品展示系統-選擇版型
            <input type="button" class="adminbutton" onclick="location.href='signupedit.php'" value="新增">
            <input type="button" class="adminbutton" onclick="location.href='main.php'" value="首頁">
            <input type="button" class="adminbutton selectbut" onclick="location.href='productindex.php'" value="上架商品">
            <input type="button" class="adminbutton" onclick="location.href='search.php'" value="查詢">
            <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
            <input type="submit" class="adminbutton" name="logout" value="登出">
         </form>
      </div>
      <div class="productbar">
         <div class="productbardiv">
            <input type="button" class="productbutton selectbut" onclick="location.href='productindex.php'" value="選擇版型">
            <input type="button" class="productbutton" onclick="data()" value="填寫資料">
            <input type="button" class="productbutton" onclick="location.href='productpreview.php'" value="預覽">
            <input type="button" class="productbutton" onclick="nono()" value="確定送出">
            <div style="float:right">
               <button onclick="location.href='newproduct.php'">新增版型</button>
            </div>
         </div>
      </div>
      <?php
            include("link.php");
            $a=fetchall(query($db,"SELECT*FROM `product`"));
            $product=fetchall(query($db,"SELECT*FROM `product`"));
            for($i=0;$i<count($a)-1;$i=$i+1){
               for($j=0;$j<count($a)-$i-1;$j=$j+1){
                  if($a[$j][0]<$a[$j+1][0]){
                     $tamp=$a[$j];
                     $a[$j]=$a[$j+1];
                     $a[$j+1]=$tamp;
                  }
               }
            }
            for($i=0;$i<count($a);$i=$i+1){
               ?>
               <table class="maintable" id="version<?= $i+1 ?>">
                  <tr>
                     <td class="producttd">
                        <?php
                           if($product[$i][1]=="picture"){
                              ?>
                              <table class="show">
                                 <tr>
                                    <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,2) ?></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,4) ?></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,6) ?></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,7) ?></td>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,8) ?></td>
                                 </tr>
                              </table>
                              <?php
                           }elseif($product[$j][2]=="picture"){
                              ?>
                              <table class="show">
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,1) ?></td>
                                    <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,3) ?></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,5) ?></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,7) ?></td>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,8) ?></td>
                                 </tr>
                              </table>
                              <?php
                           }elseif($product[$j][3]=="picture"){
                              ?>
                              <table class="show">
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,1) ?></td>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,2) ?></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,4) ?></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,6) ?></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,8) ?></td>
                                 </tr>
                              </table>
                              <?php
                           }else{
                              ?>
                              <table class="show">
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,1) ?></td>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,2) ?></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,3) ?></td>
                                    <td class="coffeedata" rowspan="3"><img src="<?= @$a[$i][1] ?>" width="175px" alt="圖片"></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,5) ?></td>
                                 </tr>
                                 <tr>
                                    <td class="coffeedata"><?= ifdata($a,$i,$product,$j,7) ?></td>
                                 </tr>
                              </table>
                              <?php
                           }
                        ?>
                     </td>
                  </tr>
               </table>
            <?php 
         }
         ?>
      <?php
         if(isset($_GET["val"])){
            if(isset($_SESSION["val"])){
               header("location:productinput.php");
            }else{
               ?><script>alert("請先選擇版型!");location.href="productindex.php"</script><?php
            }
         }
      ?>
      <script src="productindex.js"></script>
   </body>
</html>