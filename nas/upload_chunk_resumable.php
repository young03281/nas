<?php
// (A) INIT PHP FLOW
require __DIR__ . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
$config = new \Flow\Config();
$config->setTempDir("C:\\Users\\young922\\Desktop\\code\\\uploads&temp" . DIRECTORY_SEPARATOR . "temp");
$request = new \Flow\Request();

// (B) HANDLE UPLOAD
$uploadFolder = "C:\\Users\\young922\\Desktop\\code\\uploads&temp" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
$uploadFileName = uniqid() . $request->getFileName();
$uploadPath = $uploadFolder . $uploadFileName;
if (\Flow\Basic::save($uploadPath, $config, $request)) {
  // File saved successfully
} else {
  // Not final chunk or invalid request. Continue to upload.
}
