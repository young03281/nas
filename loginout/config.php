<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'nas');


$c = new PDO(DB_SERVER, DB_USERNAME, DB_PASSWORD);

$cc =$c ->query('SET NAMES utf8');
if (!$cc){
    die('Could not connect: ' . $c->errorInfo());
}

if ($c ->query("CREATE DATABASE IF NOT EXISTS nas")){
    $cf = new PDO(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    if (!$cf) {
        die('Could not connect: ' . $c->errorInfo());
    }
    $sql = "CREATE TABLE IF NOT EXISTS users(id int(100) UNIQUE NULL, username varchar(100), password varchar(100)
    , file_num varchar(100), client varchar(100), X_forwarded_for varchar(100), X_forwarded varchar(100), X_cluster varchar(100)
    , fowarded_for varchar(100),fowarded varchar(100), via varchar(100), addr varchar(100))";
    if($cf ->query($sql)){
    }else{
        echo "Error creating database: " . $c->errorInfo();
    }

}else{
    echo "Error creating database: " . $c->errorInfo();
}
// Check connection
if($c === false){
    die("ERROR: Could not connect. " . $c ->errorInfo());
}
else{
    return $cf;
}
?>
