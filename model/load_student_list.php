<?php
	
	function load_student_list() {
		$connect = mysqli_connect("localhost","root","","cms-demo");

		for($i=1;$i<=$num_menu;++$i) {
			$menu_list[$i] = array();
			$result = mysqli_query($connect,"SELECT menu_title,menu_link FROM students WHERE menu_id=".$i." ;");
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