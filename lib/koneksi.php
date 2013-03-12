<?php
$host = "localhost";
$database = "cmlocat1_atm_neaby";
$user     = "cmlocat1_root";
$pass = "agusprasetyo811";		
	
$link = mysql_connect($host,$user,$pass) or die("Server tidak ditemukan");
mysql_select_db($database,$link)or die("Database tidak ditemukan");
