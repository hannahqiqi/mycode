<?php
    //$x = TRUE;
    //$y = FALSE;
    //$z = $y OR $x;
    //var_dump($z);
    
    //$array = [1, 2, 3, 4, 5];
    //foreach ($array as $key=>$value) {
        //echo $array[$key];
    //}
   //$array[] = 6;
    //print_r($array);
    //unset($array);
    
    $array = [
        1 => 'one',
        2 => 'two',
        3 => 'three'
    ];
    unset($array[2]);
    //print_r($array);
    $b = array_values($array);
    print_r($b);
    
    
    
    
    
?>