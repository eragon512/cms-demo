<?php
	require('../model/load_menu_list.php');
	$menu_list = load_menu_list();

	foreach($menu_list as $menu_data) {
		echo "<ul>\n";
		foreach($menu_data as $link_data) {
			echo "<li><a href='../views/".$link_data["menu_link"]."'>".$link_data["menu_title"]."</a></li>\n";
		}
		echo "</ul>\n\n";
	}