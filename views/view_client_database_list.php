<?php
	require_once('../model/client_database_functions.php');
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["submit"] === "create") {
			create_client_database($_POST);
		} else if($_POST["submit"] === "edit") {
			edit_client_database($_POST);
		} else if($_POST["submit"] === "delete") {
			delete_client_database($_POST);
		}
	}
	$client_database_list = load_client_database_list();
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		List of Databases: 
		<table>
			<tr>
				<td>Database Name</td>
				<td>Database Server</td>
				<td>Database Username</td>
				<td>Database Password</td>
			</tr>
			<?php
				foreach($client_database_list as $client_database) {
					echo "<tr><form action='' method='POST'>";
						echo "<input type='hidden' name='client_db_id' value={$client_database["client_db_id"]} />";
						echo "<td><a target='_blank' href='view_client_database_table_list.php?db_id={$client_database["client_db_id"]}'>{$client_database["client_db_name"]}</a></td>";
						echo "<td><input type='text' name='client_db_server' value='{$client_database["client_db_server"]}' /></td>";
						echo "<td><input type='text' name='client_db_username' value='{$client_database["client_db_username"]}' /></td>";
						echo "<td><input type='text' name='client_db_password' value='{$client_database["client_db_password"]}' /></td>";
						echo "<td><button type='submit' name='submit' value='edit'>edit</button></td>";
						echo "<td><button type='submit' name='submit' value='delete'>delete</button></td>";
					echo "</form></tr>\n";
				}
			?>
		</table>
		
		<br>
		New Database:
		<form name="client_database" action="" method="POST">
			Database Name: <input type="text" name="client_database_name" /> <br>
			Server Name: <input type="text" name="client_database_server" /> <br>
			Database Access Username: <input type="text" name="client_database_username" /> <br>
			Database Access Password: <input type="text" name="client_database_password" /> <br>
			<button type="submit" name="submit" value="create">Create Database</button>
		</form>

	</body>
</html>