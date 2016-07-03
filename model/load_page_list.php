<?php
	function load_page_list() {
		$page_list = scandir("../views/pages");
		unset($page_list[1]);
		unset($page_list[0]);
		return $page_list;
	}