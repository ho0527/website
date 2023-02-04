<?php
    $memoryBefore=memory_get_usage();
    echo("p08\n");
    $n=trim(fgets(STDIN));
    function gcd($num){
        if(($num<1)&&($num>(2**63-1))){
            return false;
        }else{
            $all=0;
            for($i=1;$i<$num;$i=$i+1){
                if($num%$i==0){
                    $all=$all+$i;
                }
            }
            if($all==$i){
                return true;
            }else{
                return false;
            }
        }
    }
    for($i=0;$i<$n;$i=$i+1){
        $num=trim(fgets(STDIN));
        if(gcd($num)){
            echo("Y".PHP_EOL);
        }else{
            echo("N".PHP_EOL);
        }
    }
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
?>