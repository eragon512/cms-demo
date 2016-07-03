<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<form name="search_students" action="view_students_list.php" method="POST">
			Filter by branch: 
			<select name="dropdown">
				<option value="">Select branch</option>
				<option value="CS">CS</option>
				<option value="Bio">Bio</option>
			</select>
			Search by name: <input type="text" name="search" />
			<button type="submit">Search for Students</button>
		</form>
	</body>
</html>