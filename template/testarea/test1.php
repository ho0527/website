<?php
    $k=2;
    $text="AabBc";
    $plaintext="";
    for($i=0;$i<strlen($text);$i=$i+1){
        if(preg_match("/[A-Z]/",$text[$i])){
            $ord=ord($text[$i])-$k;
            if(ord($text[$i])-$k<65){
                $ord=ord($text[$i])-$k+26;
            }
            $plaintext=$plaintext.chr($ord);
        }elseif(preg_match("/[a-z]/",$text[$i])){
            $ord=ord($text[$i])-$k;
            if(ord($text[$i])-$k<97){
                $ord=ord($text[$i])-$k+26;
            }
            $plaintext=$plaintext.chr($ord);
        }else{
            $plaintext="N/A";
            break;
        }
    }
    echo($plaintext);
?>