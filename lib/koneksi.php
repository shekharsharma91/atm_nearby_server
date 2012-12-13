<?php
$host = "localhost";
$database = "atm-nearby-server";
$user     = "root";
$pass = "";		
	
$link = mysql_connect($host,$user,$pass) or die("Server tidak ditemukan");
mysql_select_db($database,$link)or die("Database tidak ditemukan");
