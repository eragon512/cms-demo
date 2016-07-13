<?php
	require_once('../model/client_database_functions.php');

	$db_id = $_GET["db_id"];
	$database = load_client_database($db_id);
	$database_table_list = load_client_database_table_list($db_id);
	if(!$database) {
		die("Unable to load Database");
	}
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		List of Tables in Database - <?php echo $database["client_db_name"]; ?>
		<ul>
			<?php
				foreach($database_table_list as $table) {
					echo "<li><a href='view_client_database_table.php?db_id={$db_id}&table_name={$table}'>{$table}</a></li>\n";
				}
				unset($table);
			?>
		</ul>
	</body>
</html>