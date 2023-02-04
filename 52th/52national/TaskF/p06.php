<?php
    $memoryBefore=memory_get_usage();
    echo("p06\n");
    function gcd($a,$b){
        $a=(int)$a;
        $b=(int)$b;
        if((1<=$a)&&($a<=(2**31-1))){
            if($b==0){
                $result=$a;
            }else{
                $result=gcd($b,$a%$b);
            }
        }else{
            return false;
        }
        return $result;
    }

    $n=trim(fgets(STDIN));
    for($i=0;$i<$n;$i=$i+1){
        $numbers=trim(fgets(STDIN));
        if($i==0){
            $gcd=$numbers;
            continue;
        }
        $gcd=gcd($gcd,$numbers);
    }
    echo($gcd.PHP_EOL);

    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
?>