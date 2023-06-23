<?php
    $memorybefore=memory_get_usage();

    echo("p02\n");
    function fibonacci($a,$b,$n){
        if($n==0){ return $a; }
        else{ return fibonacci($b,$a+$b,$n-1); }
    }

    $n=(int)trim(fgets(STDIN));
    if($n<=93){
        echo(fibonacci(0,1,$n).PHP_EOL);
    }else{
        echo("[ERROR]n error".PHP_EOL);
    }

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>