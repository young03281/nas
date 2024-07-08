<?php

session_start();

$x = $_GET["x"];
$t = $_GET["t"];
$username = $_GET["username"];

if ($t != $x){
    $t = $x;
    $_SESSION["file_num"] = $t;
    $conn=require_once "../loginout/config.php";
    $sql_file="UPDATE users SET file_num='".$t."' WHERE username='".$username."'";
    $conn->query($sql_file);
    $_SESSION["file_num"] = $t;
    header("location:./", true);
}
?>