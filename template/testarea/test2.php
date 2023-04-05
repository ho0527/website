<?php
    $n="1";
    echo((2**31)."<br>");
    echo((2**32)."<br>");
    for($i=0;$i<$n;$i=$i+1){
        $hashvalue=0;
        $str="abcdef";
        if(strlen($str)<=65536){
            for($j=0;$j<strlen($str);$j=$j+1){
                $hash=(ord($str[$j]))*(31**(strlen($str)-($j+1)));
                if($hash>(2**31)-1){
                    $hashvalue=$hashvalue+($hash-(2**32));
                    echo("true");
                }elseif($hash<-2**31){
                    $hashvalue=$hashvalue+($hash+(2**32));
                    echo("false");
                }else{
                    $hashvalue=$hashvalue+$hash;
                    echo("tru2");
                }
                echo "<br>";
                echo "\$str[\$j] ="; print_r($str[$j]); echo "<br>";
                echo "\$n-(\$j+1) ="; print_r(strlen($str)-($j+1)); echo "<br>";
                echo "(31**(\$n-(\$j+1))) ="; print_r((31**(strlen($str)-($j+1)))); echo "<br>";
                echo "hash ="; print_r($hash); echo "<br>";
                echo "ord(\$str[\$j]) ="; print_r(ord($str[$j])); echo "<br>";
                echo "\$hashvalue ="; print_r($hashvalue); echo "<br>";
            }
        }else{
            echo("輸入未符合要求");
        }
    }
    echo($hashvalue);
    echo("<br>");
?>