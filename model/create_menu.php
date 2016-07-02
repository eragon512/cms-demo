<?php
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		$num_fields = 2;
		$num_entries = count($_POST)/$num_fields;

		$connect = mysqli_connect("localhost","root","","cms-demo");
		$menu_id = (int)(mysqli_fetch_array(mysqli_query($connect,"SELECT MAX(menu_id) AS last_id FROM menu_list;"),MYSQLI_ASSOC)["last_id"])+1;

		print_r($_POST);

		for($i=1;$i<=$num_entries;++$i) {
			$title = mysqli_real_escape_string($connect,$_POST["menu_entry_title_".$i]);
			$link = mysqli_real_escape_string($connect,$_POST["menu_entry_link_".$i]);
			echo $title." , ".$link."\n";
			
			$stmt = $connect->prepare("INSERT INTO menu_list(menu_id,menu_title,menu_link) VALUES (?,?,?)");
			$stmt->bind_param("iss",$menu_id,$title,$link);
			$stmt->execute();
			$stmt->close();
		}
		mysqli_close($connect);

		header("Location: ../views/view_menu_list.php");
	}