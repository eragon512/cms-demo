<?php
	require("../model/page_functions.php");
	if(!isset($_GET["page_id"])) {
		die("No page id found");
	}
	$page_id = $_GET["page_id"];
	if(!($page = load_page($page_id))) {
		die("Invalid Page Id");
	}
	require("../model/panel_functions.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<style>
			html,body {
				height: 95%;
				width: 95%;

			}
			.panel {
				border: 1px solid red;
				display: inline-flex;
			}
		</style>
	</head>
	<body>
		<?php load_panel($page_id,0,"view"); ?>
	</body>
</html>