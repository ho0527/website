<?php
    $finalStr=$_GET['val'];
    $canva=imagecreate(30,40);
    imagecolorallocate($canva,255,255,255);
    if($_GET["val"]==" "){
        imagettftext($canva,20,0,10,30,(imagecolorallocate($canva,0,0,0)),(__DIR__."/font.TTF"),"+");
    }else{
        imagettftext($canva,20,0,10,30,(imagecolorallocate($canva,0,0,0)),(__DIR__."/font.TTF"),$_GET["val"]);
    }
    header("content-type:image/png");
    imagepng($canva);
    imagedestroy($canva);
?>