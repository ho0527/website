<?php
    $finalStr=$_GET['val'];
    $canva=imagecreate(40,40);
    imagecolorallocate($canva,255,255,255);
    $paint=imagecolorallocate($canva,255,0,0);
    $font=__DIR__."/font.TTF";
    imagettftext($canva,20,0,15,30,$paint,$font,$finalStr);
    // header("content-type:image/png");
    imagepng($canva);
    imagedestroy($canva);
?>