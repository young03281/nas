<!DOCTYPE html>

<?php
// Include config file
$conn=require_once "config.php";
 
// Define variables and initialize with empty values
$username="young922123";
$password="11220328";
//增加hash可以提高安全性
$password_hash=password_hash($password,PASSWORD_DEFAULT);
$sql = "SELECT * FROM user WHERE username ='".$username."'";
$result=mysqli_query($conn,$sql);
$res=mysqli_num_rows($result);
$id=mysqli_fetch_assoc($result)["id"];
?> 
<html>
    <body>
        <p>
            <?php echo $res; ?><br>
            <?php echo $id; ?>
        </p>
    </body>
</html>