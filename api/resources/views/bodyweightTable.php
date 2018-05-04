<?php 

$bodyweights = $_SESSION['userBodyweights'];

?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./css/table.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>		
	<h2 align="center">Bodyweight History</h2>
	<?php
		if (count($bodyweights) > 0) {
			echo "<table id='table'>";
			echo "<tr>";
			echo "<th>Weight</th>";
			echo "<th>Date</th>";
			echo "<th>Delete</th>";
			echo "</tr>";
			foreach ($bodyweights as $bodyweight) {
				echo "<tr>";
				echo "<td>".$bodyweight['weight']."</td>";
				echo "<td>".date("F d, Y", strtotime($bodyweight['date']))."</td>";
				echo "<td><a href=../../bodyweights/deleteBodyweight/".$bodyweight['id']."><button>Delete</button></a></td>";
				echo "</tr>";
			}
			echo "</table>";
		} else {
			echo "<h1 style='text-align: center;'>No Data To Show</h1>";
		}
	?>
</body>
<script type="text/javascript">
	$('table').hide().fadeIn(1000);
</script>
</html>


