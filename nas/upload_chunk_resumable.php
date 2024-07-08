<?php
// (A) INIT PHP FLOW
require __DIR__ . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
$conn = require_once "../loginout/config.php";
session_start();
$id = $_SESSION["id"];
$config = new \Flow\Config();
$config->setTempDir("C:\\Users\\young\\Desktop\\code\\\uploads&temp" . DIRECTORY_SEPARATOR . "temp");
$request = new \Flow\Request();

// (B) HANDLE UPLOAD
$uploadFolder = "C:\\Users\\young\\Desktop\\code\\uploads&temp" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
$uploadFileName = uniqid() . $request->getFileName();
$uploadPath = $uploadFolder . $uploadFileName;
if (\Flow\Basic::save($uploadPath, $config, $request)) {
  do{
    $rand = rand();
    $sql = "SELECT * FROM files WHERE id = '". $rand ."'";
    $result = $conn ->query($sql);
  }while($result->rowCount());
  $sql = "INSERT INTO files(id, f_name, userid) VALUES('". $rand ."', '". $uploadFileName ."', '".  $id ."')";
  $result = $conn ->query($sql);
} else {
  // Not final chunk or invalid request. Continue to upload.
}
