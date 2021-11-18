<?php
    // $ma = "min(2+10,5*1,max(8/2,8-2,abs(-10)))";
    // $ma = "2+10";
    // $result= eval('return '.$ma.';');
    // print $result;

    // $ma = "var1 + var2";
    // $ma = "1 + 5";
    // $result = eval('return '.$ma.';');
    // print $result;

    //example formula
    $ma = "x*y";
    //have a function that replaces these variables with inputted numbers
    $ma = "2*4";
    $result = eval('return '.$ma.';');
    print $result;
?>