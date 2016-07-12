<?php
	require_once("../model/block_functions.php");
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["submit"] === "create") {
			create_block($_POST);
		} else if($_POST["submit"] === "edit") {
			edit_block($_POST);
		} else if($_POST["submit"] === "delete") {
			delete_block($_POST);
		}
	}
	$block_list = load_block_list();
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		Block List: 
		<table>
			<?php
				foreach($block_list as $block) {
					echo "<tr>\n";
						echo "<form method='POST'>";
							echo "<input type='hidden' name='block_id' value={$block["block_id"]} />";
							echo "<td>{$block["block_name"]}</td>\n";
							echo "<td><textarea name='block_data'>{$block["block_data"]}</textarea></td>\n";
							echo "<td><button type='submit' name='submit' value='edit'>edit</button></td>\n";
							echo "<td><button type='submit' name='submit' value='delete'>delete</button></td>\n";
						echo "</form>";
					echo "</tr>\n\n";
				}
				unset($block);
			?>
		</table>

		<br>
		New Block: <br>
		<form name="block" action="" method="POST">
			Block Name: <input type="text" name="block_name" /><br>
			Block Data: <textarea name="block_data" rows=4></textarea> <br>
			<button type="submit" name="submit" value="create">Create Block</button>
		</form>
		<br>
	</body>
</html>