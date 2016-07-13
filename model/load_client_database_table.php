<?php
	function load_client_database_table($server,$username,$password,$db_name,$table_name,$sql_query) {
		if(!($connect = mysqli_connect($server,$username,$password,$db_name))) {
			die(Exception("Unable to connect to database"));
		}
		$table_schema_result = mysqli_query($connect,"DESCRIBE {$table_name} ;");
		$table["schema"] = [];
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

	//var_dump(load_client_database_table("localhost","root","","students","students_list"));