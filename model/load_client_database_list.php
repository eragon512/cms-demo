<?php
	function load_client_database_list() {
		require("load_database.php");
		$connect = load_database();
		$client_database_result = mysqli_query($connect,"SELECT * FROM client_database_list ;");
		$client_database_list = [];
		
		while($client_database = mysqli_fetch_array($client_database_result,MYSQLI_ASSOC)) {
			array_push($client_database_list, $client_database);
		}
		
		mysqli_close($connect);
		return $client_database_list;
	}