<?php
	function find_layout_id($layout_name) {
		require_once("load_database.php");
		$connect = load_database();
		$find_layout_result = mysqli_query($connect,"SELECT layout_id FROM layout_list WHERE layout_name='{$layout_name}' ;");
		
		if(!$find_layout_result) {
			echo mysqli_error($connect)." SELECT layout_id FROM layout_list WHERE layout_name='{$layout_name}' ;";
			mysqli_close($connect);
			die("\nInvalid Layout Name");
		}

		$layout_id = mysqli_fetch_array($find_layout_result,MYSQLI_ASSOC)["layout_id"];
		mysqli_close($connect);
		return $layout_id;
	}
	
	function create_layout($layout_name) {
		require_once("load_database.php");
		$connect = load_database();
		$stmt = $connect->prepare("INSERT INTO layout_list(layout_name) VALUES (?) ;");
		$stmt->bind_param("s",$layout_name);
		if(!$stmt->execute()) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$stmt->close();
		mysqli_close($connect);
		
		$layout_id = find_layout_id($layout_name);
		require_once("panel_functions.php");
		create_panel($layout_id,array(
			"panel_id" => 0,
			"panel_child_id" => 1,
			"panel_height" => 100,
			"panel_width" => 100,
			"panel_class" => "top"
		));
	}

	function load_layout_list() {
		require_once("load_database.php");
		$connect = load_database();
		$layout_list = [];
		$load_layout_list_result = mysqli_query($connect,"SELECT * FROM layout_list");
		while($layout = mysqli_fetch_array($load_layout_list_result,MYSQLI_ASSOC)) {
			array_push($layout_list,$layout);
		}
		mysqli_close($connect);
		return $layout_list;
	}

	function load_layout($layout_id) {
		require_once("load_database.php");
		$connect = load_database();
		$layout_result = mysqli_query($connect,"SELECT * FROM layout_list WHERE layout_id={$layout_id};");
		$layout = mysqli_fetch_array($layout_result,MYSQLI_ASSOC);
		
		$layout["panel"] = [];
		$layout_panel_list_result = mysqli_query($connect,"SELECT * FROM panel_list WHERE layout_id={$layout_id} ;");
		if(!$layout_panel_list_result) {
			echo mysqli_error($connect);
			//die();
		} else {
			while($panel = mysqli_fetch_array($layout_panel_list_result,MYSQLI_ASSOC)) {
				array_push($layout["panel"],$panel);
			}
		}
		mysqli_close($connect);
		
		//var_dump($layout);
		return $layout;
	}