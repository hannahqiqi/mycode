<?php

    //getimagesize($filename):得到指定图片的信息，如果是真实图片返回数组，如果不是图片，返回false
    $filename = '/home/aaron/桌面/maomao.jpg';
    $filename = '/home/aaron/桌面/1.jpg';
    //print_r(getimagesize($filename));返回数组
    var_dump(getimagesize($filename));//返回false