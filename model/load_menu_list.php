<?php
	function load_menu_list() {
		require("load_database.php");
		$connect = load_database();

		$num_menu = (int)(mysqli_fetch_array(mysqli_query($connect,"SELECT MAX(menu_id) AS last_id FROM menu_list;"))["last_id"]);
		$menu_list = array();
		for($i=1;$i<=$num_menu;++$i) {
			$menu_list[$i] = array();
			$result = mysqli_query($connect,"SELECT menu_title,menu_link FROM menu_list WHERE menu_id=".$i." ;");
			//echo "<ul>\n";
			while($menu_row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				//print_r($menu_row);
				//echo "<li><a href='../views/".$menu_row["menu_link"]."'>".$menu_row["menu_title"]."</a></li>\n";
				array_push($menu_list[$i],$menu_row);
			}
			//echo "</ul>\n\n";
		}
		mysqli_close($connect);
		return $menu_list;
	}