<?php
	require_once("../model/page_functions.php");
	require_once("../model/layout_functions.php");
	require_once("../model/panel_functions.php");
	if(!isset($_GET["page_id"])) {
		die("No page id found");
	}
	$page_id = $_GET["page_id"];
	if(!($page = load_page($page_id))) {
		die("Invalid Page Id");
	}
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		store_page_data($page["page_id"],$page["layout_id"],$_POST);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<style>
			html,body {
				height: 100%;
				width : 100%;
				max-height: 100%;
				max-width: 100%;
			}
			body {
				display: flex;
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
			.panel {
				box-sizing: border-box;
				border: 1px solid red;
			}
			.panel-content {
				max-height: 100%;
				max-width: 100%;
				height: 100%;
				width: 100%;
				overflow: auto;
			}
			textarea {
				max-width: 100%;
				max-height: 100%;
				min-width: 80%;
				min-height: 80%;
			}
		</style>
	</head>
	<body>
		<?php load_panel($page["layout_id"],"page-edit",$page["page_id"]);?>
	</body>
</html>