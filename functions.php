<?php

	include_once "admin/db.php";
	function get_crops($system)
	{
		global $conn;

		$query = $conn->query("SELECT * FROM system_crops WHERE system = \"$system\" ") or die("get system crpos $conn->error");
		$crops = array();

		while ($data = $query->fetch_assoc()) {
			$crops[] = $data;
		}

		return $crops;
	}

	function get_systems($user){
		global $conn;

		$query = $conn->query("SELECT * FROM systems WHERE ownerId = \"$user\" ") or die("Get systems $conn->error");
		$systems = array();

		while ($data = $query->fetch_assoc()) {
			$systems[] = $data;
		}

		return $systems;
	}

?>