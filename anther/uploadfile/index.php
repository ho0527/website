<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>檔案上傳器</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="main">
            <form method="POST" enctype="multipart/form-data">
                <div class="area" id="operatearea">
                    <h2>操作區</h2>
                    加入檔案 <input type="file" class="inputfile" id="fileinput" name="file[]" multiple><br><br>
                    加入資料夾 <input type="file" class="inputfile" id="folderinput" name="folder[]" webkitdirectory multiple><br><br>
                    資料夾名稱 <input type="text" name="folder" placeholder="預設為noname">
                </div>
                <hr>
                <div class="area" id="downloadarea">
                    <h2>上傳區</h2>
                    <input type="button" class="reflashbutton" id="reflashbutton" value="重整">
                    <input type="submit" class="downloadbutton" name="submit" value="上傳">
                </div>
            </form>
        </div>
        <p class="note">
            請注意!!盡量使用"壓縮包"上傳避免檔案雜亂謝謝<br>
            對了: 總上傳不得超過100GB也不得超過100000000個資料
        </p>
        <?php
            if(isset($_POST["submit"])){
                $rand=str_pad(rand(0,9999999999),10,"0",STR_PAD_LEFT);
                if(isset($_POST["folder"])){
                    $folder=$_POST["folder"].$rand;
                }else{
                    $folder="noname".$rand;
                }
                if(isset($folder)){
                    if(!file_exists("file/".$folder)){
                        mkdir("file/".$folder,0777,true);
                    }
                }
                if(isset($_FILES["file"])){
                    for($i=0;$i<count($_FILES["file"]["name"]);$i=$i+1){
                        $rand=str_pad(rand(0,499999),6,"0",STR_PAD_LEFT);
                        move_uploaded_file($_FILES["file"]["tmp_name"][$i],"file/".$folder."/".$rand.$_FILES["file"]["name"][$i]);
                    }
                }
                if(isset($_FILES["folder"])){
                    for($i=0;$i<count($_FILES["folder"]["name"]);$i=$i+1){
                        $rand=str_pad(rand(500000,999999),6,"0",STR_PAD_LEFT);
                        move_uploaded_file($_FILES["folder"]["tmp_name"][$i],"file/".$folder."/".$rand.$_FILES["folder"]["name"][$i]);
                    }
                }
                ?><script>alert("上傳成功!");location.href="index.php"</script><?php
            }
        ?>
        <script src="index.js"></script>
    </body>
</html>
