<!DOCTYPE html>

<?php 
  error_reporting(0);
  session_start();
  $username=$_SESSION["username"]; 
  $id=$_SESSION["id"];
  $t=$_SESSION["file_num"];
  $conn=require_once "../loginout/config.php";
  $sql_file="UPDATE user SET file_num='".$t."' WHERE username='".$username."'"
?>

  <head>
      <link rel="stylesheet" href="style.css?v=<?=time()?>" type="text/css">
    <title>nas</title>
  </head>
  
<html>

  <body> 
    
    

    <input type="button" id="upbrowse" style="height:50px; width:100px" value="選擇上傳檔案" onclick="javascript:x+1"/>
    <input type="button" id="upToggle" style="height:50px; width:100px" value="暫停/開始"/>
    <div id="uplist"></div>
    
    <!-- (B) LOAD FLOWJS -->
    <!-- https://cdnjs.com/libraries/flow.js -->
    <!-- https://github.com/flowjs/flow.js/ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flow.js/2.14.1/flow.min.js"></script>
    
    <script>

      var x = 0
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
        location.reload();
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

    <a href='logout.php'>登出</a><br>

    <form>你以上傳了: <p style="display:inline;" id="number"><?php echo $t;?></p> 上限為十</form>



    <?php
    $path = "../../uploads&temp/uploads";
    $files = scandir("$path");
     echo "<b>nas上有:</b>";
    for ($a = 2; $a < count($files); $a++)
    {
        ?>
        <p>
            <?php echo '</b>'.substr($files[$a], 14).'</b>'; ?>
            <a href="download.php?nama=<?php echo $path ?>/<?php echo $files[$a]; ?>">
            Download
            </a>
        </p>
        <?php
    }
    ?>
    </body>

</html>