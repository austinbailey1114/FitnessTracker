<?php 

//url
$url = getenv('URL');

//user data set on login
$id = $_SESSION['id'];
$name = $_SESSION['name'];

//prepare for get requests from api
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

//function to grab data from api
function cURLwithURL($apiURL, $url, $id, $ch) {
	curl_setopt($ch, CURLOPT_URL, $url . $apiURL . $id);
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo "Error: " . curl_error($ch);
	}
	return json_decode(trim($result), true);
}

//grab lift data
$lifts = cURLwithURL('api/lifts/', $url, $id, $ch);
$_SESSION['userLifts'] = $lifts;

//grab bodyweight data
$bodyweights = cURLwithURL('api/bodyweights/', $url, $id, $ch);
$_SESSION['userBodyweights'] = $bodyweights;

//grab lifttypes
$lifttypes = cURLwithURL('api/lifttypes/', $url, $id, $ch);

//grab food data
$foodhistory = cURLwithURL('api/foods/', $url, $id, $ch);

//build arrays with the GET data to make graphs
$liftxaxis = array();
$liftyaxis = array();
$types = array();

if (count($lifts) > 0) {
	foreach ($lifts as $lift) {
		$liftxaxis[] = date("n/j", strtotime($lift["date"]));

		$onerepmax = $lift['weight'] * (1 + ($lift['reps']/30));
		$liftyaxis[] = $onerepmax;

		$types[] = $lift["type"];
	}
}

//bodyweight data
$weightxaxis = array();
$weightyaxis = array();

