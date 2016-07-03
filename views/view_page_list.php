<?php
	require("../model/load_page_list.php");
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
						echo "<td><a target='_blank' href='pages/{$page}'>{$page}</a></td>\n";
						echo "<td><a target='_blank' href='edit_page.php?page_name={$page}'>edit</a></td>\n";
					echo "</tr>\n\n";
				}
			?>
		</table>
	</body>
</html>