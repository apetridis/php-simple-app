<!DOCTYPE html>
<html>
	<head>	
		<link rel="stylesheet" href="styles.css">
		<title>Secretary's New Reservation Page</title>
	</head>
	<style>
	.topnav{
		padding:0px;
		background-color: grey;
		text-align: center;
		border-radius: 10px;
	}
	
	.dropbtn {
		background-color: grey;
		color: white;
		padding: 16px;
		font-size: 16px;
		border: none;
	}
	
	.dropdown {
		position: relative;
		display: inline-block;
	}

	.dropdown-content {
		position: absolute;
		display: none;
		background-color: grey;
		min-width: 160px;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		z-index: 1;
	}

	.dropdown-content a {
		color: white;
		padding: 12px 16px;
		text-decoration: none;
		display: block;
	}

	.dropdown-content a:hover {background-color: black;}

	.dropdown:hover .dropdown-content {display: block;}

	.dropbtn:hover {
		background-color: white;
		color: grey;
	}
	
	</style>
	<body>
		<?php
			session_start();
			if(!isset($_SESSION["username"]))
				header("Location: login.html");		
		?>
		<div class="header">
			<h1>MyBusApp</h1>
		</div>
		<div class="topnav">
			<div class="dropdown">
				<button class="dropbtn">Reservations</button>
				<div class="dropdown-content">
					<a href="secretaryNewRes.php">New Reservation</a>
					<a href="secretaryResSearch.php">Reservation Search</a>
					<a href="#">Cancel Reservation</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Customers</button>
				<div class="dropdown-content">
					<a href="#">New Customer Registration</a>
					<a href="#">Customer Search</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Destinations</button>
				<div class="dropdown-content">
					<a href="#">New Destination Registration</a>
					<a href="#">Destination Search</a>
					<a href="#">View Destinations</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Trip</button>
				<div class="dropdown-content">
					<a href="#">Create new Trip</a>
					<a href="#">Search Trips</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Drivers</button>
				<div class="dropdown-content">
					<a href="#">Add new Driver</a>
					<a href="#">Driver Search</a>
				</div>
			</div>
		</div>
		<div>
			<p>Search Results</p>
			<table><?php
				include "config.php";
				$conn -> select_db("heroku_ed39a20fb4d6fd8");
				$tripID = $_POST["tripID"];
				$customerID = $_POST["customerID"];
				if (!empty($customerID) && !empty($tripID)){
					$query = "SELECT * FROM reservation WHERE Trip_tripID = '$tripID' AND Customer_customerID = '$customerID'";	
					$result = mysqli_query($conn, $query);
				} elseif (!empty($tripID)){
					$query = "SELECT * FROM reservation WHERE Customer_customerID = '$customerID'";
					$result = mysqli_query($conn, $query);
				} elseif(!empty($tripID)){
					$query = "SELECT * FROM reservation WHERE Trip_tripID = '$tripID'";
					$result = mysqli_query($conn, $query);
				}else {
					echo "Please try one of two , or both.";
				}
				
				$all_data = array();
				while ($data = mysqli_fetch_field($result)) {
					echo '<td>' . $data->name . '</td>';  //get field name for header
					array_push($all_data, $data->name);  //save those to array
				}
				echo '</tr>'; //end tr tag

				//showing all data
				while ($row = mysqli_fetch_array($result)) {
					echo "<tr>";
					foreach ($all_data as $item) {
						echo '<td>' . $row[$item] . '</td>'; //get items using data value
					}
					echo '</tr>';
				}
				echo "</table>";				
			?></table>
		</div>
		<div>
			<a href="logout.php">Log out</a>
		</div>
	</body>
	
</html>