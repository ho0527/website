<?php
    function get($value){
        return $_GET["$value"];
    }

    function intdata($value){
        return ((float)get("$value"));
    }
?>