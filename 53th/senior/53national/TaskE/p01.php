<?php
    $memorybefore=memory_get_usage();

    echo("p01\n");
    // 讀取輸入
    $n=(int)trim(fgets(STDIN));
    $board=[];
    for($i=0;$i<$n;$i=$i+1){
        $board[]=str_split(trim(fgets(STDIN)));
    }

    // 判斷輸贏
    $winner="?";
    // 檢查橫排
    for($i=0;$i<$n;$i=$i+1){
        $player=$board[$i][0];
        $win=true;
        for($j=1;$j<$n;$j=$j+1){
            if($board[$i][$j]!=$player){
                $win=false;
                break;
            }
        }
        if($win&&$player!="-"){ $winner=$player; }
    }

    // 檢查直排
    for($i=0;$i<$n;$i=$i+1){
        $player=$board[0][$i];
        $win=true;
        for($j=1;$j<$n;$j=$j+1){
            if($board[$j][$i]!=$player){
                $win=false;
                break;
            }
        }
        if($win&&$player!="-"){ $winner=$player; }
    }

    // 檢查對角線
    $player=$board[0][0];
    if($player!="-"&&$board[1][1]==$player&&$board[2][2]==$player){ $winner=$player; }

    $player=$board[0][2];
    if($player!="-"&&$board[1][1]==$player&&$board[2][0]==$player){ $winner=$player; }

    // 輸出結果
    echo($winner.PHP_EOL);

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>