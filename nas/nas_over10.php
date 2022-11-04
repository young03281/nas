<html>

  <body> 
    
    <div id="uplist"></div>
    
    <!-- (B) LOAD FLOWJS -->
    <!-- https://cdnjs.com/libraries/flow.js -->
    <!-- https://github.com/flowjs/flow.js/ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flow.js/2.14.1/flow.min.js"></script>
    
    <script src="flow.js"></script>

    <a href='logout.php'>登出</a><br>

    <form>你以上傳了: <p style="display:inline;" id="number">0</p> (上限為十)</form>

    <script>
      var file_num=document.gelElementById("number");
      function add(){
        var x=file_num.innerHTML;
        x=parseInt(x)+1;
        file_num.innerHTML=x;
      }
      if(file_num.innerHTML == 10){
        alert("超過十次")
        window.location.herf=("nas_over10.php")
      }
    </script>


    <?php
    
    $files = scandir("uploads");
     echo "<b>nas上有:</b>";
    for ($a = 2; $a < count($files); $a++)
    {
        ?>
        <p>
            <!-- Displaying file name !-->
            <?php echo '</b>'.substr($files[$a], 14).'</b>'; ?>
 
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