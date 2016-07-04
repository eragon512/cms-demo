<?php
	function load_client_database_table($server,$username,$password,$db_name,$table_name) {
		if(!($connect = mysqli_connect($server,$username,$password,$db_name))) {
			die("Unable to connect to database");
		}
		$table_schema_result = mysqli_query($connect,"SELECT field FROM (DESCRIBE {$table_name}) ;");
		$table["schema"] = [];
		while($table_field = mysqli_fetch_array($table_schema_result,MYSQLI_ASSOC)) {
			array_push($table["schema"],$table_field);
		}
		$table_data_result = mysqli_query($connect,"SELECT * FROM {$table_name} ;");
		$table["data"] = [];
		while($table_row = mysqli_fetch_array($table_data_result,MYSQLI_ASSOC)) {
			array_push($table["data"],$table_row);
		}

		mysqli_close($connect);
		return $table;
	}

	print_r(load_client_database_table("localhost","root","","students","student_list"));