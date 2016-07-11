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

	function split_panel($layout_id,$panel_id,$cut_direction,$height_width) {

		$panel1["panel_id"] = $panel2["panel_id"] = (int)$panel_id;
		$panel1["panel_child_id"] = $panel1["panel_id"]*2;
		$panel2["panel_child_id"] = $panel2["panel_id"]*2 + 1;

		if($cut_direction === "horizontal") {
			$panel1["panel_width"] = $panel2["panel_width"] = 100;
			$panel1["panel_height"] = (int) $height_width;
			$panel2["panel_height"] = 100 - $panel1["panel_height"];
			$panel1["panel_class"] = "top";
			$panel2["panel_class"] = "bottom";
		} else if($cut_direction === "vertical") {
			$panel1["panel_height"] = $panel2["panel_height"] = 100;
			$panel1["panel_width"] = (int) $height_width;
			$panel2["panel_width"] = 100 - $panel1["panel_width"];
			$panel1["panel_class"] = "left";
			$panel2["panel_class"] = "right";
		} else {
			die("Invalid cut_direction");
		}
		//var_dump($panel1);
		//var_dump($panel2);

		create_panel($layout_id,$panel1);
		create_panel($layout_id,$panel2);
	}

	$panel_tracker = [];

	function load_panel_util($layout_id,$panel_id,$mode,$page_id,& $visited) {
		if(isset($layout_id) && isset($panel_id)) {
			$panel_query = "";
			if($mode === "layout-edit" || $mode === "layout-view") {
				$panel_query = "SELECT * FROM panel_list WHERE layout_id={$layout_id} AND panel_id={$panel_id} ;";
			} else if ($mode === "page-edit" || $mode === "page-view") {
				if(isset($page_id)) {
					$panel_query = "SELECT * FROM panel_list NATURAL LEFT JOIN page_panel_list WHERE layout_id={$layout_id} AND panel_id={$panel_id} AND page_id={$page_id};";
				} else {
					die("Invalid Page ID");
				}
			} else {
				die("Invalid Mode");
			}

			require_once("load_database.php");
			$connect = load_database();
			
			$load_panel_result = mysqli_query($connect,$panel_query);
			if(!$load_panel_result || mysqli_num_rows($load_panel_result) === 0) {
				
				echo mysqli_error($connect);
				//array_push($GLOBALS['panel_tracker'],$panel_id);
				//load_panel(NULL,NULL,$mode);
				mysqli_close($connect);
				return false;
			} else {
				//echo mysqli_num_rows($load_panel_result)."\n";
				$panel_list = [];
				while($panel = mysqli_fetch_array($load_panel_result,MYSQLI_ASSOC)) {
					array_push($panel_list,$panel);
				}
				unset($panel);
				mysqli_close($connect);

				if($panel_list[0]["panel_class"] === "top" || $panel_list[0]["panel_class"] === "bottom") {
					echo "<div class='wrapper vertical-wrapper'>";
				} else if($panel_list[0]["panel_class"] === "left" || $panel_list[0]["panel_class"] === "right") {
					echo "<div class='wrapper horizontal-wrapper'>";
				} else {
					echo "<div>";
				}

				foreach($panel_list as $panel) {
					echo "<div name='panel{$panel["panel_id"]}' id=".(int)$panel["panel_child_id"]." class='panel {$panel["panel_class"]}' style='height:{$panel["panel_height"]}%; width:{$panel["panel_width"]}%;' >\n";
						array_push($GLOBALS['panel_tracker'],(int)$panel["panel_child_id"]);
						$visited[(int)$panel["panel_child_id"]] = true;
						
						if(!load_panel_util($layout_id,(int)$panel["panel_child_id"],$mode,$page_id,$visited)) {
							echo "<div class='panel-content'>";
							
							if($mode === "layout-edit") {
								echo "<button type='button' onclick='split_panel(this.parentNode.parentNode.id);'>click to split</button>";
								}
							else if($mode === "layout-view") {
								echo "";
							}
							else if($mode === "page-edit") {
								if(isset($panel["page_id"]) && $panel["page_id"] === $page_id) {
									echo "<textarea name={$panel["panel_child_id"]}>{$panel["panel_data"]}{$panel["page_id"]}</textarea><br>";
								} else {
									echo "<textarea name={$panel["panel_child_id"]}></textarea><br>";
								}
							}
							else if($mode === "page-view") {
								echo "{$panel["panel_data"]}";
							}
							else {
								echo "Invalid Mode";
							}
							echo "</div>";
						}
					echo "</div>\n";
				}
				echo "</div>\n";
			}
			return true;
		}
		return false;
	}

	function load_panel($layout_id,$mode,$page_id) {
		$visited = [];
		if($mode === "page-edit") {
			echo "<form method='POST' action='' class='wrapper vertical-wrapper'>";
			load_panel_util($layout_id,0,$mode,$page_id,$visited);
			echo "<div class='horizontal-wrapper'><button type='submit'>Change Text</button><a href='view_page.php?page_id={$page_id}'><button type='button'>View Page</button></a></div></form>";
		} else {
			load_panel_util($layout_id,0,$mode,$page_id,$visited);
		}
		var_dump($visited);
	}

	function load_panel_list($layout_id) {
		require_once("load_database.php");
		$connect = load_database();
		
		$panel_list = [];
		$panel_list_result = mysqli_query($connect,"SELECT * FROM panel_list WHERE layout_id={$layout_id} ;");
		if(!$panel_list_result) {
			echo mysqli_error($connect);
			mysqli_close($connect);
			die("...");
		} else {
			$panel_list = [];
			while($panel = mysqli_fetch_array($panel_list_result,MYSQLI_ASSOC)) {
				$panel_list[(int)$panel["panel_child_id"]] = $panel;
			}
		}
		mysqli_close($connect);
		
		//var_dump($layout);
		return $panel_list;
	}