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
        query($db,"INSERT INTO `game`(`date`,`description`,`link`,`signupbutton`,`name`,`picture`,`version`)VALUES(?,?,?,?,?,?,?)",[$date,$description,$link,$signupbutton,$name,$file,$version]);
        echo(json_encode([
            "success"=>true,
            "data"=>""
        ]));
    }
?>