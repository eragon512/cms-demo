<?php
	require('../model/load_client_database_table.php');
	$server = $_GET["db_server"];
	$username = $_GET["db_user"];
	$password = $_GET["db_pass"];
	$db_name = $_GET["db_name"];
	$table_name = $_GET["table_name"];
	$sql_query = isset($_GET["sql_query"]) ? $_GET["sql_query"] : "";

	if(!isset($table_name)) {
		die("Unable to load Database");
	} else if(!($client_database_table = load_client_database_table($server,$username,$password,$db_name,$table_name,$sql_query))) {
		die("Unable to load Database");
	};
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		Table <?php echo $_GET["table_name"]; ?> :
		<table>
			<tr>
				<?php
					foreach($client_database_table["schema"] as $table_field) {
						echo "<th>{$table_field}</th>";
					}
					unset($table_field);
				?>
			</tr>
			<?php
				foreach($client_database_table["data"] as $table_row) {
					echo "<tr>\n";
						foreach($table_row as $value) {
							echo "<td> {$value} </td>\n";
						}
						unset($value);
					echo "</tr>\n";
				}
				unset($table_row);
			?>
		</table>

		<br>
		<form name="sql_query" action=<?php echo $_SERVER['PHP_SELF']; ?> method="GET" >
			Run SQL Query: <input type="text" name="sql_query" />
			<input type="hidden" name="db_server" value=<?php echo $server; ?> />
			<input type="hidden" name="db_user" value=<?php echo $username; ?> />
			<input type="hidden" name="db_pass" value=<?php echo $password; ?> >
			<input type="hidden" name="db_name" value=<?php echo $db_name; ?> />
			<input type="hidden" name="table_name" value=<?php echo $table_name; ?> />
			
			<button type="submit">Submit SQL Query</button>
		</form>

	</body>
</html>