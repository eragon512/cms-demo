<?php
	function find_page_id($page_name) {
		require_once("load_database.php");
		$connect = load_database();
		$find_page_result = mysqli_query($connect,"SELECT page_id FROM page_list WHERE page_name='{$page_name}' ;");
		if(!$find_page_result) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die(",\nInvalid Page Name");
		}
		$page_id = mysqli_fetch_array($find_page_result,MYSQLI_ASSOC)["page_id"];
		mysqli_close($connect);
		return $page_id;
	}
	
	function create_page($page) {
		require_once("load_database.php");
		$connect = load_database();
		$stmt = $connect->prepare("INSERT INTO page_list(page_name,layout_id) VALUES (?,?) ;");
		$stmt->bind_param("si",$page["page_name"],$page["layout_id"]);
		if(!$stmt->execute()) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$stmt->close();

		$page_id = find_page_id($page["page_name"]);
		$page_data_result = mysqli_query($connect,"SELECT * FROM panel_list WHERE layout_id={$page["layout_id"]} ;");
		$page_data = [];
		while($panel = mysqli_fetch_array($page_data_result,MYSQLI_ASSOC)) {
			$page_data[(int)$panel["panel_child_id"]] = NULL;
		}
		store_page_data($page_id,$page["layout_id"],$page_data);

		mysqli_close($connect);
	}

	function load_page_list() {
		require_once("load_database.php");
		$connect = load_database();
		$page_list = [];
		$load_page_list_result = mysqli_query($connect,"SELECT * FROM page_list ;");
		if(!$load_page_list_result) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
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
		if(!$page_result || mysqli_num_rows($page_result) === 0) {
			return false;
		}
		$page = mysqli_fetch_array($page_result,MYSQLI_ASSOC);
		mysqli_close($connect);
		return $page;
	}

	function store_page_data($page_id,$layout_id,$page_data) {
		if(isset($page_id) && isset($layout_id)) {
			require_once("load_database.php");
			$connect = load_database();

			foreach($page_data as $id => $data) {
				$panel_id = $id;
				$panel_data = $data;
				$page_panel_result = mysqli_query($connect,"SELECT * FROM page_panel_list WHERE page_id={$page_id} AND layout_id={$layout_id} AND panel_child_id={$panel_id} ;");
				if($page_panel_result) {
					if(mysqli_num_rows($page_panel_result) === 0) {
						$stmt = $connect->prepare("INSERT INTO page_panel_list(page_id,layout_id,panel_child_id,panel_data) VALUES(?,?,?,?) ;");
						$stmt->bind_param("iiis",$page_id,$layout_id,$panel_id,$panel_data);
						$stmt->execute();
						echo $stmt->error;
						$stmt->close();
					}
					else {
						$stmt = $connect->prepare("UPDATE page_panel_list SET panel_data=? WHERE page_id=? AND layout_id=? AND panel_child_id=? ;");
						$stmt->bind_param("siii",$panel_data,$page_id,$layout_id,$panel_id);
						$stmt->execute();
						echo $stmt->error;
						$stmt->close();
					}
				} else {
					echo mysqli_error($connect);
				}
			}
			mysqli_close($connect);
		}
	}