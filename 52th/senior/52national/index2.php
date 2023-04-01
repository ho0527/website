<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
        <style>
            .main{
                width: 250px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <h1>
                <?php
                    $array=["A5","A7","A11","A13","A14","A22","B","C","D","E","F3","F12","F13","F15","FA10","青年53區賽","青年52區賽","青年49區賽","青年51區賽","青少52區賽","青少52全國","FUCK YOU","放假:)))","????"];
                    echo($array[rand(0,count($array)-1)]);
                ?>
            </h1>
            <input type="button" class="button" onclick="location.reload()" value="重整">
        </div>
    </body>
</html>