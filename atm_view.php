<?php
require("lib/koneksi.php");

$query = mysql_query("SELECT * FROM atm_data");
while($data = mysql_fetch_assoc($query)) {
	$atm_detail[] = $data;
}
echo json_encode($atm_detail);