<?php

    $input = "1";
    for($i=0;$i<$input;$i=$i+1){
        $str="abcdefg";
        $total = 0;
        for($j=0;$j<strlen($str);$j=$j+1){
            // $total=o32(31 * $total + ord($str[$j]));
            $total = (31 * $total + ord($str[$j])) % pow(2,32);
            if($total > pow(2,31)-1) $total = $total - pow(2,32);
            if($total < -pow(2,31)) $total= $total + pow(2,32);
        }
    }
    
    echo($total);

    $input="1";
    echo((2**31)."<br>");
    echo((2**32)."<br>");
    echo((-2**31)."<br>");
    for($i=0;$i<$input;$i=$i+1){
        $hashvalue=0;
        $str="abcdefg";
        $n=strlen($str);
        if($n<=65536){
            for($j=0;$j<$n;$j=$j+1){
                $hashvalue=(31*$hashvalue+ord($str[$j]))%(2**32);
                // $hashvalue=$hashvalue+((ord($str[$j]))*(31**($n-($j+1))));
                // $hashvalue;
                if($hashvalue>((2**31)-1)){
                    $hashvalue=$hashvalue-2**32;
                    echo("in");
                }elseif($hashvalue<(-2**31)){
                    $hashvalue=$hashvalue+2**32;
                    echo("in2");
                }
                echo "<br>";
                echo "\$str[\$j] ="; print_r($str[$j]); echo "<br>";
                echo "\$n-(\$j+1) ="; print_r($n-($j+1)); echo "<br>";
                echo "(31**(\$n-(\$j+1))) ="; print_r((31**($n-($j+1)))); echo "<br>";
                // echo "hash ="; print_r($hash); echo "<br>";
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