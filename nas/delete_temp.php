<?php 
    $dir = "C:\\Users\\young\\Desktop\\vscode_workspace\\uploadstemp\\temp";
    foreach(glob($dir.'/*') as $v){
        unlink($v);
    }
    header("location:nas_admin.php")
?>