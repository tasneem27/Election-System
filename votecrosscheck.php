<?php 
	session_start();
	$var_value = $_SESSION['varname']; 
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stylesheets.css"/>

			<style>
				.images img {
				float: right;
				position:relative;
				top:-15px;
				left:-20px;
				opacity:1.0;
				}
				
				table{
					border:1px;
					solid red;
				}
				
				
			</style>
	</head>
	<body>
	<h3 style="color:black;"> Welcome, <?php echo $var_value ?></h3>
	<h1> ELECTION SYSTEM</h1>
	<ul>
		<li><a class="active" href="homepage1.php">Home</a></li>
		<li><a href="viewcandidatedetails1.php">View Candidate Details</a></li>
		<li><a href="castvote.php">Cast Vote</a></li>
		<li><a href="viewresult1.php">View Results</a></li>
		<li><a href="index.php">Logout</a></li>
		
	</ul>




<?php
	
	include 'config.php';
	
//	include 'layout.php';
	class VoteCrossCheck{
		public $Voted;
		public $uname;
		public $candiname;
		
		function GetLoginInfo(){
			session_start();
			$this->uname = $_SESSION['username']; 
			$this->candiname = $_GET['link1'];
			self::Check();
		}
		
		function Check(){
			
		include 'config.php';
		$sql = "SELECT Voted FROM VoterInfo Where Username='$this->uname'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
			{
				while($row = $result->fetch_assoc()) 
				{
					if($row["Voted"]=='Y')
					{
						echo '<div style="color:green; opacity:0.8;position:relative;top:15px;">';
						echo "<h1>'You can vote only once!!'</h1>";
						echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></div>';
					}
					else
					{
						$sql2 = "UPDATE VoteLog SET Votes=Votes+1 WHERE Username LIKE '".$this->candiname."'";
						 
						//$result2 = $conn->query($sql2);
						//if ($result2->num_rows > 0) 
						//{
							//while($row2 = $result->fetch_assoc()) 
							//{
								$sql3 = "UPDATE VoterInfo SET Voted='Y' WHERE Username LIKE '$this->uname'";
								$sql2 = "UPDATE VoteLog SET Votes=Votes+1 WHERE Username LIKE '$this->candiname'";
								$result2=$conn->query($sql2);
								$result3=$conn->query($sql3);
								echo '<div style="color:green; opacity:0.8;position:relative;top:15px;">';
								echo "<h1>'Voting Successful!!'</h1>";
								echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></div>';
								//echo'<a href="castvote.php" style="height:50px;font-size:12pt;font-weight:bold;background-color:green;color:white;position:relative; left:50px;" >GO! </a>';
							//}
						//}
					}
				}
			}
		//header("Location:approvecandidate.php");
		}
	}
	
		$check=new VoteCrossCheck;
		$check->GetLoginInfo();
?>


</BODY>
</Html>