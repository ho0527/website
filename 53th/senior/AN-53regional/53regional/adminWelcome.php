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
                        咖啡商品展示系統
                        <input type="button" class="adminbutton" onclick="location.href='signup.php'" value="新增">
                        <input type="button" class="adminbutton selectbut" onclick="location.href='adminWelcome.php'" value="上架商品">
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
               </table>
            </td>
         </tr>
      </table>
      <table class="timer">
         <tr>
            <td rowspan="2" class="timertd">
               <input type="text" class="timerbox" id="timer" value="<?= @$_SESSION["timer"] ?>" readonly>
            </td>
            <td class="timertd">
               <form>
                  <input type="text" id="changetimer" class="timersec" name="changetimer" value="<?= @$_SESSION["timer"] ?>" placeholder="秒">
                  <input type="submit" name="changetimersubmit" value="送出">
               </form>
            </td>
         </tr>
         <tr>
            <td class="timertd">
               <button class="timeerbutton" id="resetbutton">重設</button>
            </td>
         </tr>
      </table>
      <div class="lightboxdiv" id="ask">
         <div class="mask"></div>
         <div class="body">
            是否繼續操作?<br>
            <input type="button" class="close" id="yes" value="Yes">
            <input type="button" class="close" id="no" value="no">
         </div>
      </div>
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
      ?>
      <script src="admin.js"></script>
   </body>
</html>