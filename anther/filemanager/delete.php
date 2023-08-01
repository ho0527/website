<?php
    $file_name = $_GET["file"];
    $is_folder = isset($_GET["is_folder"]) ? $_GET["is_folder"] : false;

    if ($is_folder == "true") {
        // 刪除資料夾
        $folder_path = "upload/" . $file_name;
        $files = glob($folder_path . "/*");
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            } else if (is_dir($file)) {
                rrmdir($file);
            }
        }
        rmdir($folder_path);

        echo json_encode(array("success" => true));
    } else {
        // 刪除檔案
        $file_path = "upload/" . $file_name;

        if (file_exists($file_path)) {
            unlink($file_path);
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false));
        }
    }

    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . "/" . $object) && !is_link($dir . "/" . $object)) {
                        rrmdir($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }
?>
