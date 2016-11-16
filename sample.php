<?php

function static_func()
{
    return static function ($a, $b) {
        var_dump('func');
        return $a + $b;
    };
}

$test = static_func();
var_dump($test(1, 2));
var_dump($test(1,2));
var_dump($test(3,4));
//var_dump(static_func(1, 2));
//var_dump(static_func(3, 4));
