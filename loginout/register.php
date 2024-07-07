<?php 
$conn=require_once("config.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $password=$_POST["password"];
    //檢查帳號是否重複
    $check="SELECT * FROM users WHERE username='".$username."'";
    $result = $conn ->query($check);
    if($result ->rowCount()==0){
        do{
            $rand = rand();
            $check = "SELECT * FROM users WHERE id='".$rand."'";
            $result = $conn ->query($check);
        }while($result ->rowCount());
        $sql="INSERT INTO users (id,username, password,file_num)
            VALUES('". $rand ."','".$username."','".$password."', 0)";
        
        if($conn ->query($sql)){
            echo "註冊成功!3秒後將自動跳轉頁面<br>";
            echo "<a href='../index.php'>未成功跳轉頁面請點擊此</a>";
            header("refresh:3;url=../index.php");
            exit;
        }else{
            echo "Error creating table: " . $conn ->errorInfo();
        }
    }
    else{
        echo "該帳號已有人使用!<br>3秒後將自動跳轉頁面<br>";
        echo "<a href='register.html'>未成功跳轉頁面請點擊此</a>";
        header('HTTP/1.0 302 Found');
        header("refresh:3;url=register.php",true);
        exit;
    }
}


$conn = null;

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='index.php';
    </script>"; 
    
    return false;
} 
?>