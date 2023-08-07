<!DOCTYPE html>

<?php 
  session_start();
  $username=$_SESSION["username"]; 
  $id=$_SESSION["id"];
?>

  <head>
      <link rel="stylesheet" href="style.css?v=<?=time()?>" type="text/css">
    <title>nas</title>
  </head>
  
  <body> 
    
    <?php if($id != 1){
      echo "<script>alert('還敢偷來啊冰鳥');
      window.location.href='index.php';
     </script>"; 
    } 
    ?>

    <input type="button" id="upbrowse" style="height:50px; width:100px" value="選擇上傳檔案"/>
    <input type="button" id="upToggle" style="height:50px; width:100px" value="暫停/開始"/>
    <input type="button" id="clean_temp" style="height:50px; width:100px" value="clean temp" onclick="javascript:window.location.href='delete_temp.php'"/>
    
    <div id="uplist"></div>
    
    <!-- (B) LOAD FLOWJS -->
    <!-- https://cdnjs.com/libraries/flow.js -->
    <!-- https://github.com/flowjs/flow.js/ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flow.js/2.14.1/flow.min.js"></script>
    
    <script>
      // (C) INIT FLOWJS
    window.addEventListener("load", () => {
    // (C1) NEW FLOW OBJECT
    var flow = new Flow({
      target: "upload_chunk_resumable.php",
      chunkSize: 1024*512, // 1MB
      singleFile: false
    });

    if (flow.support) {
      // (C2) ASSIGN BROWSE BUTTON
      flow.assignBrowse(document.getElementById("upbrowse"));
      // OR DEFINE DROP ZONE
      // flow.assignDrop(document.getElementById("updrop"));

      // (C3) ON FILE ADDED
      flow.on("fileAdded", (file, evt) => {
        let fileslot = document.createElement("div");
        fileslot.id = file.uniqueIdentifier;
        fileslot.innerHTML = `${file.name} (${file.size}) - <strong>0%</strong>`;
        document.getElementById("uplist").appendChild(fileslot);
      });

      // (C4) ON FILE SUBMITTED (ADDED TO UPLOAD QUEUE)
      flow.on("filesSubmitted", (arr, evt) => { flow.upload(); });

      // (C5) ON UPLOAD PROGRESS
      flow.on("fileProgress", (file, chunk) => {
        let progress = (chunk.offset + 1) / file.chunks.length * 100;
        progress = progress.toFixed(2) + "%";
        let fileslot = document.getElementById(file.uniqueIdentifier);
        fileslot = fileslot.getElementsByTagName("strong")[0];
        fileslot.innerHTML = progress;
        
      });

      // (C6) ON UPLOAD SUCCESS
      flow.on("fileSuccess", (file, message, chunk) => {
        let fileslot = document.getElementById(file.uniqueIdentifier);
        fileslot = fileslot.getElementsByTagName("strong")[0];
        fileslot.innerHTML = "DONE";
        history.go()
      });

      // (C7) ON UPLOAD ERROR
      flow.on("fileError", (file, message) => {
        let fileslot = document.getElementById(file.uniqueIdentifier);
        fileslot = fileslot.getElementsByTagName("strong")[0];
        fileslot.innerHTML = "ERROR";
      });

      // (C8) PAUSE/CONTINUE UPLOAD
      document.getElementById("upToggle").onclick = () => {
        if (flow.isUploading()) { flow.pause(); }
        else { flow.resume(); }
      };

    }
  })
    </script>
    
    <a href='logout.php' >登出</a></br>
    
    <?php
    $path = "../../uploadstemp/uploads";
    $files = scandir($path);
     echo "<font size='5'><b>nas上有:</b></font>";
    for ($a = 2; $a < count($files); $a++)
    {
        ?>
        <p>
            <!-- Displaying file name !-->
            <?php echo '</b>'.substr($files[$a], 13).'</b>'; ?>
 
            <!-- href should be complete file path !-->
            <!-- download attribute should be the name after it downloads !-->
            
              <a href="download.php?nama=<?php echo $path ?>/<?php echo $files[$a]; ?>">
                Download
              </a>
              <a href="delete.php?name=<?php echo $path ?>/<?php echo $files[$a]; ?>", t -= 1 style="color: red;" >
                Delete
              </a>
            
            
        </p>
        <?php
    }
    ?>
    </body>