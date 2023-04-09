<?php
    $rand=str_pad(rand(0,9999999999),10,"0",STR_PAD_LEFT);
    if(preg_match("\\|\/|\?|\"|\<|\>|\|",$_POST["foldername"])){
        $folder="error".$rand;
    }else{
        if($_POST["foldername"]!=""){
            $folder=$_POST["foldername"].$rand;
        }else{
            $folder="noname".$rand;
        }
    }

    if(isset($folder)){
        if(!file_exists("file/".$folder)){
            mkdir("file/".$folder,0777,true);
        }
    }

    if(isset($_FILES["file"])){
        for($i=0;$i<count($_FILES["file"]["name"]);$i=$i+1){
            $rand=str_pad(rand(0,499999),6,"0",STR_PAD_LEFT);
            move_uploaded_file($_FILES["file"]["tmp_name"][$i],"file/".$folder."/".$rand.$_FILES["file"]["name"][$i]);
        }
    }

    if(isset($_FILES["folder"])){
        for($i=0;$i<count($_FILES["folder"]["name"]);$i=$i+1){
            $rand=str_pad(rand(500000,999999),6,"0",STR_PAD_LEFT);
            move_uploaded_file($_FILES["folder"]["tmp_name"][$i],"file/".$folder."/".$rand.$_FILES["folder"]["name"][$i]);
        }
    }
?>