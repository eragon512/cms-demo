<?php
	if(!isset($_GET["page_name"]))
		die();
	if(!(file_exists("pages/".$_GET["page_name"]))) {
		die();
	}
	$file_contents = file_get_contents("pages/".$_GET["page_name"]);
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<?php echo $_GET["page_name"]; ?> :
		
		<form name="menu_entries" action=<?php echo "../model/edit_page.php?page_name=".$_GET["page_name"]; ?> method="POST">
			<textarea name="page_data" rows=30 cols=150><?php echo $file_contents; ?></textarea>
			<br>
			<button type="submit">Save Changes</button>
		</form>
	</body>
</html>