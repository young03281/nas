<?php

if(isset($_GET['path'])){
    //Read the filename
    $filename = $_GET['path'];
    $filename = urldecode($filename);
    //Check the file exists or not
    if(file_exists($filename)) {

        //Define header information
        header('Content-Description: File Transfer');
        header('Content-Type: application/x-file-to-save');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.substr(basename($filename), 13).'"');
        header('Content-Length: ' . filesize($filename));
        header('Pragma: public');

        //Clear system output buffer
        flush();

        ob_end_clean();

        //Read the size of the file
        readfile($filename);

        exit;

        //Terminate from the script
        die();
    }
    else{
        echo "File does not exist.";
    }
}
else
    echo "Filename is not defined."
?>