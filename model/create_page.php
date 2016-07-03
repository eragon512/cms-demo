<?php
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		foreach($_POST as $page) {
			file_put_contents("../views/pages/".$page.".php","");
		}
		die(header("Location: ../views/view_page_list.php"));
	}