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
                        <input type="search" name="search" placeholder="查詢" class="admininput">
                        <button class="button" name="enter">送出</button>
                     </div>
                  </div>
               </form>
            </td>
         </tr>
         <tr>
            <td>
               <table class="main-table">
                  <div class="productbar">
                     <div class="productbardiv">
                        <input type="button" class="productbutton selectbut" onclick="location.href='productindex.php'" value="選擇版型">
                        <input type="button" class="productbutton" onclick="data()" value="填寫資料">
                        <input type="button" class="productbutton" onclick="location.href='productpreview.php'" value="預覽">
                        <input type="button" class="productbutton" onclick="nono()" value="確定送出">
                     </div>
                  </div>
                  <div class="version" id="version1" style="top: 130px;left:225px;">
                     <div class="name" style="top: 5px;left: 20px;">商品名稱</div>
                     <div class="picture" style="top: 40px;left: 20px;">圖片</div>
                     <div class="introduction" style="top: 40px;right: 20px;">商品簡介</div>
                     <div class="date" style="top: 125px;right: 20px;">發布日期</div>
                     <div class="cost" style="top: 5px;right: 20px;">費用:0000</div>
                     <div class="link" style="top: 195px;right: 20px;">相關連結</div>
                  </div>
                  <div class="version" id="version2" style="bottom: 115px;left:1175px;">
                     <div class="picture" style="top: 5px;left: 20px;">圖片</div>
                     <div class="link" style="bottom: 15px;left: 20px;">相關連結</div>
                     <div class="introduction" style="top: 40px;right: 20px;">商品簡介</div>
                     <div class="date" style="top: 125px;right: 20px;">發布日期</div>
                     <div class="name" style="top: 5px;right: 20px;">商品名稱</div>
                     <div class="cost" style="top: 195px;right: 20px;">費用:0000</div>
                  </div>
               </table>
            </td>
         </tr>
      </table>
      <?php
         include("admindef.php");
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
               header("location:productcheckdata.php");
            }else{
               ?><script>alert("請先選擇版型!");location.href="productindex.php"</script><?php
            }
         }
      ?>
      <script src="productindex.js"></script>
   </body>
</html>