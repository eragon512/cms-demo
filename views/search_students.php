<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<form name="search_students" action="view_students_list.php" method="POST">
			Filter by branch: 
			<select name="dropdown">
				<option value="">Select branch</option>
				<?php
					require("../model/load_student_branch_list.php");
					$branch_list = load_student_branch_list();
					foreach($branch_list as $branch) {
						echo "<option value='".$branch."'>".$branch."</option>";
					}
				?>
			</select>
			Search by name: <input type="text" name="search" />
			<button type="submit">Search for Students</button>
		</form>
	</body>
</html>