<?php
	 include_once('db.php');
	 function get_systems($limit=50){
	 	global $conn;
	 	$query = mysqli_query($conn, "SELECT * FROM systems LIMIT $limit") or die("Error: ".mysqli_error($conn));
	 	$data = array();

	 	while ($temp = mysqli_fetch_assoc($query)) {
	 		$data[]=  $temp;
	 	}
	 	return $data;
	 }
?>