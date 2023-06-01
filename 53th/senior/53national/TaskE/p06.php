<?php
    $memorybefore=memory_get_usage();

    echo("p06\n");

    function isOperator($char){
        $operators=["+","-","*","/"];
        return in_array($char,$operators);
    }

    function getPrecedence($operator){
        if($operator=="+"||$operator=="-"){ return 1; }
        elseif($operator=="*"||$operator=="/"){ return 2; }
        else{ return 0; }
    }

    function infixToPostfix($expression){
        $stack=[];
        $postfix=[];
        $tokens=explode(" ",$expression);
        foreach($tokens as $token){
            if(isOperator($token)){
                while(!empty($stack) && isOperator(end($stack)) && getPrecedence($token) <=getPrecedence(end($stack))){
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

    function evaluatePostfix($expression){
        $stack=[];

        $tokens=explode(" ",$expression);

        foreach($tokens as $token){
            if(isOperator($token)){
                $operand2=array_pop($stack);
                $operand1=array_pop($stack);
                switch($token){
                    case "+":
                        $result=$operand1 + $operand2;
                        break;
                    case "-":
                        $result=$operand1 - $operand2;
                        break;
                    case "*":
                        $result=$operand1 * $operand2;
                        break;
                    case "/":
                        $result=$operand1 / $operand2;
                        break;
                }
                $stack[]=$result;
            }else{
                $stack[]=$token;
            }
        }

        return end($stack);
    }

    // 從標準輸入讀取中綴表達式
    $expression=trim(fgets(STDIN));

    // 轉換為後綴表達式
    $postfixExpression=infixToPostfix($expression);
    echo $postfixExpression . "\n";

    // 計算後綴表達式的結果
    $result=evaluatePostfix($postfixExpression);
    echo $result;

    $memoryafter=memory_get_usage();
    $memorydifference=$memoryafter-$memorybefore;
    echo("memory used ".($memorydifference/1048576)."MB");
?>