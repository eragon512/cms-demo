<?php
	require_once("../model/layout_functions.php");
	require_once("../model/page_functions.php");
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["submit"] === "copy") {
			copy_page($_POST);
		} else if($_POST["submit"] === "new") {
			create_page($_POST);
		} else if($_POST["submit"] === "delete") {
			delete_page($_POST);
		}
	}
	$page_list = load_page_list();
	$layout_list = load_layout_list();
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		Pages List: 
		<table>
			<?php
				foreach($page_list as $page) {
					echo "<tr>\n";
						echo "<td><a target='_blank' href='view_page.php?page_id={$page["page_id"]}'>{$page["page_name"]}</a></td>\n";
						echo "<td><a target='_blank' href='edit_page.php?page_id={$page["page_id"]}'>edit</a></td>\n";
						echo "<td><form action='' method='POST'><input type='hidden' name='page_id' value={$page["page_id"]} /><button type='submit' name='submit' value='delete'>delete</a></td>\n";
					echo "</tr>\n\n";
				}
				unset($page);
			?>
		</table>

		<br>
		New Page: <br>
		<form name="page" action="view_page_list.php" method="POST">
			Page Name: <input type="text" name="page_name" />
			Layout: 
			<select name="layout_id">
				<?php
					foreach($layout_list as $layout) {
						echo "<option value={$layout["layout_id"]}>{$layout["layout_name"]}</option>\n";
					}
				?>
			</select>
			<button type="submit" name="submit" value="new">Create Page</button>
			<br>
		</form>
		<br>
		
		Copy Page: <br>
		<form name="page_copy" action="view_page_list.php" method="POST">
			Copy Name: <input type="text" name="page_name" />
			Page Name: 
			<select name="page_id">
				<?php
					foreach($page_list as $page) {
						echo "<option value={$page["page_id"]}>{$page["page_name"]}</option>\n";
					}
					unset($page);
				?>
			</select>
			<button type="submit" name="submit" value="copy">Create Copy</button>
			<br>
		</form>
	</body>
</html>