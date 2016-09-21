<?php

    $id = @$_GET['id'];
    $name = @$_GET['name'];
    $price = @$_GET['price'];
    
    $conn = new mysqli('localhost', 'root', '', 'samp_db');
    $conn->query("UPDATE tbd_goods SET goods_name='$name', goods_price=$price WHERE id=$id");
    
    header("Location: http://localhost/hannah/search.php");

?>