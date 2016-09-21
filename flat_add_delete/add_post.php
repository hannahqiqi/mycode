<?php

    $id = @$_POST['id'];
    $name = @$_POST['name'];
	$price = @$_POST['price'];
    
    $conn = new mysqli('localhost', 'root', '', 'samp_db');
    $conn->query("INSERT INTO tbd_goods(goods_name, goods_price) VALUES('$name', $price)");
    
    header("Location: http://localhost/hannah/search.php");
    
?>