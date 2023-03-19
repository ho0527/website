<?php
    // 設置浮水印文字和顏色
    $text = "WorldSkills";
    $color = imagecolorallocate($im, 255, 255, 255); // 白色

    // 打開圖片文件
    $filename = "media/" . basename($_SERVER["REQUEST_URI"]);
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if ($extension == "jpg" || $extension == "jpeg") {
        $im = imagecreatefromjpeg($filename);
    } else if ($extension == "png") {
        $im = imagecreatefrompng($filename);
    }

    // 添加浮水印文字
    $font = 5; // 字體大小
    $padding = 10; // 文字和邊緣的距離
    $bbox = imagettfbbox($font, 0, "arial.ttf", $text);
    $text_width = $bbox[2] - $bbox[0];
    $text_height = $bbox[1] - $bbox[7];
    $x = imagesx($im) - $text_width - $padding;
    $y = imagesy($im) - $text_height - $padding;
    imagettftext($im, $font, 0, $x, $y, $color, "arial.ttf", $text);

    // 輸出圖片
    header("Content-type: image/jpeg"); // 如果原始圖片是 JPEG 格式
    imagejpeg($im);

    // 釋放資源
    imagedestroy($im);
?>