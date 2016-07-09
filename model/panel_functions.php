<?php
	function create_panel($layout_no,$panel) {
		require_once("load_database.php");
		$connect = load_database();
		
		$stmt = $connect->prepare("INSERT INTO panel_list(layout_id,panel_id,panel_child_id,panel_height,panel_width,panel_class) VALUES (?,?,?,?,?,?) ;");
		$stmt->bind_param("iiiiis",$layout_no,$panel["panel_id"],$panel["panel_child_id"],$panel["panel_height"],$panel["panel_width"],$panel["panel_class"]);
		if(!$stmt->execute()) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die();
		}
		$stmt->close();
		mysqli_close($connect);
	}

	//$panel_tracker = [];

	function load_panel($layout_id,$panel_id,$mode) {
		if(isset($layout_id) && isset($panel_id)) {
			require_once("load_database.php");
			$connect = load_database();
			$load_panel_result = mysqli_query($connect,"SELECT * FROM panel_list WHERE layout_id={$layout_id} AND panel_id={$panel_id} ;");
			if(!$load_panel_result || mysqli_num_rows($load_panel_result) === 0) {
				echo mysqli_error($connect);
				//array_push($GLOBALS['panel_tracker'],$panel_id);
				load_panel(NULL,NULL,$mode);
			} else {
				//echo mysqli_num_rows($load_panel_result)."\n";
				$panel_list = [];
				while($panel = mysqli_fetch_array($load_panel_result,MYSQLI_ASSOC)) {
					array_push($panel_list,$panel);
				}

				if($panel_list[0]["panel_class"] === "top" || $panel_list[0]["panel_class"] === "bottom") {
					echo "<div class='wrapper vertical-wrapper'>";
				} else if($panel_list[0]["panel_class"] === "left" || $panel_list[0]["panel_class"] === "right") {
					echo "<div class='wrapper horizontal-wrapper'>";
				} else {
					echo "<div>";
				}

				foreach($panel_list as $panel) {
					echo "<div name='panel{$panel["panel_id"]}' id=".(int)$panel["panel_child_id"]." class='panel {$panel["panel_class"]}' style='height:{$panel["panel_height"]}%; width:{$panel["panel_width"]}%;' >\n";
						//array_push($GLOBALS['panel_tracker'],(int)$panel["panel_child_id"]);
						load_panel($layout_id,(int)$panel["panel_child_id"],$mode);
					echo "</div>";
				}
				echo "</div>";
			}
			mysqli_close($connect);
		}
		else {
			if($mode === "edit") {
				echo "<div class='panel-content'><button type='button' onclick='split_panel(this.parentNode.parentNode.id);'>click to split</button></div>";
			}
			else if($mode === "view") {
				echo "<div class='panel-content'>Should show panel content here</div>";
			}
		}
		return;
	}