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
		
		table{
					font-size:20px;
					border:1px;
					solid red;
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

	class ViewCandidateDetails
	{
		public $name;
		public $email;
		public $party;
		private $address;
		private $phno;
		
		function DisplayCandidate()
		{
			
				include 'config.php';
				echo '<div style="color:green; opacity:0.8;">';
				$sql = "SELECT * FROM CandidateInfo";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					echo '<p class="brag">';
					

				echo '<p class="title" style="font-size:30px;"> CANDIDATES</p> <br/>';
				echo "<table  style='color:solid blue;position:relative;left:100px;' border='2' width='90%' cellpadding='15'><tr><td><p class='title' style='position:relative;left:40px;font-weight:bold;'>PARTY </p></td>";
				echo "<td><p class='title' style='position:relative;left:40px; font-weight:bold;'>NAME</p></td>"; 
				echo "<td><p class='title' style='position:relative;left:40px;  font-weight:bold;'>EMAIL</p></td>";
			//	echo "<td><p class='title' style='position:relative;left:50px;  font-weight:bold;'>PHONE #</p></td>";
				echo "<td><p class='title' style='position:relative;left:40px;  font-weight:bold;'>ADDRESS</p></td>"; 
				echo "<td><p class='title' style='position:relative;left:40px;  font-weight:bold;'>AGE</p></td></tr>";
					while($row = $result->fetch_assoc()) {
								$this->party=$row["Party"];
								$this->name=$row["Name"];
								$this->email=$row["Email"];
				//				$this->phno=$row["Phno"];
								$this->address=$row["Address"];
								$this->age=$row["age"];
				//$msg='<h2 style="font-size:20px;color:red;font-style:arial; font-weight:bold;font-weight:bold; text-align:center;position:absolute; top:315px; left:810px"> State: </h2>';
				
				echo "<tr><td><p class='content' style='position:relative;left:40px;'>$this->party </p></td>"; 
				echo "<td><p class='content' style='position:relative; left:40px;'>$this->name </p></td>"; 
				echo "<td><p class='content' style='position:relative;left:40px; '>$this->email </p></td>"; 
				//echo "<td><p class='content' style='position:relative;left:50px; '>$this->phno </p></td>"; 
				echo "<td><p class='content' style='position:relative;left:40px; '>$this->address </p></td>"; 
				echo "<td><p class='content' style='position:relative;left:40px; '>$this->age </p></td></tr>";
				
				//echo'<td><a href="bookhotel.php" style="height:50px;font-size:12pt;font-weight:bold;background-color:green;color:white;position:relative; left:50px;top:10px;" >BOOK! </a></td>';
				//echo "<td><p class='content' style='position:relative; left:50px;'>BOOK </p></td></tr>"; 
					}
					echo '</table></p><br/><br/><br/></div>';
				}
		}
	}
	
	$candidetails= new ViewCandidateDetails;
	$candidetails->DisplayCandidate();
?>

</body>
</html>
