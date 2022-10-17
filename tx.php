#!/usr/local/bin/php
<?php
// Program that does TX and returns tx frequency to stdout 
// usage tx.php radio  1|0 (tx/rx) 


$host = "127.0.0.1"; 
$port = $argv[1]; 
$cmd = $argv[2]; 
$socket = socket_create(AF_INET,SOCK_STREAM,0) or die ("Could not create socket\n"); 
$result = socket_connect($socket,$host,$port) or die ("Count not connect to host\n"); 

if($cmd == "1"){ 
	$message = "T 1\n"; 
	socket_write($socket,$message,strlen($message)) or die ("Could not write to socket\n"); 
	$result = socket_read ($socket,1024) or die ("no response from server\n"); 
	$message = "f\n"; 
	socket_write($socket,$message,strlen($message)) or die ("Could not write to socket\n"); 
	$result = socket_read ($socket,1024) or die ("no response from server\n"); 
	echo "$result"; 
}

if($cmd == "0"){ 
	$message = "T 0\n"; 
	socket_write($socket,$message,strlen($message)) or die ("Could not write to socket\n"); 
	$result = socket_read ($socket,1024) or die ("no response from server\n"); 
	echo "RX\n"; 
}



socket_close($socket); 

