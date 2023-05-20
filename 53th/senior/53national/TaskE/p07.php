<?php
    $memorybefore=memory_get_usage();

    echo("p01\n");
    // 判斷兩個單字是否相鄰
    function isAdjacent($word1, $word2) {
        $diff = 0;
        $length = strlen($word1);

        for ($i = 0; $i < $length; $i++) {
            if ($word1[$i] != $word2[$i]) {
                $diff++;
            }
        }

        return $diff === 1;
    }

    // 建立單字圖
    function buildGraph($words) {
        $graph = array();
        $length = count($words);

        for ($i = 0; $i < $length; $i++) {
            for ($j = $i + 1; $j < $length; $j++) {
                if (isAdjacent($words[$i], $words[$j])) {
                    // 將相鄰的單字加入到圖中
                    $graph[$words[$i]][] = $words[$j];
                    $graph[$words[$j]][] = $words[$i];
                }
            }
        }

        return $graph;
    }

    // 使用 BFS 尋找最短路徑
    function shortestPath($graph, $start, $end) {
        $queue = new SplQueue();
        $queue->enqueue(array($start, 1)); // 儲存單字和步數
        $visited = array($start); // 儲存已訪問過的單字

        while (!$queue->isEmpty()) {
            list($word, $steps) = $queue->dequeue();

            if ($word === $end) {
                return $steps;
            }

            foreach ($graph[$word] as $neighbor) {
                if (!in_array($neighbor, $visited)) {
                    $visited[] = $neighbor;
                    $queue->enqueue(array($neighbor, $steps + 1));
                }
            }
        }

        return 0; // 若無法轉換為終止單字，回傳 0
    }

    // 讀取起始單字和終止單字
    list($start, $end) = explode(" ", trim(fgets(STDIN)));

    // 讀取單字表數量和單字表
    $N = intval(trim(fgets(STDIN)));
    $wordList = array();

    for ($i = 0; $i < $N; $i++) {
        $wordList[] = trim(fgets(STDIN));
    }

    // 將起始單字和終止單字加入到單字表中
    $wordList[] = $start;
    $wordList[] = $end;

    // 建立單字圖
    $graph = buildGraph($wordList);

    // 尋找最短路徑
    $length = shortestPath($graph, $start, $end);

    // 輸出結果
    echo $length;
    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>