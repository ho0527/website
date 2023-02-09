<?php
    $memoryBefore=memory_get_usage();
    echo("p12\n");
    $m=trim(fgets(STDIN));
    if(1<=$m&&$m<=10){
        for($i=0;$i<$m;$i=$i+1){
            $n=trim(fgets(STDIN));
            if(1<=$n&&$n<=100){
                $num=explode(" ",trim(fgets(STDIN)));
                // rsort($num);
                // echo "\$num ="; print_r($num); echo "\n";
                // for($j=0;$j<$n;$j++){
                //     if($num[$j]<9){
                //         $num[$j]++;
                //         for($k=$j-1;$k>=0;$k--) {
                //             $num[$k]=0;
                //         }
                //         break;
                //     }
                // }
                // if($j >= $n) {
                //     echo("1");
                //     for($k=0;$k<$n-1;$k++){
                //         echo "0";
                //     }
                // } else {
                //     echo implode("",$num);
                // }
                // echo "\n";
            }else{
                echo("輸入未符合要求");
            }
        }
    }else{
        echo("輸入未符合要求");
    }
    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("memory used: ".($memoryDifference/1048576)."MB");
?>