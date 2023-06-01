<?php
    $memorybefore=memory_get_usage();

    echo("p06\n");
    function getPrecedence($operator){
        if($operator=="+"||$operator=="-"){ return 1; }
        elseif($operator=="*"||$operator=="/"){ return 2; }
        else{ return 0; }
    }

    function infixToPostfix($data){
        $stack=[];
        $postfix=[];
        $maindata=explode(" ",$data);
        // for($i=0;$i<count($maindata);$i=$i+1){

        // }
        foreach($maindata as $token){
            if(in_array($token,["+","-","*","/"])){
                while(!empty($stack)&&in_array(end($stack),["+","-","*","/"])&&getPrecedence($token)<=getPrecedence(end($stack))){
                    $postfix[]=array_pop($stack);
                }
                $stack[]=$token;
            }elseif($token=="("){
                $stack[]=$token;
            }elseif($token==")"){
                while(!empty($stack)&&end($stack)!="("){
                    $postfix[]=array_pop($stack);
                }
                array_pop($stack);
            }else{
                $postfix[]=$token;
            }
        }
        while(!empty($stack)){
            $postfix[]=array_pop($stack);
        }
        return implode(" ",$postfix);
    }

    // 從標準輸入讀取中綴表達式
    $data=trim(fgets(STDIN));

    // 轉換為後綴表達式
    $maindata=explode(" ",$data);
    for($i=0;$i<count($maindata);$i=$i+1){

    }

    $postfixexpression=infixToPostfix($data);
    // 計算後綴表達式的結果
    echo($postfixexpression."\n");
    echo(eval("return ".$data.";").PHP_EOL);

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>