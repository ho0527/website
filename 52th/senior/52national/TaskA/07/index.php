<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <form method="post" enctype="multipart/form-data">
            Select image to upload:<br>
            <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
            <input type="submit" value="Upload Image" name="submit">
        </form>
        <?php
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            }else{
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    // Load image
                    $im = imagecreatefromjpeg($target_file);
                    // Create pattern
                    $pattern = imagecreatetruecolor(100, 100);
                    $background = imagecolorallocate($pattern, 0, 0, 0);
                    imagefill($pattern, 0, 0, $background);
                    $color = imagecolorallocate($pattern, 255, 255, 255);
                    imagesetthickness($pattern, 1);
                    imageline($pattern, 0, 50, 100, 50, $color);
                    imageline($pattern, 50, 0, 50, 100, $color);

                    // Apply pattern to image
                    imagesettile($im, $pattern);
                    imagefilledrectangle($im, 0, 0, imagesx($im), imagesy($im), IMG_COLOR_TILED);

                    // Save result
                    imagejpeg($im, 'result.jpg');
                    imagedestroy($im);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        ?>
    </body>
</html>