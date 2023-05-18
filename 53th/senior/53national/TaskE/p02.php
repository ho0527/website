<?php
    $memorybefore=memory_get_usage();

    echo("p02\n");
    function fibonacci($n){
        if($n==0){
            return 0;
        }elseif($n==1){
            return 1;
        }else{
            return fibonacci($n-1)+fibonacci($n-2);
        }
    }

    $n=(int)trim(fgets(STDIN));
    if($n<=93){
        echo(fibonacci($n).PHP_EOL);
    }else{
        echo("[ERROR]n error".PHP_EOL);
    }

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>