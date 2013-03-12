<?php
require("lib/koneksi.php");

@$lat= $_GET['lat']; // -6.909013
@$long = $_GET['long']; //107.625128
@$sum = $_GET['sum']; //5
@$nm_atm = $_GET['atm']; //BCA
@$radius = $_GET['radius']; //25 (KM)

if ($lat && $long) {
	if ($sum != "" && $nm_atm != "" && $radius != "") {
		$my_query = "SELECT latitude, longitude, ( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( latitude ) ) ) ) AS distance, nm_atm, alamat FROM atmgis WHERE nm_atm LIKE '%".$nm_atm."%' HAVING distance < ".$radius." ORDER BY distance LIMIT ". $sum;	
	} else if ($nm_atm != "" && $sum != "" ) {
		$my_query = "SELECT latitude, longitude, ( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( latitude ) ) ) ) AS distance, nm_atm, alamat FROM atmgis WHERE nm_atm LIKE '%".$nm_atm."%' HAVING distance < 25 ORDER BY distance LIMIT ". $sum;
	} else if ($nm_atm != "" && $radius != "") {
		$my_query = "SELECT latitude, longitude, ( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( latitude ) ) ) ) AS distance, nm_atm, alamat FROM atmgis WHERE nm_atm LIKE '%".$nm_atm."%' HAVING distance < ".$radius." ORDER BY distance LIMIT 5";
	} else if ($nm_atm != "") {
		$my_query = "SELECT latitude, longitude, ( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( latitude ) ) ) ) AS distance, nm_atm, alamat FROM atmgis WHERE nm_atm LIKE '%".$nm_atm."%' HAVING distance < 25 ORDER BY distance LIMIT 5";
	} else if ($radius != "") {
		$my_query = "SELECT latitude, longitude, ( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( latitude ) ) ) ) AS distance, nm_atm, alamat FROM atmgis HAVING distance < ".$radius." ORDER BY distance LIMIT 5";
	} else if ($sum != "") {
		$my_query = "SELECT latitude, longitude, ( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( latitude ) ) ) ) AS distance, nm_atm, alamat FROM atmgis HAVING distance < 25 ORDER BY distance LIMIT ". $sum;
	} else {
		$my_query = "SELECT latitude, longitude, ( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( latitude ) ) ) ) AS distance, nm_atm, alamat FROM atmgis HAVING distance < 25 ORDER BY distance LIMIT 5";
	}
	
	$query = mysql_query($my_query);
	if (mysql_num_rows($query) == 0) {
		echo '[]';
	} else {
		while($data = mysql_fetch_assoc($query)) {
			$atm_detail[] = $data;
		}
		echo json_encode($atm_detail);
	}
} else {
	echo '{"data":"NULL"}';
}


