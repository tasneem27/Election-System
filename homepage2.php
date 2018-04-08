<?php 
	session_start();
	$var_value = $_SESSION['varname']; 
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stylesheets.css"/>
		<style type= "text/css">
		li a {
			font-size:25px;
    			display: block;
			background-color:pink;
    			color: green;
    			text-align: center;
    			text-decoration: none;
			cursor:pointer;
			padding: 20px 100px;
		}
		</style>
	</head>
	<body>
	<h3 style="color:black;"> Welcome, <?php echo $var_value ?></h3>
	
	<h1> ELECTION SYSTEM</h1>
	<ul>
		<li><a class="active" href="homepage2.php">Home</a></li>
		<li><a href="viewcandidatedetails2.php">View Candidate Details</a></li>
		<li><a href="viewresult2.php">View Results</a></li>
		<li><a href="index.php">Logout</a></li>
		
	</ul>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "ELECTION";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error); }
		$today = date("Y-m-d");
		$sql = "SELECT ElectionName,startdate,enddate FROM ElectionDetails where startdate<='$today' AND enddate>='$today'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) 
				{
					while($row = $result->fetch_assoc()) 
					{ ?>
						<div style="color:green; opacity:0.8;">
						<h1><?php echo $row["ElectionName"]; ?></h1><br>
						<h1><?php echo $row["startdate"]; ?> </h1>
						<h1> to </h1>
						<h1><?php echo $row["enddate"]; ?></h1><br>
						<br/><br/></br></div>
					<?php }
				}
	?>
	</body>
</html>