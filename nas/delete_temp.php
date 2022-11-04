<?php 
    $dir = "C:/Users/young/Desktop/uploads&temp/temp";
    foreach(glob($dir.'/*') as $v){
        unlink($v);
    }
    header("location:nas_admin.php")
?>