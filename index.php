<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    
    if($_SESSION["id"] == "1"){header("location: ./nas/nas_admin.php");}
    else{header("location: ./nas/nas_guest.php");}
    exit;  //記得要跳出來，不然會重複轉址過多次
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>登入</title>
</head>
<body>
    <h3>選擇登入或是註冊帳號</h3>
<form method="post" action="./loginout/login.php">
帳號：
<input type="text" name="username"><br/><br/>
密碼：
<input type="password" name="password"><br><br>
<input type="submit" value="登入" name="submit"><br><br>
<a href="./loginout/register.html">還沒有帳號？現在就註冊！</a>
</form>
</body>
</html>