if (count($bodyweights) > 0) {
	foreach ($bodyweights as $bodyweight) {
		$date = strtotime($bodyweight["date"]);
		$weightxaxis[] = date("m-d", $date);
		$weightyaxis[] = $bodyweight["weight"];
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./css/index.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/vue"></script>
		<title>LiftAppSite</title>
		
	</head>
	<body>
		<div id="app">
		<div id="topContainer">
			<div id="headerContainer">
				<h1 align="center" id = "mainTitle">Dashboard</h1>
				<img src="./images/hugeIcon.png" height="62" width="62" id="icon">

			</div>	
			<div id="abouttheapp">
			<a href="https://github.com/austinbailey1114/LiftAppSite" id="aboutLink"><h3>About</h3></a>
			<a href="https://github.com/austinbailey1114/iOS" id="appLink"><h3>The App</h3></a>
			</div>
			<div id="linksContainer">
				<div class="dropdown">
					<button v-on:click="toggleDropDown()" class="dropButton" style="display: none"> <?php echo $name ?></button>
					<div class="dropDownContent" v-if="showDropDown">
						<a href="./logout"><h3 id="accountLink">Log Out</h3></a>
						<a href="./reset"><h3 id="passwordLink">Settings</h3></a>
					</div>
				</div>
				<img src="./images/userIcon.png" height="52" width="52" id="userIcon">
			</div>
		</div>
		<div id="dashboardDiv">
			<div id="container">
				<div class="lift">
					<div>
						<h2 align="center" id="liftProgressTitle">Your Lift Progress</h2>
						<form id="lifttableform" action="lifts/view/asTable">
							<a id="lifttable" href="lifts/view/asTable">View as Table</a>
						</form>
					</div>
						<select name="chooseLift" id="chooseLiftToDisplay" v-on:change="updateLiftChart()">
						<?php

							if (count($lifttypes) > 0) {
								foreach ($lifttypes as $lifttype) {
									$typestring = str_replace('_', ' ', $lifttype['name']);
									echo '<option value="'.$typestring.'">'.$typestring.'</option>';
								}
							} else {
								echo "<option value='null'>No Types Yet</option>";
							}
						?>
						</select>
					<div id ="graphDiv">
						<canvas id="myChart"></canvas>
					</div>
				</div>
				<div id="newLiftContainer">
					<form action="./lifts/addLift" method="post">
						<div id="addNewWeight">
							<p id="promptWeight">Weight: </p>
							<input type="text" name="weight" id="weightInput" placeholder="pounds" autocomplete="off" v-on:input="checkInput($('#weightInput').val(), 'promptWeight', 'Weight: ')">
						</div>
						<div id="addNewReps">
							<p id="promptReps">Reps:</p>
							<input type="text" name="reps" id="repsInput" placeholder="repetitions" autocomplete="off" v-on:input="checkInput($('#repsInput').val(), 'promptReps', 'Reps: ')">
						</div>
						<div id="addNewType">
							<p id="promptType">Type:</p>
							<div id="typeSelectDiv">
								<select id="lifttypes" name='lifttypes' v-on:change="fillType()" v-if="!newType">
								<?php
									if (count($lifttypes) > 0) {
										$typeOptions = "<option value='null'>Select Below</option>";
										$typeOptions = $typeOptions . "<option value='addnew'>Add New</option>";
										foreach ($lifttypes as $lifttype) {
											$typestring = str_replace('_', ' ', $lifttype['name']);
											$typeOptions = $typeOptions . '<option value="'.$typestring.'">'.$typestring.'</option>';
										}
									} else {
										$typeOptions = "<option value='null'>Select Below</option>";
										$typeOptions = $typeOptions . "<option value='addnew'>Add New</option>";
									}
									echo $typeOptions;

								?>
								</select>
								<div v-if="newType" id="newType" style="display: none">	
									<button id='tempButton' type=button v-on:click='unfillType()'>
										<img src='./images/xicon.png' height='15' width='15' style='margin-right: 5px;'>
									</button>
									<input type='text' name='type' id='typeInput' placeholder='new type' autocomplete='off'>
								</div>
							</div>
						</div>
						<div id="addNewDate">
							<p id="promptDate">Date:</p>
							<script type="text/javascript">
								jQuery(function($){
								   $("#dateInput").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
								   
								});
							</script>
							<input type="test" name="date" id="dateInput" placeholder="leave blank if today" autocomplete="off">
						</div>
						<button id="saveLift">Save</button>
					</form>
				</div>
			</div>
			<div class="nutrition">
				<div id="showData">
					<?php
						$calories = 0;
						$fat = 0;
						$carbs = 0;
						$protein = 0;
						if (count($foodhistory) > 0) {
							foreach ($foodhistory as $food) {
								# code...
								$calories += $food['calories'];
								$fat += $food['fat'];
								$carbs += $food['carbs'];
								$protein += $food['protein'];
							}
						}

						echo "<p id='displayCals'>Today's calories: ".$calories."</p>";
						echo "<p id='displayFat'>Today's fat: ".$fat."g</p>";
						echo "<p id='displayCarbs'>Today's carbs: ".$carbs."g</p>";
						echo "<p id='displayProtein'>Today's protein: ".$protein."g</p>";
					?>
				</div>
				<div id="newFood">
					<form id="searchFood" action="./foods/search" method="post">
						<div id="enterfood">
							<h2 id="newFoodTitle">Search Foods: </h2>
							<input type="text" name="searchField" id="searchInput" placeholder="Food, brand, etc.">
						</div>
						<div id="foodbutton">
							<button id="search">Search</button>
						</div>
					</form>
				</div>
				<div id="foodHistoryContainer">
					<h3>Food Today</h3>
					<div id="foodHistory">
						<?php
							if(count($foodhistory) > 0) {
								foreach ($foodhistory as $food) {
									# code...
									echo "<p>" . $food['name'] . "</p>";
								}
							}
							else {
								echo "<p>No foods to display<p>";
							}
						?>
					</div>
				</div>
			</div>
			<div id="weightDiv">
				<div class="bodyweightGraph">
					<h2 id="bodyweighttabletitle">Bodyweight</h2>
					<a id="bodyweighttable" href="bodyweights/view/asTable">View as Table</a>
					<div id ="bodyweightGraphDiv">
						<canvas id="bodyweightChart"></canvas>
					</div>
				</div>
				<div id="newWeight">
					<form action="./bodyweights/addBodyweight" method="post">
						<div id="promptBodyweight">
							<h2 id="weightTitle">Update: </h2>
							<input type="text" name="updateWeight" id="newBodyWeight" placeholder="pounds" v-on:input="checkInput($('#newBodyWeight').val(), 'weightTitle', 'Bodyweight: ')">
						</div>
						<div id="addBodyweightButtonDiv">
							<button id="add">Update</button>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>
	</body>
	<script type="text/javascript">

		/*
		* Global Variables
		*/

		//convert php arrays to js arrays
		var weightxaxis = <?php echo json_encode($weightxaxis); ?>;
		var weightyaxis = <?php echo json_encode($weightyaxis); ?>;
		var liftyaxis = <?php echo json_encode($liftyaxis); ?>;
		var liftxaxis = <?php echo json_encode($liftxaxis); ?>;
		var types = <?php echo json_encode($types); ?>;

		//grab session variables if they are set
		var message = <?php  
							if (isset($_SESSION['message'])) echo json_encode($_SESSION['message']); 
							else echo "null"; 
							unset($_SESSION['message']);
					  ?>;

		var lift = <?php
						if (isset($_SESSION['lift'])) echo json_encode($_SESSION['lift']);
						else echo 'null';
						unset($_SESSION['lift']);
				    ?>;

		var displayLift = $('#chooseLiftToDisplay').val();

		//reset these items css so they can show up
		$('.dropButton').css('display', 'block');
		$('#newType').css('display', 'block');

	</script>	
	<script type="text/javascript" src="./js/index_vue.js"></script>
	<script type="text/javascript" src="./js/weightchart.js"></script>
	<script type="text/javascript" src="./js/swal.js"></script>
</html>