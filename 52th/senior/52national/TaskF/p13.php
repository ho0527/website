<?php
    $memoryBefore=memory_get_usage();
    echo("p13\n");
    $n=(int)(fgets(STDIN));
    $ans=[];
    for($i=0;$i<$n;$i=$i+1){
        $hashvalue=0;
        $str=trim(fgets(STDIN));
        if(strlen($str)<=65536){
            for($j=0;$j<strlen($str);$j=$j+1){
                $hashvalue=$hashvalue+((ord($str[$j]))*(31**$j));
            }
            if(((-2**31)<=$hashvalue)&&($hashvalue<=((2**31)-1))){
                $ans[]=$hashvalue;
            }else{
                $ans[]="error";
            }
        }else{
            echo("輸入未符合要求");
        }
    }
    for($i=0;$i<count($ans);$i=$i+1){
        echo("output".($i+1)."=>".$ans[$i]."\n");
    }
    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
?>