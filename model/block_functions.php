<?php
	function create_block($block) {
		require_once("load_database.php");
		$connect = load_database();
		$stmt = $connect->prepare("INSERT INTO block_list(block_name,block_data) VALUES (?,?) ;");
		$stmt->bind_param("ss",$block["block_name"],$block["block_data"]);
		if(!$stmt->execute()) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$stmt->close();

		mysqli_close($connect);
	}

	function edit_block($block) {
		require_once("load_database.php");
		$connect = load_database();
		$stmt = $connect->prepare("UPDATE block_list SET block_data=? WHERE block_id=? ;");
		$stmt->bind_param("si",$block["block_data"],$block["block_id"]);
		if(!$stmt->execute()) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$stmt->close();

		mysqli_close($connect);
	}

	function delete_block($block) {
		require_once("load_database.php");
		$connect = load_database();
		$delete_block_result = mysqli_query($connect,"DELETE FROM block_list WHERE block_id={$block["block_id"]}");
		if(!$delete_block_result) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		mysqli_close($connect);
	}

	function load_block_list() {
		$block_list = [];
		require_once("load_database.php");
		$connect = load_database();
		$load_block_list_result = mysqli_query($connect,"SELECT * FROM block_list ;");
		if(!$load_block_list_result) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		while($block = mysqli_fetch_array($load_block_list_result,MYSQLI_ASSOC)) {
			array_push($block_list,$block);
		}
		mysqli_close($connect);
		return $block_list;
	}

	function load_block_data($panel_data) {
		$mod_data = $panel_data;
		$regex = "|<block>(.*)</[block]+>|U";
		preg_match_all($regex, $mod_data, $matches);
		//var_dump($matches);

		if($matches[1]) {
			$block_list = load_block_list();
			$mod_block_list = [];
			foreach($block_list as $block) {
				$mod_block_list[$block["block_name"]] = $block["block_data"];
			}

			foreach($matches[1] as $block_name) {
				$mod_data = preg_replace("|<block>".$block_name."</[block]+>|U",$mod_block_list[$block_name],$mod_data);
			}
		}

		return $mod_data;
	}