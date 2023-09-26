<?php

    session_start();

    

    define('SITEURL', 'http://localhost/rockSite/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'rockbase');
    define('Client_Email', 'cadenconde@gmail.com');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die();

    $db_select = mysqli_select_db($conn, DB_NAME) or die();

?>