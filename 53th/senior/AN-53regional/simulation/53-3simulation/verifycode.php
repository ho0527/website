<?php
    $canva=imagecreate(40,40);
    imagecolorallocate($canva,255,255,255);
    imagettftext($canva,20,0,15,30,imagecolorallocate($canva,0,0,0),__DIR__."/CONSOLAB.TTF",$_GET["val"]);
    imagepng($canva);
?>