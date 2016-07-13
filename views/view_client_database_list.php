<?php
	require_once('../model/client_database_functions.php');
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		create_client_database();
	}
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
		
		<br>
		New Database:
		<form name="client_database" action="" method="POST">
			<button type="button" onclick="javascript: add_client_database();">Add new database</button>
			<button type="submit" value="Submit">Create Databases</button>
		</form>
		
		<script>
			var counter = 1;
			
			var add_client_database = function() {
				//console.log("Hello");
				var client_database_server = document.createElement('input');
				client_database_server.type = "text";
				client_database_server.name = "client_database_"+counter+"_server";
				client_database_server.placeholder = "Server Name";
				
				var client_database_username = document.createElement('input');
				client_database_username.type = "text";
				client_database_username.name = "client_database_"+counter+"_username";
				client_database_username.placeholder = "Database access Username";

				var client_database_password = document.createElement('input');
				client_database_password.type = "text";
				client_database_password.name = "client_database_"+counter+"_password";
				client_database_password.placeholder = "Database access Password";

				var client_database_name = document.createElement('input');
				client_database_name.type = "text";
				client_database_name.name = "client_database_"+counter+"_name";
				client_database_name.placeholder = "Database Name";

				var client_database = document.createElement('div');
				client_database.appendChild(client_database_server);
				client_database.appendChild(client_database_username);
				client_database.appendChild(client_database_password);
				client_database.appendChild(client_database_name);
				client_database.innerHTML += '<br />';
				
				document.getElementsByName("client_databases")[0].appendChild(client_database);
				counter += 1;
			}
		</script>
	</body>
</html>