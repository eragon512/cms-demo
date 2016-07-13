<?php
	require('../model/client_database_functions.php');

	$db_id = $_GET["db_id"];
	$table_name = $_GET["table_name"];
	$database = load_client_database($db_id);
	$table = load_query_table(load_client_database_table($db_id,$table_name));
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		Table <?php echo $table_name; ?> :
		<?php
			echo $table;
		?>
	</body>
</html>