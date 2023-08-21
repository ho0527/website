<?php
    $memorybefore=memory_get_usage();

    echo("p06\n");
    $data=trim(fgets(STDIN));
    $rpn=[];
    $operand=[];
    $maindata=explode(" ",$data);

    for($i=count($maindata)-1;$i>=0;$i--){
        if(in_array($maindata[$i],["+","-","*","/","^"])){
            $datacheck=-1;
            $begindatacheck=-1;

            if($maindata[$i]=="+"||$maindata[$i]=="-"){ $datacheck=2; }
            elseif($maindata[$i]=="*"||$maindata[$i]=="/"){ $datacheck=1; }
            elseif($maindata[$i]=="^"){ $datacheck=0; }

            if(!empty($operand)){
                if($operand[0]=="+"||$operand[0]=="-"){ $begindatacheck=2; }
                elseif($operand[0]=="*"||$operand[0]=="/"){ $begindatacheck=1; }
                elseif($operand[0]=="^"){ $begindatacheck=0; }
            }

            while(!empty($operand)&&in_array($operand[0],["+","-","*","/","^"])&&($datacheck>=$begindatacheck)){
                array_unshift($rpn,array_shift($operand));
            }
            array_unshift($operand,$maindata[$i]);
        }elseif($maindata[$i]==")"){
            array_unshift($operand,$maindata[$i]);
        }elseif($maindata[$i]=="("){
            while($operand[0]!=")"){
                array_unshift($rpn,array_shift($operand));
            }
            array_shift($operand);
        }else{
            array_unshift($rpn,$maindata[$i]);
        }
    }

    for($i=0;$i<count($operand);$i++){
        array_unshift($rpn,$operand[$i]);
    }

    echo(implode(" ",$rpn)."\n");

    // Calculate the result
    // echo(str_replace('^','**',$data));
    // echo(eval("return str_replace('^','**',$data);"));
    echo(number_format(floor(eval("return str_replace('^','**',$data);")*1000)/1000,3,".","").PHP_EOL);

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>
為什麼我打 1 - 2 ^ 3
這樣的輸出是 -4.000?

而且我要的是如果有小數超過3位數才會無條件捨去，不是自動補0。