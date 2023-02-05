<?php
    $memoryBefore=memory_get_usage();
    echo("p10-pn\n");

    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
?>