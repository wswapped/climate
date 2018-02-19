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
	function next_message($field){
		//Next message to be sent
		global $conn;

		$query = $conn->query("SELECT * FROM field_messages JOIN messages ON field_messages.message = messages.id WHERE field_messages.field = \"$field\" LIMIT 1");
		return $query->fetch_assoc();
	}

?>