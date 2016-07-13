<?php
	function load_client_database($server,$username,$password,$name) {
		if(!($connect = mysqli_connect($server,$username,$password,$name))) {
			die(Exception("Unable to connect to database"));
		}
		$client_database = array();
		$result = mysqli_query($connect,"show tables");
		while($client_table = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			array_push($client_database,$client_table["Tables_in_".$name]);
		}

		mysqli_close($connect);
		return $client_database;
	}