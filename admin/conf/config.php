<?php
    session_start();
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
    $token = $_SESSION['token'];

    $db_host = "localhost";
    $db_user = "root";
    $db_pw   = "";
    $db_name = "beauty_db";

    //Create Connection
    $conn = mysqli_connect($db_host, $db_user, $db_pw);
    mysqli_select_db($conn, $db_name);

    //Check Connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected <br>";
    //echo $token;
?>