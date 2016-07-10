<?php
	require("../model/layout_functions.php");
	if(!isset($_GET["layout_id"])) {
		die("No layout id found");
	}
	$layout_id = $_GET["layout_id"];
	if(!($layout = load_layout($layout_id))) {
		die("Invalid layout Id");
	}
	require("../model/panel_functions.php");
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
				border: 1px solid red;
				margin: -1px;
				padding: -1px;
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
		<?php load_panel($layout_id,"layout-view",NULL); ?>
	</body>
</html>