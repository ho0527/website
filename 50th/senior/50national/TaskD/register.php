<?php
    $data=json_decode(file_get_contents("php://input"),true); // 拿到分數等等的資料




    echo(json_encode($row)); // 回傳資料
?>