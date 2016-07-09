<?php
	function find_page_id($page_name) {
		require_once("load_database.php");
		$connect = load_database();
		$find_page_result = mysqli_query($connect,"SELECT page_id FROM page_list WHERE page_name={$page_name}");
		if(!$find_page_result) {
			die("Invalid Page Name");
		}
		mysqli_close($connect);
		return $find_page_result["page_id"];
	}
	
	function create_page($page_name) {
		require_once("load_database.php");
		$connect = load_database();
		$stmt = $connect->prepare("INSERT INTO page_list(page_name) VALUES (?) ;");
		$stmt->bind_param("s",$page_name);
		if(!$stmt->execute()) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$stmt->close();
		mysqli_close($connect);
		
		$page_id = find_page_id($page_name);
		require_once("panel_functions.php");
		create_panel($page_id,array(
			"panel_id" => 0,
			"panel_parent_id" => 1,
			"panel_height" => 100,
			"panel_width" => 100,
			"panel_class" => "top"
		));
	}

	function load_page_list() {
		require_once("load_database.php");
		$connect = load_database();
		$page_list = [];
		$load_page_list_result = mysqli_query($connect,"SELECT * FROM page_list");
		while($page = mysqli_fetch_array($load_page_list_result,MYSQLI_ASSOC)) {
			array_push($page_list,$page);
		}
		mysqli_close($connect);
		return $page_list;
	}

	function load_page($page_id) {
		require_once("load_database.php");
		$connect = load_database();
		$page_result = mysqli_query($connect,"SELECT * FROM page_list WHERE page_id={$page_id};");
		$page = mysqli_fetch_array($page_result,MYSQLI_ASSOC);
		
		$page["panel"] = [];
		$page_panel_list_result = mysqli_query($connect,"SELECT * FROM panel_list WHERE page_id={$page_id} ;");
		if(!$page_panel_list_result) {
			echo mysqli_error($connect);
			//die();
		} else {
			while($panel = mysqli_fetch_array($page_panel_list_result,MYSQLI_ASSOC)) {
				array_push($page["panel"],$panel);
			}
		}
		mysqli_close($connect);
		
		//var_dump($page);
		return $page;
	}