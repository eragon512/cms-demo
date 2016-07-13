<?php
	require_once('../model/client_database_functions.php');
	$client_db_id = $_GET["db_id"];
	$database = load_client_database($client_db_id);
	$client_database_table_list = load_client_database_table_list($database["client_db_server"],$database["client_db_username"],$database["client_db_password"],$database["client_db_name"]);

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["submit"] === "create") {
			create_client_database_query($client_db_id,$_POST);
		} else if($_POST["submit"] === "edit") {
			edit_client_database_query($client_db_id,$_POST);
		} else if($_POST["submit"] === "delete") {
			delete_client_database_query($client_db_id,$_POST);
		}
	}
	$client_database_query_list = load_client_database_query_list($database["client_db_id"]);
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		List of Tables in Database - <?php echo $database["client_db_name"]; ?>
		<ul>
			<?php
				foreach($client_database_table_list as $client_database_table) {
					echo "<li><a href='view_client_database_table.php?db_id={$client_db_id}'>{$client_database_table}</a></li>\n";
				}
				unset($client_database_table);
			?>
		</ul>

		<br>
		Query List: 
		<table>
			<?php
				foreach($client_database_query_list as $query) {
					echo "<tr>\n";
						echo "<form method='POST'>";
							echo "<input type='hidden' name='client_db_query_id' value={$query["client_db_query_id"]} />";
							echo "<td>{$query["client_db_query_name"]}</td>\n";
							echo "<td><input type='text' name='client_db_query_content' value='{$query["client_db_query_content"]}' /></td>\n";
							echo "<td><button type='submit' name='submit' value='edit'>edit</button></td>\n";
							echo "<td><button type='submit' name='submit' value='delete'>delete</button></td>\n";
						echo "</form>";
					echo "</tr>\n\n";
				}
				unset($query);
			?>
		</table> 


		<br>
		New Query: <br>
		<form name="query" action="" method="POST">
			Query Name: <input type="text" name="client_db_query_name" /><br>
			Query Content: <input type="text" name="client_db_query_content" /> <br>
			<button type="submit" name="submit" value="create">Create Query</button>
		</form>
		<br>

	</body>
</html>