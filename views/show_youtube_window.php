<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<?php
			if(isset($_POST["link_youtube_short"])) $youtube_link =  $_POST["link_youtube_short"];
			if(isset($_POST["link_youtube"])) $youtube_link =  $_POST["link_youtube"];
		?>
		<iframe width="400" height="230" src="https://youtube.com/embed?v="<?php echo $youtube_link; ?> target="_parent" frameborder="0" allowfullscreen></iframe>
	</body>
</html>