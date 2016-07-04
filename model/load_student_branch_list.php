<?php
	function load_student_branch_list() {
		require("load_database.php");
		$connect = load_database();

		$branch_result = mysqli_query($connect,"SELECT DISTINCT student_branch FROM students;");
		$branch_list = [];
		while($branch = mysqli_fetch_array($branch_result,MYSQLI_ASSOC)) {
			array_push($branch_list,$branch["student_branch"]);
		}

		mysqli_close($connect);
		return $branch_list;
	}