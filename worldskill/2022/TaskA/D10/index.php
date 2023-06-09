<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>title</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <form enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="submit" name="submit" value="送出">
        </form>
        <?php
            if(isset($_POST["submit"])){
                $file=$_POST["file"]["name"];
            }
        ?>
    </body>
</html>