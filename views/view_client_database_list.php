<?php
	require('../model/load_client_database_list.php');
	$client_database_list = load_client_database_list();
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		List of Databases: 
		<ul>
			<?php
				foreach($client_database_list as $client_database) {
					echo "<li><a href='view_client_database.php?db_server={$client_database["client_db_server"]}&db_user={$client_database["client_db_username"]}&db_pass={$client_database["client_db_password"]}&db_name={$client_database["client_db_name"]}'>{$client_database["client_db_name"]}</a> - server: {$client_database["client_db_server"]}, username: {$client_database["client_db_username"]} </li>\n";
				}
			?>
		</ul>
		<a target="_blank" href="add_client_database.html"><button type="button">Add Database</button></a>
	</body>
</html>