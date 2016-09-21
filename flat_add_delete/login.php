<?php
    session_start();
    
    $username = @$_POST['username'];
    $password = @$_POST['password'];
    
    $conn = new mysqli('localhost', 'root', '', 'samp_db');
    $sql = " SELECT * FROM login WHERE user='".$username."' and password='".$password."' ";
    $results = $conn->query($sql);
    $answers = $results->fetch_array();
    //print_r($answers);
    if($answers) {
        $_SESSION['login'] = $username;
        echo "<script>location='success.php'</script>";
    } else {
        echo "登录失败";
    }
?>

