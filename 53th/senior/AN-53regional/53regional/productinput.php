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
        <div class="navigationbar">
            <div class="navigationbardiv">
                <form>
                    咖啡商品展示系統-填寫資料
                    <input type="button" class="adminbutton" onclick="location.href='signup.php'" value="新增">
                    <input type="button" class="adminbutton" onclick="location.href='adminWelcome.php'" value="首頁">
                    <input type="button" class="adminbutton selectbut" onclick="location.href='productindex.php'" value="上架商品">
                    <input type="button" class="adminbutton" onclick="location.href='manage.php'" value="會員管理">
                    <input type="submit" class="adminbutton" name="logout" value="登出">
                </form>
            </div>
        </div>
        <div class="productbar">
           <div class="productbardiv">
                <input type="button" class="productbutton" onclick="location.href='productindex.php'" value="選擇版型">
                <input type="button" class="productbutton selectbut " onclick="location.href='productinput.php'" value="填寫資料">
                <input type="button" class="productbutton" onclick="sub()" value="預覽">
                <input type="button" class="productbutton" onclick="nono2()" value="確定送出">
           </div>
        </div>
        <div class="productinput">
            <form id="form" action="productinput.php" enctype="multipart/form-data">
                商品名稱: <input type="text" class="input" name="name" value="<?= @$_SESSION["name"] ?>"><br>
                費用: <input type="number" class="input" name="cost" placeholder="只能是數字" value="<?= @$_SESSION["cost"] ?>"><br>
                相關連結: <input type="text" class="input" name="link" value="<?= @$_SESSION["link"] ?>"><br>
                <textarea name="introduction" cols="30" rows="4" placeholder="商品簡介"><?= @$_SESSION["introduction"] ?></textarea><br>
                <input type="file" name="picture" accept="image/*" style="width:200px"><br>
                <input type="button" onclick="location.href='post.php'" class="button" value="重設">
                <input type="submit" class="button" name="submit" value="完成"><br>
            </form>
        </div>
        <?php
            if(isset($_GET["submit"])){
                @$_SESSION["name"]=$_GET["name"];
                @$_SESSION["introduction"]=$_GET["introduction"];
                @$_SESSION["cost"]=$_GET["cost"];
                @$_SESSION["link"]=$_GET["link"];
                if($_SESSION["name"]==""){
                    ?><script>alert("請輸入商品!");location.href="productinput.php"</script><?php
                }else{
                    if(isset($_FILES["picture"]["tmp_name"])){
                        // echo("in");
                        if($_FILES["picture"]["error"]>0){
                            echo "Error: ".$_FILES["myfile"]["error"];
                        }else{
                            echo "檔案名稱: ".$_FILES["picture"]["name"]."<br/>";
                            echo "檔案類型: ".$_FILES["picture"]["type"]."<br/>";
                            echo "檔案大小: ".($_FILES["picture"]["size"] / 1024)." Kb<br />";
                            echo "暫存名稱: ".$_FILES["picture"]["tmp_name"];
                            if(file_exists("upload/" . $_FILES["myfile"]["name"])){
                                echo "檔案已經存在，請勿重覆上傳相同檔案";
                            }else{
                                //在檔名不會有中文的情況下，可以直接 move_uploaded_file　　
                                //move_uploaded_file($_FILES["myfile"]["tmp_name"],"upload/".$_FILES["myfile"]["name"]);
                                //在無法判斷檔名是否有中文的情況下，建議使用此方法(iconv( 原來的編碼 , 轉換的編碼 , 轉換的字串 ))避免掉中文檔名無法上傳的問題
                                $path = "image/"; //指定上傳資料夾
                                $path=$path.$_FILES['myfile']['name']; //上傳檔案名稱
                                if(move_uploaded_file($_FILES['myfile']['tmp_name'],iconv("UTF-8", "big5", $target_path))) {
                                    echo "檔案：". $_FILES['myfile']['name'] . " 上傳成功!";
                                    $_SESSION["picture"]=$path;
                                }else{
                                    echo "檔案上傳失敗，請再試一次!";
                                }
                            }
                        }
                        // header("location:productpreview.php");
                    }else{
                        header("location:productpreview.php");
                    }
                }
            }
            if(isset($_GET["val"])){
                $_SESSION["val"]=$_GET["val"];
                header("location:productinput.php");
            }
        ?>
        <script src="productindex.js"></script>
   </body>
</html>