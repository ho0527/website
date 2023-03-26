<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>word to pdf</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="main" id="main">
            <form method="post" enctype="multipart/form-data">
                <div class="area" id="operatearea">
                    <h2>操作區</h2>
                    <div class="input">
                        選擇多個Word文檔 <input type="file" name="file[]" id="file" multiple>
                    </div>
                </div>
                <hr>
                <div class="area" id="previewarea">
                    <h2>檔案預覽區</h2>
                    <ul class="filelist" id="filelist"></ul>
                </div>
                <hr>
                <div class="area" id="downloadarea">
                    <h2>下載區</h2>
                    <input type="button" class="reflashbutton" id="reflashbutton" value="重整">
                    <input type="submit" name="submit" class="downloadbutton" id="downloadbutton" value="下載">
                </div>
            </form>
        </div>
        <?php
            if(isset($_POST["submit"])){
                $files = $_FILES["file"]["tmp_name"];
                $filenames = $_FILES["file"]["name"];
                $pdffiles = array();
                for($i = 0; $i < count($files); $i++){
                    $extension = strtolower(pathinfo($filenames[$i], PATHINFO_EXTENSION)).".pdf";
                    if($extension=="doc"||$extension=="docx"){
                        $pdf=pathinfo($filenames[$i], PATHINFO_FILENAME);
                        $command="unoconv -f pdf ".$files[$i];
                        exec($command);
                        $pdffiles[]=$pdf;
                    }else{
                        ?><script>alert("請上傳.doc或.docx")</script><?php
                    }
                }
                $pdfname = implode("-", $pdffiles) . ".pdf";
                $command = "pdfunite " . implode(" ", $pdffiles) . " " . $pdfname;
                exec($command);
                header("Content-Type: application/pdf");
                header("Content-Disposition: attachment; filename=".$pdfname);
                readfile($pdfname);
                unlink($pdfname);
                foreach($pdffiles as $pdffile){
                    unlink($pdffile);
                }
            }
        ?>
        <script src="index.js"></script>
    </body>
</html>