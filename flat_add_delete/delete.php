<?php
    $id = @$_GET['id'];
    
    $conn = new mysqli('localhost', 'root', '', 'samp_db');
    $sql = " DELETE FROM tbd_goods WHERE id=$id ";
    echo $sql;
    $conn->query($sql);
    
    header("Location: http://localhost/hannah/search.php");
?>


