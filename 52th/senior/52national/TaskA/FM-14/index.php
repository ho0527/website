<?php
    // 取得所有副檔名為 png 或 jpg 的檔案清單
    $files=glob("test/"."*.{png,jpg}",GLOB_BRACE);
    // 迭代處理每個圖片檔案
    foreach ($files as $file) {
        // 讀取圖片檔案
        $image=imagecreatefromstring(file_get_contents($file));
        // 設定白色字體
        $fontColor=imagecolorallocate($image, 255, 255, 255);
        // 設定文字字型大小及角度
        $fontSize=30;
        $angle=0;
        // 取得圖片寬度及高度
        $imageWidth=imagesx($image);
        $imageHeight=imagesy($image);
        // 設定文字大小
        $bbox=imagettfbbox($fontSize, $angle, "font.ttf", "WorldSkills");
        // 設定文字位置
        $x=$imageWidth - $bbox[2] - 10;
        $y=$imageHeight - $bbox[1] - 10;
        // 加上水平的 "WorldSkills" 文字
        imagettftext($image, $fontSize, $angle, $x, $y, $fontColor, "font.ttf", "WorldSkills");
        // 設定輸出檔案路徑
        $outputFile="output/".basename($file);
        // 確認輸出資料夾存在
        if (!file_exists($outputDir)) {
            mkdir($outputDir);
        }
        imagepng($image, $outputFile);
    }
?>