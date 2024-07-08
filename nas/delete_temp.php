<?php 
    $dir = "C:\\Users\\young\\Desktop\\code\\uploads&temp\\temp";
    foreach(glob($dir.'/*') as $v){
        unlink($v);
    }
    header("location:./")
?>