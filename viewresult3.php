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
			padding: 20px 40px;
		}
		</style>
	</head>
	<body>
	<h3 style="color:black;"> Welcome, <?php echo $var_value ?></h3>
	<h1> ELECTION SYSTEM</h1>
	<ul>
		<li><a class="active" href="homepage3.php">Home</a></li>
		<li><a href="viewcandidatedetails3.php">View Candidate Details</a></li>
		<li><a href="viewresult3.php">View Results</a></li>
		<li><a href="approvecandidate.php">Update Candidate</a></li>
		<li><a href="addelection.php">Add Election</a></li>
		<li><a href="index.php">Logout</a></li>

	</ul>
	</body>
</html>



<?php

	class ViewResult
	{
		public $winner;
		public $party;
		public $votes;

		function DisplayResults(){
			session_start();
			$today = date("Y-m-d");
			$end = "2016-10-30";
			//$end = $_SESSION['edate'];
			echo '<div style="color:green; opacity:0.8; position:relative;top:15px;">';
			if ($end > $today) {
				echo "<p class='title1' style='position:relative;left:100px;'>Election Process is not completed<br/></p>";
				echo "<p class='title1' style='position:relative;left:100px;'>Election will end on $end</p>";
			}
		
			else{
				//include 'config.php';
				$servername = "localhost";
			$username = "root";
			$password = "root";
			$dbname = "ELECTION";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error); }
				$sql = "SELECT C.Name,C.Party,V.Votes FROM CandidateInfo AS C INNER JOIN VoteLog AS V ON C.Username=V.Username WHERE V.Votes=(SELECT max(Votes) FROM VoteLog)";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$this->party=$row["Party"];
						$this->winner=$row["Name"];
						$this->votes=$row["Votes"];
						echo "<p class='title1' style='position:relative;left:100px;'>$this->winner from Party $this->party won with $this->votes votes.<br/></p>";
						//echo $this->winner.' from Party '.$this->party.' won by '.$this->votes.' votes.';
					}
				}
			}
			echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></div>';
		}
	}
	
	$results=new ViewResult;
	$results->DisplayResults();
?>