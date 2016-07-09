<?php
	require("../model/page_functions.php");
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		create_page($_POST["page_name"]);
	}
	$page_list = load_page_list();
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
	</body>
</html>