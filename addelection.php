<?php
	class AddElection
	{
		public $electionname;
		public $startdate;
		public $enddate;
		public $maxcandi;
		
		function GetDetails()
		{
			if(isset($_POST['ElectionName']) && isset($_POST['startdate']) && isset($_POST['enddate']) && isset($_POST['MaxCandi']))
			{
				$this->electionname=$_POST['ElectionName'];
				$this->startdate=$_POST['startdate'];
				$this->enddate=$_POST['enddate'];
				$this->maxcandi=$_POST['MaxCandi'];
				if(!empty($this->electionname) AND !empty($this->startdate) AND !empty($this->enddate) AND !empty($this->maxcandi)){
		
					if ($this->enddate<$this->startdate)
						echo '<h4 style="color:red;font-size:20px;position:absolute;top:300px;left:42%;"><br/>*Invalid End date</h4>';
		
					else{
							self::CheckAvailability();
						}
						
					}
		
		else {
			echo '<h4 style="color:red;font-size:20px;position:absolute;top:300px;left:42%;"><br/>*Please fill in all fields!</h4>';
		}
		}
		}
			
		private function CheckAvailability()
		{
			include 'config.php';
							$sql = "SELECT ElectionName,startdate,enddate FROM ElectionDetails";
							$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										if(($row["startdate"]<=$this->startdate AND $row["enddate"]>=$this->startdate) OR ($row["startdate"]<=$this->enddate AND $row["enddate"]>=$this->enddate))
										{
											//session_start();
											//$_SESSION['edate'] = $row["enddate"];
											$msg= '<div class="m2" style="font-size:20px;color:red;position:relative;top:400px; font-weight:bold;">An Election is currently in process.</div>';
											//echo 'A '.$row["ElectionName"].' is currently in process.';
											echo $msg;
										}
								
							else{
									$sql2 ="INSERT INTO ElectionDetails(ElectionName,startdate,enddate,maxcandi) VALUES('$this->electionname','$this->startdate','$this->enddate','$this->maxcandi')";
									if ($conn->multi_query($sql2)=== TRUE) 
									{
										//header("Location: index.php");
										//$msg='<div class="m2" style="font-size:20px;color:red; font-weight:bold;">*Election Added successfully.</div>';
										$msg='<div class="m2" style="font-size:20px;color:red;position:relative;top:400px; font-weight:bold;">*Election Added successfully.</div>';
										echo $msg;
									}
								}
								}
								}
								else{
									$sql2 ="INSERT INTO ElectionDetails(ElectionName,startdate,enddate,maxcandi) VALUES('$this->electionname','$this->startdate','$this->enddate','$this->maxcandi')";
									if ($conn->multi_query($sql2)=== TRUE) 
									{
										//header("Location: index.php");
										$msg='<div class="m2" style="font-size:20px;color:red;position:relative;top:400px; font-weight:bold;">*Election Added successfully.</div>';
										echo $msg;
									}
								}
		}
		
		
	}
	$election= new AddElection;
		$election->GetDetails();
?>
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
	
			<div style="color:green; opacity:0.8;">
	
	        <form name="frmdropdown" method="post" action="addelection.php">
			<center>
            <h2 style="color:green;" align="center">Add Election!</h2><br/>
         
            <strong style="color:green; font-size:25px;">Election Name:   </strong> 
           
             <input type="text" name="ElectionName"  style="height:40px;font-size:12pt;font-weight:bold;color:blue;" size="25" placeholder="ElectionName"/><br/><br/>
			 <br/><br/><br/><strong style="color:green; font-size:20px;">Start-Date:<input type="date" name="startdate" min="2016-10-22" style='height:40px;font-size:10pt;font-weight:bold;color:black ; position:relative;left:10px;'></strong>
			 <strong style="color:green; font-size:20px; position:relative;left:25px;"> End-Date:<input type="date" name="enddate" min="2016-10-22" style='height:40px;font-size:10pt;font-weight:bold;color:black ; position:relative;left:10px;'></strong>
			<strong style="color:green; font-size:20px; position:relative;left:25px;"> &nbsp&nbsp&nbsp Max No. Of Candidates<input placeholder="number" type="tel" name="MaxCandi" min="1" style='height:40px;font-size:10pt;font-weight:bold;color:black ; position:relative;left:10px;'></strong>
			 
			 <br/><input type="submit" value="GO!" style="height:40px;font-size:12pt;font-weight:bold;background-color:green;color:white;position:relative;top:60px;" > 
			<br/><br/><br/><br/><br/><br/><br/><br/>
			 </form> </div>

</body>

</html>