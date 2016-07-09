<?php
	require_once("../model/layout_functions.php");
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		create_layout($_POST["layout_name"]);
	}
	$layout_list = load_layout_list();
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		Layouts List: 
		<table>
			<?php
				foreach($layout_list as $layout) {
					echo "<tr>\n";
						echo "<td><a target='_blank' href='view_layout.php?layout_id={$layout["layout_id"]}'>{$layout["layout_name"]}</a></td>\n";
						echo "<td><a target='_blank' href='edit_layout.php?layout_id={$layout["layout_id"]}'>edit</a></td>\n";
					echo "</tr>\n\n";
				}
			?>
		</table>
		
		<div>
			<br>
			New Layout:
			<form name="new_layout" action="" method="POST">
				<input type="text" name="layout_name" />
				<button type="submit">Create Layout</button>
			</form>
		</div>
	</body>
</html>