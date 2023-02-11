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
            if(isset($_GET["id"])){
                $_SESSION["id"]=$_GET["id"];
            }
            $id=$_SESSION["id"];
            $row=fetch(query($db,"SELECT*FROM `coffee` WHERE `id`='$id'"));
        ?>
        <table>
            <tr>
                <td class="admin-title">
                <form>
                    <div class="navigationbar">
                        <div class="navigationbardiv">
                            咖啡商品展示系統-編輯
                            <input type="button" class="adminbutton" onclick="location.href='signup.php'" value="新增">
                            <input type="button" class="adminbutton selectbut" onclick="location.href='adminWelcome.php'" value="首頁">
                            <input type="button" class="adminbutton" onclick="location.href='productindex.php'" value="上架商品">
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
                    <div class="signupdiv">
                        <form id="form" enctype="multipart/form-data">
                            商品名稱: <input type="text" class="indexinput" name="name" value="<?= @$row[2] ?>"><br>
                            費用: <input type="number" class="indexinput" name="cost" placeholder="只能是數字" value="<?= @$row[4] ?>"><br>
                            相關連結: <input type="text" class="indexinput" name="link" placeholder="" value="<?= @$row[6] ?>"><br>
                            <textarea name="introduction" cols="30" rows="2" placeholder="商品簡介"><?= @$row[3] ?></textarea><br>
                            <input type="file" name="picture" accept="image/*" style="width:200px" value="上傳圖片"><br>
                            版型: <input type="text" class="indexinput" name="val" placeholder="1or2" value="<?= @$row[7] ?>"><br>
                            <input type="button" onclick="location.href='productedit.php'" class="button" value="重設">
                            <input type="button" onclick="location.href='adminWelcome.php'" class="button" value="返回">
                            <input type="submit" class="button" name="submit" value="完成"><br>
                        </form>
                    </div>
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
            if(isset($_GET["submit"])){
                @$name=$_GET["name"];
                @$introduction=$_GET["introduction"];
                @$cost=$_GET["cost"];
                @$link=$_GET["link"];
                @$picture=$_GET["picture"];
                @$val=$_GET["val"];
                if($name==""){
                    ?><script>alert("請輸入商品!");location.href="productedit.php"</script><?php
                }else{
                    query($db,"UPDATE `coffee` SET `name`='$name',`introduction`='$introduction',`cost`='$cost',`link`='$link',`version`='$val' WHERE `id`='$id'");
                    ?><script>alert("修改完成!");location.href="adminWelcome.php"</script><?php
                    // if(isset($_FILES["picture"]["tmp_name"])){
                    //     // echo("in");
                    //     if($_FILES["picture"]["error"]>0){
                    //         echo "Error: ".$_FILES["myfile"]["error"];
                    //     }else{
                    //         echo "檔案名稱: ".$_FILES["picture"]["name"]."<br/>";
                    //         echo "檔案類型: ".$_FILES["picture"]["type"]."<br/>";
                    //         echo "檔案大小: ".($_FILES["picture"]["size"] / 1024)." Kb<br />";
                    //         echo "暫存名稱: ".$_FILES["picture"]["tmp_name"];
                    //         if(file_exists("upload/" . $_FILES["myfile"]["name"])){
                    //             echo "檔案已經存在，請勿重覆上傳相同檔案";
                    //         }else{
                    //             //在檔名不會有中文的情況下，可以直接 move_uploaded_file　　
                    //             //move_uploaded_file($_FILES["myfile"]["tmp_name"],"upload/".$_FILES["myfile"]["name"]);
                    //             //在無法判斷檔名是否有中文的情況下，建議使用此方法(iconv( 原來的編碼 , 轉換的編碼 , 轉換的字串 ))避免掉中文檔名無法上傳的問題
                    //             $path = "image/"; //指定上傳資料夾
                    //             $path=$path.$_FILES['myfile']['name']; //上傳檔案名稱
                    //             if(move_uploaded_file($_FILES['myfile']['tmp_name'],iconv("UTF-8", "big5", $target_path))) {
                    //                 echo "檔案：". $_FILES['myfile']['name'] . " 上傳成功!";
                    //                 $_SESSION["picture"]=$path;
                    //             }else{
                    //                 echo "檔案上傳失敗，請再試一次!";
                    //             }
                    //         }
                    //     }
                    //     // header("location:productpreview.php");
                    // }else{
                    //     header("location:productpreview.php");
                    // }
                }
            }
        ?>
   </body>
</html>