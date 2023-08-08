<html>

  <head>
      <link rel="stylesheet" href="style.css?v=<?=time()?>" type="text/css">
    <title>nas</title>
  </head>

  <body> 
    <!-- (B) LOAD FLOWJS -->
    <!-- https://cdnjs.com/libraries/flow.js -->
    <!-- https://github.com/flowjs/flow.js/ -->
    <a href='logout.php'>登出</a><br>

    <form>你以上傳了: <p style="display:inline;" id="number"><?php echo $_GET["file_num"] ?></p> (上限為十)</form>



    <?php
    
    $files = scandir("../../uploadstemp/uploads/");
     echo "<b>nas上有:</b>";
    for ($a = 2; $a < count($files); $a++)
    {
        ?>
        <p>
            <!-- Displaying file name !-->
            <?php echo '</b>'.substr($files[$a], 13).'</b>'; ?>
 
            <!-- href should be complete file path !-->
            <!-- download attribute should be the name after it downloads !-->
            <a href="uploads/<?php echo $files[$a]; ?>" download="<?php echo $files[$a]; ?>">
            Download
            </a>
        </p>
        <?php
    }
    ?>
    </body>

  </html>