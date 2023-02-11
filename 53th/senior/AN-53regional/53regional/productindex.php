<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>管理者專區</title>
      <link href="index.css" rel="stylesheet">
   </head>
   <body>
      <?php
         include("link.php");
      ?>
      <table>
         <tr>
            <td class="admin-title">
               <form>
                  <div class="navigationbar">
                     <div class="navigationbardiv">
                        咖啡商品展示系統-選擇版型
                        <input type="button" class="adminbutton" onclick="location.href='signup.php'" value="新增">
                        <input type="button" class="adminbutton" onclick="location.href='adminWelcome.php'" value="首頁">
                        <input type="button" class="adminbutton selectbut" onclick="location.href='productindex.php'" value="上架商品">
                        <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
                        <input type="submit" class="adminbutton" name="logout" value="登出">
                     </div>
                  </div>
               </form>
            </td>
         </tr>
         <tr>
            <td>
               <div class="productbar">
                  <div class="productbardiv">
                     <input type="button" class="productbutton selectbut" onclick="location.href='productindex.php'" value="選擇版型">
                     <input type="button" class="productbutton" onclick="data()" value="填寫資料">
                     <input type="button" class="productbutton" onclick="location.href='productpreview.php'" value="預覽">
                     <input type="button" class="productbutton" onclick="nono()" value="確定送出">
                  </div>
               </div>
               <div class="version" id="version1" style="top: 300px;left:225px;">
                  <table class="producttable">
                     <tr>
                        <td class="coffeedata">商品名稱</td>
                        <td class="coffeedata">費用:0000</td>
                     </tr>
                     <tr>
                        <td class="coffeedata" rowspan="4">圖片: <img src="<?= @$a[$i][1] ?>" width="120px"></td>
                        <td class="coffeedata" rowspan="2">商品簡介:</td>
                     </tr>
                     <tr>
                     </tr>
                     <tr>
                        <td class="coffeedata">發佈日期:</td>
                     </tr>
                     <tr>
                        <td class="coffeedata">相關連結:</td>
                     </tr>
                  </table>
               </div>
               <div class="version" id="version2" style="top: 300px;right:225px;">
                  <table class="producttable">
                     <tr>
                        <td class="coffeedata" rowspan="4">圖片: <img src="<?= @$a[$i][1] ?>" width="120px"></td>
                        <td class="coffeedata">商品名稱</td>
                     </tr>
                     <tr>
                        <td class="coffeedata" rowspan="2">商品簡介:</td>
                     </tr>
                     <tr>
                     </tr>
                     <tr>
                        <td class="coffeedata">發佈日期:</td>
                     </tr>
                     <tr>
                        <td class="coffeedata">相關連結:</td>
                        <td class="coffeedata">費用:0000</td>
                     </tr>
                  </table>
               </div>
            </td>
         </tr>
      </table>
      <?php
         @$data=$_SESSION["data"];
         if(isset($_GET["logout"])){
            $row=fetch(query($db,"SELECT*FROM `user` WHERE `number`='$data'"));
            if(isset($data)){
               query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('$row[4]','$row[1]','$row[2]','$row[3]','$row[5]','$time','登出成功')");
               ?><script>alert("登出成功!");location.href="index.php"</script><?php
               session_unset();
            }else{
               query($db,"INSERT INTO `data`(`number`, `username`, `password`,`name`,`permission`, `time`, `move`) VALUES ('未知','','','','','','登出成功')");
               ?><script>alert("登出成功!");location.href="index.php"</script><?php
               session_unset();
            }
         }
         if(isset($_GET["changetimersubmit"])){
            $_SESSION["timer"]=$_GET["changetimer"];
            ?><script>alert("更改成功!");location.href="adminWelcome.php"</script><?php
         }
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