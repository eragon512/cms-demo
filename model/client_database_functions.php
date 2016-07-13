<?php
	function create_client_database($database) {
		require_once("load_database.php");
		$connect = load_database();
		
		$stmt = $connect->prepare("INSERT INTO client_database_list(client_db_server,client_db_username,client_db_password,client_db_name) VALUES (?,?,?,?)");
		$stmt->bind_param("ssss",$database["client_database_server"],$database["client_database_username"],$database["client_database_password"],$database["client_database_name"]);
		if(!$stmt->execute()) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$stmt->close();
		mysqli_close($connect);
	}

	function edit_client_database($database) {
		require_once("load_database.php");
		$connect = load_database();

		var_dump($database);
		
		$stmt = $connect->prepare("UPDATE client_database_list SET client_db_server=? ,client_db_username=? ,client_db_password=? WHERE client_db_id=? ;");
		$stmt->bind_param("sssi",$database["client_db_server"],$database["client_db_username"],$database["client_db_password"],$database["client_db_id"]);
		if(!$stmt->execute()) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$stmt->close();
		mysqli_close($connect);
	}

	function delete_client_database($database) {
		require_once("load_database.php");
		$connect = load_database();
		
		$delete_client_database_result = mysqli_query($connect,"DELETE FROM client_database_list WHERE client_db_id={$database["client_db_id"]} ;");
		if(!$delete_client_database_result) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$stmt->close();
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

	function load_client_database($client_db_id) {
		require_once("load_database.php");
		$connect = load_database();
		$load_client_database_result = mysqli_query($connect,"SELECT * FROM client_database_list WHERE client_db_id={$client_db_id} ;");
		if(!$load_client_database_result) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$database = mysqli_fetch_array($load_client_database_result,MYSQLI_ASSOC);
		mysqli_close($connect);
		return $database;
	}

	function load_client_database_table_list($db_id) {
		$database = load_client_database($db_id);
		$connect_client = mysqli_connect($database["client_db_server"],$database["client_db_username"],$database["client_db_password"],$database["client_db_name"]);
		if(!$connect_client) {
			echo mysqli_error($connect_client);
			die("\nUnable to connect to database");
		}

		$client_database_table_list = array();
		$result = mysqli_query($connect_client,"show tables");
		while($client_table = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			array_push($client_database_table_list,$client_table["Tables_in_".$database["client_db_name"]]);
		}

		mysqli_close($connect_client);
		return $client_database_table_list;
	}

	function load_client_database_table($db_id,$table_name) {
		$database = load_client_database($db_id);
		$connect_client = mysqli_connect($database["client_db_server"],$database["client_db_username"],$database["client_db_password"],$database["client_db_name"]);
		if(!$connect_client) {
			echo mysqli_error($connect_client);
			die("\nUnable to connect to database");
		}

		$table_data = array();
		$table_data_query = "SELECT * FROM {$table_name} ;";

		if($table_data_result = mysqli_query($connect_client,$table_data_query)) {
			
			while($table_row = mysqli_fetch_array($table_data_result,MYSQLI_ASSOC)) {
				array_push($table_data,$table_row);
			}
			mysqli_close($connect_client);
			return $table_data;
		} else {
			die("Table not found");
		}
	}

	function create_client_database_query($client_db_id,$query) {
		require_once("load_database.php");
		$connect = load_database();
		$stmt = $connect->prepare("INSERT INTO client_database_query_list(client_db_id,client_db_query_name,client_db_query_content) VALUES (?,?,?) ;");
		$stmt->bind_param("iss",$client_db_id,$query["client_db_query_name"],$query["client_db_query_content"]);
		if(!$stmt->execute()) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$stmt->close();

		mysqli_close($connect);
	}

	function edit_client_database_query($client_db_id,$query) {
		require_once("load_database.php");
		$connect = load_database();
		$stmt = $connect->prepare("UPDATE client_database_query_list SET client_db_query_content=? WHERE client_db_id=? AND client_db_query_id=? ;");
		$stmt->bind_param("sii",$query["client_db_query_content"],$client_db_id,$query["client_db_query_id"]);
		if(!$stmt->execute()) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$stmt->close();

		mysqli_close($connect);
	}

	function delete_client_database_query($client_db_id,$query) {
		require_once("load_database.php");
		$connect = load_database();
		$delete_block_result = mysqli_query($connect,"DELETE FROM client_database_query_list WHERE client_db_id={$client_db_id} AND client_db_query_id={$query["client_db_query_id"]} ;");
		if(!$delete_block_result) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		mysqli_close($connect);
	}

	function load_client_database_query_list() {
		$client_database_query_list = array();
		require_once("load_database.php");
		$connect = load_database();
		$load_client_database_query_list_result = mysqli_query($connect,"SELECT * FROM client_database_query_list ;");
		if(!$load_client_database_query_list_result) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		while($client_database_query = mysqli_fetch_array($load_client_database_query_list_result,MYSQLI_ASSOC)) {
			array_push($client_database_query_list,$client_database_query);
		}
		mysqli_close($connect);
		return $client_database_query_list;
	}

	function load_client_db_query_result($query)  {
		require_once("load_database.php");
		$connect = load_database();
		$load_client_database_query_result = mysqli_query($connect,"SELECT * FROM client_database_query_list NATURAL JOIN client_database_list WHERE client_db_query_id={$query["client_db_query_id"]} ;");
		if(!$load_client_database_query_result) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$client_db_query = mysqli_fetch_array($load_client_database_query_result,MYSQLI_ASSOC);
		mysqli_close($connect);

		$connect_client = mysqli_connect($client_db_query["client_db_server"],$client_db_query["client_db_username"],$client_db_query["client_db_password"],$client_db_query["client_db_name"]);
		if(!$connect_client) {
			die("Unable to connect to database, please check the credentials for database access");
		}
		$client_db_query_result_result = mysqli_query($connect_client,$client_db_query["client_db_query_content"]);
		if(!$client_db_query_result_result) {
			$client_db_query_result = mysqli_error($connect_client);
			mysqli_close($connect_client);
			return $client_db_query_result;
		}
		$client_db_query_result = array();
		while($client_db_query_result_row = mysqli_fetch_array($client_db_query_result_result,MYSQLI_ASSOC)) {
			array_push($client_db_query_result,$client_db_query_result_row);
		}
		mysqli_close($connect_client);
		
		return $client_db_query_result;
	}

	function load_query_table($query_result) {
		if($query_result) {
			$query_table_headings_list = array_keys($query_result[0]);
			//var_dump($query_result);
			//var_dump($query_table_headings_list);
		
			$query_table = "<table>\n<tr>";
			foreach($query_table_headings_list as $query_table_headings) {
				$query_table .= "<th>{$query_table_headings}</th>";
			}
			$query_table .= "</tr>\n";
			foreach($query_result as $query_table_row) {
				$query_table .= "<tr>";
				foreach($query_table_row as $query_table_cell) {
					$query_table .= "<td>{$query_table_cell}</td>";
				}
				$query_table .= "</tr>\n";
			}
			$query_table .= "</tr>\n</table>\n";
			return $query_table;
		}
	}

	function load_client_database_query_data($panel_data) {
		$mod_data = $panel_data;
		$regex = "|<db_query>(.*)</[db_query]+>|U";
		preg_match_all($regex, $mod_data, $matches);
		//var_dump($matches);

		if($matches[1]) {
			$client_db_query_list = load_client_database_query_list();
			$mod_client_db_query_list = array();
			foreach($client_db_query_list as $client_db_query) {
				$mod_client_db_query_list[$client_db_query["client_db_query_name"]] = load_query_table(load_client_db_query_result($client_db_query));
			}

			foreach($matches[1] as $client_db_query_name) {
				$mod_data = preg_replace("|<db_query>".$client_db_query_name."</[db_query]+>|U",$mod_client_db_query_list[$client_db_query_name],$mod_data);
			}
		}

		return $mod_data;
	}