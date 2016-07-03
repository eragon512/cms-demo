<?php
	
	function load_student_list($filter_list) {

		require("load_database.php");
		$connect = load_database();

		$student_query = "SELECT * FROM students WHERE 1 ";
		if($filter_list) {
			if($filter_list["search"]) {
				$student_query .= "AND student_name LIKE '%".$filter_list["search"]."%' ";
			}
			if($filter_list["dropdown"]) {
				$student_query .= "AND student_branch='".$filter_list["dropdown"]."' ";
			}
		}
		$student_query .= " ;";
		$student_result = mysqli_query($connect,$student_query);
		$student_list = [];
		while($student_row = mysqli_fetch_array($student_result,MYSQLI_ASSOC)) {
			array_push($student_list,$student_row);
		}
		mysqli_close($connect);
		return $student_list;
	}