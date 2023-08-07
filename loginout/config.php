<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '11220328');
define('DB_NAME', 'nas');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
mysqli_query($link, 'SET NAMES utf8');
if (!$link){
    die('Could not connect: ' . mysqli_connect_errno());
}

if (mysqli_query($link, "CREATE DATABASE IF NOT EXISTS nas")){
    mysqli_close($link);
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if (!$link) {
        die('Could not connect: ' . mysqli_connect_errno());
    }
    $sql = "CREATE TABLE IF NOT EXISTS users(id int(100) UNIQUE NULL, username varchar(100), password varchar(100)
    , file_num varchar(100), client varchar(100), X_forwarded_for varchar(100), X_forwarded varchar(100), X_cluster varchar(100)
    , fowarded_for varchar(100),fowarded varchar(100), via varchar(100), addr varchar(100))";
    if(mysqli_query($link, $sql)){
    }else{
        echo "Error creating database: " . mysqli_error($link);
    }

}else{
    echo "Error creating database: " . mysqli_error($link);
}
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else{
    return $link;
}
?>