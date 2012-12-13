<?php
require("lib/koneksi.php");

@$lat= $_GET['lat'];
@$long = $_GET['long'];

if ($lat && $long) {
	$query = mysql_query("SELECT id, ( 3959 * acos( cos( radians(37) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($long) ) + sin( radians($lat) * sin( radians( latitude ) ) ) ) AS distance FROM atm_data HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;");
	while($data = mysql_fetch_assoc($query)) {
		$atm_detail[] = $data;
	}
	echo json_encode($atm_detail);
} else {
	echo '{"data":"NULL"}';
}