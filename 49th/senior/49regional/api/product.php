<?php
    include("../link.php");
    if(isset($_POST["submit"])){
        $date=$_POST["date"];
        $description=$_POST["description"];
        $link=$_POST["link"];
        $signupbutton=$_POST["signupbutton"];
        $name=$_POST["name"];
        $file=$_POST["file"];
        $version=$_POST["version"];
        if($file!=""){
            // 将Base64编码的图像数据解码为二进制文件
            $data=explode(",",$file);
            $decodedImage=base64_decode($data[1]);

            // 确定目标文件的路径和名称

            $row=query($db,"SELECT*FROM `game`");
            $targetFileName="image.png"; // 根据需要指定文件名
            if (preg_match("/^data:image\/(\w+);base64,/",$file,$matche)){
                $extension=$matche[1];
            }
            file_put_contents("../upload/".(count($row)+1).".".$extension, $decodedImage);
        }
        query($db,"INSERT INTO `game`(`date`,`description`,`link`,`signupbutton`,`name`,`picture`,`version`)VALUES(?,?,?,?,?,?,?)",[$date,$description,$link,$signupbutton,$name,$file,$version]);
        echo(json_encode([
            "success"=>true,
            "data"=>""
        ]));
    }
?>