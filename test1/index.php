<?php

    require_once("A.php");
    require_once("B.php");
    require_once("C.php");
    
    use a\b\c\Apple;
    use d\e\f\Apple as BApple;
    
    $a_app = new Apple();
    $a_app2 = new Apple();
    $a_app3 = new Apple();
    //$a_app -> get_info();
    
    $b_app = new BApple();
    //$b_app -> get_info();
    
    $c_app = new \Apple();
    $c_app -> get_info();