<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>檔案上傳器</title>
        <script src="jszip/dist/jszip.js"></script>
        <script src="jszip/dist/jszipmain.js"></script>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="main" id="main">
            <div class="area" id="operatearea">
                <h2>操作區</h2>
                <form method="post" enctype="multipart/form-data">
                    加入檔案 <input type="file" class="inputfile" id="fileinput" name="file" multiple>
                    加入資料夾 <input type="file" class="inputfile" id="folderinput" name="folder" webkitdirectory multiple>
                </form>
            </div>
            <hr>
            <div class="area" id="downloadarea">
                <h2>上傳區</h2>
                <input type="button" class="reflashbutton" id="reflashbutton" value="重整">
                <input type="button" class="downloadbutton" class="submit" value="上傳">
            </div>
        </div>
        <script src="index.js"></script>
    </body>
</html>
