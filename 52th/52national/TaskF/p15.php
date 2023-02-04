<?php
    $memoryBefore=memory_get_usage();
    echo("p15\n");

    $string = trim(fgets(STDIN));

    $words = explode(" ", preg_replace("/[^a-zA-Z ]/", "", strtolower($string)));

    $wordCounts = array_count_values($words);
    arsort($wordCounts);

    $i = 1;
    foreach ($wordCounts as $word => $count) {
        if ($i <= 3) {
            echo $word . "\n";
            $i++;
        } else {
            break;
        }
    }

    echo("\n");
    $memoryAfter=memory_get_usage();
    $memoryDifference=$memoryAfter-$memoryBefore;
    echo("Memory used: ".($memoryDifference/1048576)."MB");
?>