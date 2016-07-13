<?php
	function create_client_database() {
		$num_fields = 4;
		$num_entries = count($_POST)/$num_fields;
		
		//print_r($_POST);

		require_once("load_database.php");
		$connect = load_database();

		for($i=1;$i<=$num_entries;++$i) {
			
			$server = mysqli_real_escape_string($connect,$_POST["client_database_".$i."_server"]);
			$username = mysqli_real_escape_string($connect,$_POST["client_database_".$i."_username"]);
			$password = mysqli_real_escape_string($connect,$_POST["client_database_".$i."_password"]);
			$name = mysqli_real_escape_string($connect,$_POST["client_database_".$i."_name"]);
			
			$stmt = $connect->prepare("INSERT INTO client_database_list(client_db_server,client_db_username,client_db_password,client_db_name) VALUES (?,?,?,?)");
			$stmt->bind_param("ssss",$server,$username,$password,$name);
			$stmt->execute();
			$stmt->close();
		}
		mysqli_close($connect);
	}

	function load_client_database_list() {
		require_once("load_database.php");
		$connect = load_database();
		$client_database_result = mysqli_query($connect,"SELECT * FROM client_database_list ;");
		$client_database_list = array();
		
		while($client_database = mysqli_fetch_array($client_database_result,MYSQLI_ASSOC)) {
			array_push($client_database_list, $client_database);
		}
		
		mysqli_close($connect);
		return $client_database_list;
	}

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

	function load_client_database_table($server,$username,$password,$db_name,$table_name,$sql_query) {
		if(!($connect = mysqli_connect($server,$username,$password,$db_name))) {
			die(Exception("Unable to connect to database"));
		}
		$table_schema_result = mysqli_query($connect,"DESCRIBE {$table_name} ;");
		$table["schema"] = array();
		while($table_field = mysqli_fetch_array($table_schema_result,MYSQLI_ASSOC)["Field"]) {
			array_push($table["schema"],$table_field);
		}
		$table_data_query = "SELECT * FROM {$table_name} ;";
		if($sql_query) $table_data_query = $sql_query;

		if($table_data_result = mysqli_query($connect,$table_data_query)) {
			$table["data"] = array();
			while($table_row = mysqli_fetch_array($table_data_result,MYSQLI_ASSOC)) {
				array_push($table["data"],$table_row);
			}

			mysqli_close($connect);
			return $table;
		} else {
			die("Invalid SQL Query");
		}
	}