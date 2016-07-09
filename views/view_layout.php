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
		<?php load_panel($layout_id,0,"view"); ?>
	</body>
</html>