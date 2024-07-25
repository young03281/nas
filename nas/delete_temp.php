<?php 
    $dir = "../../temp";
    foreach(glob($dir.'/*') as $v){
        unlink($v);
    }
    header("location:./")
?>
