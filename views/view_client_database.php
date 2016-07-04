<?php
	require('../model/load_client_database.php');
	
	$server = $_GET["db_server"];
	$username = $_GET["db_user"];
	$password = $_GET["db_pass"];
	$db_name = $_GET["db_name"];
	
	if(!isset($server) || !isset($username) || !isset($password) || !isset($db_name)) {
		die("Unable to load Database");
	} else if(!($client_database = load_client_database($server,$username,$password,$db_name))) {
		die("Unable to load Database");
	};
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		List of Tables in Database <?php echo $_GET["db_name"]; ?>
		<ul>
			<?php
				foreach($client_database as $client_database_table) {
					echo "<li><a href='view_client_database_table.php?db_server={$server}&db_user={$username}&db_pass={$password}&db_name={$db_name}&table_name={$client_database_table}'>{$client_database_table}</a></li>\n";
				}
				unset($client_database_table);
			?>
		</ul>
	</body>
</html>