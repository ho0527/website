<?php
    $memorybefore=memory_get_usage();

    echo("p01\n");

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>