<?php
    $finalstr=$_GET["val"];
    $canva=imagecreate(40,40);
    imagecolorallocate($canva,255,255,255);
    $paint=imagecolorallocate($canva,255,0,0);
    $font=__DIR__."/CONSOLA.TTF";
    imagettftext($canva,20,0,15,30,$paint,$font,$finalstr);
    imagepng($canva);
?>