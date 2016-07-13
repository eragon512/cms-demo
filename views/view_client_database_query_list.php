<?php
	require_once("../model/client_database_functions.php");
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["submit"] === "create") {
			create_client_database_query($_POST);
		} else if($_POST["submit"] === "edit") {
			edit_client_database_query($_POST);
		} else if($_POST["submit"] === "delete") {
			delete_client_database_query($_POST);
		}
	}
	$client_database_list = load_client_database_list();
	$client_database_query_list = load_client_database_query_list();
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		Block List: 
		<table>
			<?php
				foreach($client_database_query_list as $query) {
					echo "<tr>\n";
						echo "<form method='POST'>";
							echo "<input type='hidden' name='client_db_query_id' value={$query["client_db_query_id"]} />";
							echo "<td>{$query["client_db_query_name"]}</td>\n";
							echo "<td><select name='client_db_id'>";
								foreach($client_database_list as $database) {
									echo "<option value={$database["client_db_id"]} ";
									if($query["client_db_id"] === $database["client_db_id"]) {
										echo "selected='selected' ";
									}
									echo ">{$database["client_db_name"]},{$database["client_db_server"]},{$database["client_db_username"]}</option>";
								}
								unset($database);
							echo "</select></td>";
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
			Query Database:
			<select>
				<?php
					foreach($client_database_list as $database) {
						echo "<option value={$database["client_db_id"]}>{$database["client_db_name"]},{$database["client_db_server"]},{$database["client_db_username"]}</option>";
					}
					unset($database);
				?>
			</select><br>
			Query Content: <input type="text" name="client_db_query_data" /> <br>
			<button type="submit" name="submit" value="create">Create Block</button>
		</form>
		<br>
	</body>
</html>