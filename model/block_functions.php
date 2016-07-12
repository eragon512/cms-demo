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