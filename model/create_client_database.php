<?php
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		
		$num_fields = 4;
		$num_entries = count($_POST)/$num_fields;
		
		//print_r($_POST);

		require("load_database.php");
		$connect = load_database();

		for($i=1;$i<=$num_entries;++$i) {
			
			$server = mysqli_real_escape_string($connect,$_POST["client_database_".$i."_server"]);
			$username = mysqli_real_escape_string($connect,$_POST["client_database_".$i."_username"]);
			$password = mysqli_real_escape_string($connect,$_POST["client_database_".$i."_password"]);
			$name = mysqli_real_escape_string($connect,$_POST["client_database_".$i."_name"]);
			
			$stmt = $connect->prepare("INSERT INTO client_database_list(client_db_server,client_db_username,client_db_password,client_db_name) VALUES (?,?,?,?)");
			$stmt->bind_param("ssss",$server,$username,$password,$name);
			$stmt->execute();
			$stmt->close();
		}
		mysqli_close($connect);

		header("Location: ../views/view_client_database_list.php");
	}