<?php
    $memorybefore=memory_get_usage();

    echo("p01\n");

    // 使用 BFS 尋找最短路徑
    function shortestPath($graph,$start,$end){
        $queue=new SplQueue();
        $queue->enqueue(array($start,1)); // 儲存單字和步數
        $visited=array($start); // 儲存已訪問過的單字

        while(!$queue->isEmpty()){
            list($word,$steps)=$queue->dequeue();

            if($word === $end){
                return $steps;
            }

            foreach($graph[$word] as $neighbor){
                if(!in_array($neighbor,$visited)){
                    $visited[]=$neighbor;
                    $queue->enqueue(array($neighbor,$steps+1));
                }
            }
        }

        return 0; // 若無法轉換為終止單字，回傳 0
    }

    // 讀取起始單字和終止單字
    $word=explode(" ",trim(fgets(STDIN)));
    $start=$word[0];
    $end=$word[1];

    // 讀取單字表數量和單字表
    $n=(int)trim(fgets(STDIN));
    $data=[];
    $worddata=[];

    for($i=0;$i<$n;$i++){
        $data[]=trim(fgets(STDIN));
    }

    // 將起始單字和終止單字加入到單字表中
    $data[]=$start;
    $data[]=$end;

    // 建立單字圖
    for($i=0;$i<count($data);$i=$i+1){
        for($j=$i+1;$j<count($data);$j=$j+1){
            // 判斷兩個單字是否相鄰
            $wordcheck=0;
            for($i=0;$i<strlen($data[$i]);$i=$i+1){
                if($data[$i][$i]!=$data[$j][$i]){
                    $wordcheck=$wordcheck+1;
                }
            }

            if($wordcheck==1){
                // 將相鄰的單字加入到圖中
                $worddata[$data[$i]][]=$data[$j];
                $worddata[$data[$j]][]=$data[$i];
            }
        }
    }

    // 尋找最短路徑
    $length=shortestPath($graph,$start,$end);

    // 輸出結果
    echo($length.PHP_EOL);

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>