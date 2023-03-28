<?php
    // 設定輸出圖片大小
    $width = 1920;
    $height = 1080;

    // 設定線條重複的間隔
    $interval = 100;

    // 載入背景圖片
    $bg = imagecreatefromjpeg('image/bg.jpg');

    // 建立新的畫布
    $canvas = imagecreatetruecolor($width, $height);

    // 複製背景圖片到畫布上
    imagecopy($canvas, $bg, 0, 0, 0, 0, $width, $height);

    // 設定線條顏色為黑色
    $lineColor = imagecolorallocate($canvas, 0, 0, 0);

    // 畫水平線
    for ($y = $interval; $y < $height; $y += $interval) {
        imageline($canvas, 0, $y, $width, $y, $lineColor);
    }

    // 畫垂直線
    for ($x = $interval; $x < $width; $x += $interval) {
        imageline($canvas, $x, 0, $x, $height, $lineColor);
    }

    // 輸出圖片到檔案
    imagejpeg($canvas, 'ans/result.jpg');

    // 釋放資源
    imagedestroy($bg);
    imagedestroy($canvas);
?>
