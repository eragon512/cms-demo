<?php
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		$page = $_GET["page_name"];
		if(!$page || !file_exists("../views/pages/".$page)) {
			die("Page does not exist");
		}
		file_put_contents("../views/pages/".$page, $_POST["page_data"]);

		header("Location: ../views/pages/".$page);
	}