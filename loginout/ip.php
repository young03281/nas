<?php

$ipc='';
$ipxff='';
$ipxf='';
$ipxc='';
$ipff='';
$ipf='';
$ipv='';
$ipa='';
$username=$_POST["username"];

if (!empty($_SERVER["HTTP_CLIENT_IP"])){
    $_SESSION["ip_client"] = $_SERVER["HTTP_CLIENT_IP"];
    $ipc=$_SESSION["ip_client"];
}
if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
    $_SESSION["ip_X_forwarded_for"] = $_SERVER["HTTP_X_FORWARDED_FOR"];
    $ipxff=$_SESSION["ip_X_forwarded_for"];
}
if(!empty($_SERVER["HTTP_X_FORWARDED"])){
    $_SESSION["ip_X_forwarded"] = $_SERVER["HTTP_X_FORWARDED"];
    $ipxf=$_SESSION["ip_X_forwarded"];
}
if(!empty($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"])){
    $_SESSION["ip_X_cluster"] = $_SERVER["HTTP_X_CLUSTER_CLIENT_IP"];
    $ipxc=$_SESSION["ip_X_cluster"];
}
if(!empty($_SERVER["HTTP_FORWARDED_FOR"])){
    $_SESSION["ip_forwarded_for"] = $_SERVER["HTTP_FORWARDED_FOR"];
    $ipff=$_SESSION["ip_forwarded_for"];
}
if(!empty($_SERVER["HTTP_FORWARDED"])){
    $_SESSION["ip_forwarded"] = $_SERVER["HTTP_FORWARDED"];
    $ipf=$_SESSION["ip_forwarded"];
}
if(!empty($_SERVER["HTTP_VIA"])){
    $_SESSION["ip_via"] = $_SERVER["HTTP_VIA"];
    $ipv=$_SESSION["ip_via"];
}
$_SESSION["addr"] = $_SERVER["REMOTE_ADDR"];
$ipa=$_SESSION["addr"];


$sql_ip="UPDATE users 
    SET client='".$ipc."', X_forwarded_for='".$ipxff."', X_forwarded='".$ipxf."', X_cluster='".$ipc."', fowarded_for='".$ipff."', 
    fowarded='".$ipf."', via='".$ipv."', addr='".$ipa."'
    WHERE username='".$username."'";


return $sql_ip;
?>