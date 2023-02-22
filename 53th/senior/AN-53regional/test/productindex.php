<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>咖啡商品展示系統</title>
        <link rel="stylesheet" href="index.css">
   <body>
      <div class="header">
         <form class="headerform">
               <div class="headtitle">咖啡商品展示系統-選擇版型</div>
               <div class="headbut">
                  <input type="button" class="hbutton" onclick="location.href='signupedit.php'" value="新增">
                  <input type="button" class="hbutton" onclick="location.href='main.php'" value="首頁">
                  <input type="button" class="hbutton selectbut" onclick="location.href='productindex.php'" value="上架商品">
                  <input type="button" class="hbutton" onclick="location.href='search.php'" value="查詢">
                  <input type="button" class="hbutton" onclick="location.href='admin.php'" value="會員管理">
                  <input type="submit" class="hbutton" name="logout" value="登出">
               </div>
         </form>
      </div>
      <div class="pbar">
         <div class="pber2">
            <input type="button" class="pbut selectbut" onclick="location.href='productindex.php'" value="選擇版型">
            <input type="button" class="pbut" onclick="data()" value="填寫資料">
            <input type="button" class="pbut" onclick="data()" value="預覽">
            <input type="button" class="pbut" onclick="nono()" value="確定送出">
            <div style="float:right">
               <button onclick="location.href='newproduct.php'">新增版型</button>
            </div>
         </div>
      </div>
      <?php
         include("link.php");
         $a=fetchall(query($db,"SELECT*FROM `product`"));
         function data2($a){
            if($a=="name"){
               ?>商品名稱<?php
            }elseif($a=="cost"){
               ?>金額:0000<?php
            }elseif($a=="date"){
               ?>發佈日期<?php
            }elseif($a=="link"){
               ?>相關連結<?php
            }else{
               ?>商品簡介<?php
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
                                 <td class="coffeedata"><?= data2($a[$i][2]) ?></td>
                              </tr>
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][4]) ?></td>
                              </tr>
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][6]) ?></td>
                              </tr>
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][7]) ?></td>
                                 <td class="coffeedata"><?= data2($a[$i][8]) ?></td>
                              </tr>
                           </table>
                           <?php
                        }elseif($a[$i][2]=="picture"){
                           ?>
                           <table class="show">
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][1]) ?></td>
                                 <td class="coffeedata" rowspan="3">圖片</td>
                              </tr>
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][3]) ?></td>
                              </tr>
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][5]) ?></td>
                              </tr>
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][7]) ?></td>
                                 <td class="coffeedata"><?= data2($a[$i][8]) ?></td>
                              </tr>
                           </table>
                           <?php
                        }elseif($a[$i][3]=="picture"){
                           ?>
                           <table class="show">
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][1]) ?></td>
                                 <td class="coffeedata"><?= data2($a[$i][2]) ?></td>
                              </tr>
                              <tr>
                                 <td class="coffeedata" rowspan="3">圖片</td>
                                 <td class="coffeedata"><?= data2($a[$i][4]) ?></td>
                              </tr>
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][6]) ?></td>
                              </tr>
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][8]) ?></td>
                              </tr>
                           </table>
                           <?php
                        }else{
                           ?>
                           <table class="show">
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][1]) ?></td>
                                 <td class="coffeedata"><?= data2($a[$i][2]) ?></td>
                              </tr>
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][3]) ?></td>
                                 <td class="coffeedata" rowspan="3">圖片</td>
                              </tr>
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][5]) ?></td>
                              </tr>
                              <tr>
                                 <td class="coffeedata"><?= data2($a[$i][7]) ?></td>
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
         if(isset($_GET["val"])){
            if($_GET["val"]=="no"&&!isset($_SESSION["val"])){
               ?><script>alert("請選擇版型");location.href="productindex.php"</script><?php
            }else{
               if($_GET["val"]!="no"){ $_SESSION["val"]=$_GET["val"]; }
               ?><script>location.href="productinput.php"</script><?php
            }
         }
         ?>
      <script src="productindex.js"></script>
   </body>
</html>