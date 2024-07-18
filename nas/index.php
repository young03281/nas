<!DOCTYPE html>

<?php 
  session_start();
  $username=$_SESSION["username"];
  if ($username == null){
    echo "<script>alert('還敢偷來啊冰鳥');
      window.location.href='../';
     </script>"; 
  }
  $id=$_SESSION["id"];
  $t=$_SESSION["file_num"];
  $conn=require_once "../loginout/config.php";
  $sql_file="UPDATE users SET file_num='".$t."' WHERE username='".$username."'";
  $conn ->query($sql_file);
?>

  <head>
      <link rel="stylesheet" href="style.css?v=<?=time()?>" type="text/css">
      <link rel="icon" href="favicon.png" type="image/png">
    <title>nas</title>
  </head>
  
<html>

  <body> 
    
    

    <?php if($t < 10 || $id == 1) echo "<input type=\"button\" id=\"upbrowse\" style=\"height:50px; width:100px\" value=\"選擇上傳檔案\"/>"; ?>
    <input type="button" id="upToggle" style="height:50px; width:100px" value="暫停/開始"/>
    <?php if($id == 1) echo "<input type=\"button\" id=\"clean_temp\" style=\"height:50px; width:100px\" value=\"clean temp\" onclick=\"javascript:window.location.href='delete_temp.php'\"/>"; ?>
    <div id="uplist"></div>
    
    <!-- (B) LOAD FLOWJS -->
    <!-- https://cdnjs.com/libraries/flow.js -->
    <!-- https://github.com/flowjs/flow.js/ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flow.js/2.14.1/flow.min.js"></script>
    
    <script>
      var x = <?php echo $t ?>
      // (C) INIT FLOWJS
      window.addEventListener("load", () => {
      // (C1) NEW FLOW OBJECT
      var flow = new Flow({
        target: "upload_chunk_resumable.php",
        chunkSize: 1024*1024, // 1MB
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
          x++;
          window.location.replace("./check.php?x="+ x + "&t=" + <?php echo $t ?> +"&username=<?php echo $username ?>");
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

    <a href='logout.php' script = loca>登出</a><br>

    <form>你已上傳了: <p style="display:inline;" id="number"><script> document.writeln(x); </script></p>上限為十</form>



    <?php
    $path = "../../uploads&temp/uploads";
    $files = scandir("$path");
    echo "<b>nas上有:</b>";
    $sql = "SELECT * FROM files WHERE f_name = '";
    for ($a = 2; $a < count($files); $a++)
    {
      $sql = "SELECT * FROM files WHERE f_name = '";
      $result = $conn->query($sql.$files[$a]."'");
      $row = $result->fetch(PDO::FETCH_ASSOC);
      if($row["userid"] == $id || $id == 1){
        ?>
        <p>
            <?php echo '<b>'.substr($files[$a], 13).'</b>'; ?>
            <a href="download.php?path=<?php echo urlencode($path) . '/' . urlencode($files[$a]); ?>">
            Download
            </a>
            <a href="delete.php?path=<?php echo urlencode($path) . '/' . urlencode($files[$a]); ?>&id=<?php echo $row["id"];?>", style="color: red;" >
              Delete
            </a>
            <?php 
            if($id == 1) {
              $sql = "SELECT username FROM users WHERE id = '".$row["userid"]."'";
              $result = $conn->query($sql);
              $row = $result->fetch(PDO::FETCH_ASSOC);
              echo " - ".$row["username"];
            }
            ?>
        </p>
        <?php
      }
    }

    $sql = "SELECT * FROM files WHERE f_name = '";
    
    for ($a = 2; $a < count($files); $a++)
    {
      $result = $conn->query($sql.$files[$a]."'");
      $row = $result->fetch(PDO::FETCH_ASSOC);
      if($row["userid"] != $id && $id != 1){
        ?>
        <p>
            <?php echo '</b>'.substr($files[$a], 13).'</b>'; ?>
            <a href="download.php?path=<?php echo urlencode($path) . '/' . urlencode($files[$a]); ?>">
            Download
            </a>
        </p>
        <?php
      }
    }
    ?>

    </body>

</html>