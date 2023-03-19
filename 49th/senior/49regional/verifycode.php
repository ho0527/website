<?php
    $finalStr=$_GET['val'];
    $canva=imagecreate(70,80);
    imagecolorallocate($canva,255,255,255);
    if($_GET["val"]==" "){
        imagettftext($canva,40,0,20,55,(imagecolorallocate($canva,0,0,0)),(__DIR__."/font.TTF"),"+");
    }else{
        imagettftext($canva,40,0,20,55,(imagecolorallocate($canva,0,0,0)),(__DIR__."/font.TTF"),$_GET["val"]);
    }
    header("content-type:image/png");
    imagepng($canva);
    imagedestroy($canva);
?>