<?php
	require_once("../model/layout_functions.php");
	require_once("../model/page_functions.php");
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		create_page($_POST);
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
					echo "</tr>\n\n";
				}
			?>
		</table>

		<br>
		New Pages:
		<form name="pages" action="view_page_list.php" method="POST">
			<input type="text" name="page_name" />
			<select name="layout_id">
				<?php
					foreach($layout_list as $layout) {
						echo "<option value={$layout["layout_id"]}>{$layout["layout_name"]}</option>\n";
					}
				?>
			</select>
			<button type="submit">Create Page</button>
			<br>
		</form>
	</body>
</html>