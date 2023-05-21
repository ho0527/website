<?php
    $memorybefore=memory_get_usage();

    echo("p01\n");

    function checkWinner($board,$size){
        // 檢查橫排
        for($row=0;$row<$size;$row=$row+1){
            $player=$board[$row][0];
            if($player=="-"){ continue; } // 空格不算勝利
            $win=true;
            for($col=1;$col<$size;$col=$col+1){
                if($board[$row][$col]!=$player){
                    $win=false;
                    break;
                }
            }
            if($win){ return $player; }
        }

        // 檢查直排
        for($col=0;$col<$size;$col=$col+1){
            $player=$board[0][$col];
            if($player=="-"){ continue; } // 空格不算勝利
            $win=true;
            for($row=1;$row<$size;$row=$row+1){
                if($board[$row][$col]!=$player){
                    $win=false;
                    break;
                }
            }
            if($win){ return $player; }
        }

        // 檢查對角線
        $player=$board[0][0];
        if($player!="-"&&$board[1][1]==$player&&$board[2][2]==$player){ return $player; }

        $player=$board[0][2];
        if($player!="-"&&$board[1][1]==$player&&$board[2][0]==$player){ return $player; }

        return "?";// 無法判斷輸贏或平手
    }

    // 讀取輸入
    $n=(int)trim(fgets(STDIN));
    $board=[];
    for($i=0;$i<$n;$i++){
        $row=trim(fgets(STDIN));
        $board[]=str_split($row);
    }

    // 判斷輸贏
    $winner=checkWinner($board,$n);

    // 輸出結果
    echo($winner.PHP_EOL);

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>