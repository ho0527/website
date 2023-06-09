<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Convert code 64 to image</title>
    </head>
    <body>
        <form method="POST">
            <textarea name="code" cols="30" rows="10" placeholder="CODE64"></textarea>
            <input type="submit" name="submit" value="Convert">
        </form>
        <?php
            if(isset($_POST["submit"])){
                $text=$_POST["code"];
                $base64=str_replace("data:image/png;base64,","",$text);
                if(!file_exists("image/")){ mkdir("image/",0777,true); }
                file_put_contents("image/img".rand(0,99999999).".png",base64_decode($base64));
                echo("轉換完成");
            }
        ?>
    </body>
</html>