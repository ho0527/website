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
        $number=trim(fgets(STDIN));
        if($i==0){
            $gcd=$number;
            continue;
        }
        $gcd=gcd($gcd,$number);
    }
    echo($gcd.PHP_EOL);

    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("memory used: ".($memoryDifference/1048576)."MB");
?>