<?php
/**
 * @return void
 */
function extracted(){
    echo("text0\n");
    while (($line = readline()) != false) {
        $number = explode(" ", $line);
        $num1 = $number[0];
        if ($num1 == -1) {
            break;
        }
        $num2 = $number[1];
        echo($num1 + $num2);
        echo("\n");
    }
}


extracted();
?>