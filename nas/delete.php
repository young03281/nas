<?php

$conn = require_once "../loginout/config.php";
session_start();
// Built-in PHP function to delete file
$id  = $_GET["id"];
unlink(urldecode($_GET["path"]));
$sql = "UPDATE users SET file_num = file_num - 1 WHERE id = (SELECT userid FROM files WHERE id = '". $id ."')";


$conn->query($sql);

$sql = "DELETE FROM files WHERE id = '". $id ."'";

$result = $conn->query($sql);

if ($result->rowCount()){
    $_SESSION["file_num"] -= 1;
}

// Redirecting back
header("Location: " . $_SERVER["HTTP_REFERER"]);