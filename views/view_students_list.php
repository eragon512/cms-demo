<?php
	if(!($_SERVER["REQUEST_METHOD"] === "POST"))
		die("Oops");
	
	require("../model/load_student_list.php");
	$student_list = load_student_list($_POST);
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		Students List: 
		<table>
			<?php
				foreach($student_list as $student) {
					echo "<tr>\n";
					foreach($student as $student_field => $student_value) {
						echo "<td>".$student_value."</td>\n";
					}
					echo "</tr>\n";
				}
			?>
		</table>
	</body>
</html>