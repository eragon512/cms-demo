<?php
	function find_page_id($page_name) {
		require("load_database.php");
		$connect = load_database();
		$result = mysqli_query("SELECT page_id FROM page_list WHERE page_name={$page_name}");
		if(!$result) {
			die("Invalid Page Name");
		}
		mysqli_close($connect);
		return $result["page_id"];
	}
	
	function insert_page($page_name) {
		require("load_database.php");
		$connect = load_database();
		$stmt = $connect->prepare("INSERT INTO page_list(page_name) VALUES (?) ;");
		$stmt->mysqli_bind_param("s",$page_name);
		mysqli_close($connect);
		return $page_id;
	}