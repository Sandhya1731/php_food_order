<?php

    session_start();
    define('SITEURL','http://localhost/food_app/');
    // create constants to store non repeating values
   
    define('LOCAL_HOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food_order');
    $conn= mysqli_connect(LOCAL_HOST,DB_USERNAME,DB_PASSWORD)or die(mysqli_error());// database connection
    $db_select=mysqli_select_db($conn,DB_NAME)or die(mysqli_error());// selecting database
?>