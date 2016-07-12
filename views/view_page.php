<?php
	require_once("../model/panel_functions.php");
	require_once("../model/page_functions.php");
	if(!isset($_GET["page_id"])) {
		die("No page id found");
	}
	$page_id = $_GET["page_id"];
	if(!($page = load_page($page_id))) {
		die("Invalid Page Id");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<style>
			html,body {
				height: 100%;
				width : 100%;
				position: absolute;
				display: table;
				margin: 0;
				padding: 0;
			}
			body {
				display: flex;
			}
			.panel {
			}
			.wrapper {
				height: 100%;
				width: 100%;
				display: flex;
			}
			.horizontal-wrapper {
				flex-direction: row;
			}
			.vertical-wrapper {
				flex-direction: column;
			}
		</style>
	</head>
	<body>
		<?php load_panel($page["layout_id"],"page-view",$page["page_id"]);?>

	</body>
</html>