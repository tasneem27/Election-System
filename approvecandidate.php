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
		<li><a class="active" href="homepage3.php">Home</a></li>
		<li><a href="viewcandidatedetails3.php">View Candidate Details</a></li>
		<li><a href="viewresult3.php">View Results</a></li>
		<li><a href="approvecandidate.php">Update Candidate</a></li>
		<li><a href="addelection.php">Add Election</a></li>
		<li><a href="index.php">Logout</a></li>
	</ul>

	<div style="color:green; opacity:0.9;">
			
			<?php
				//$image='Places_Images\\'.$City_Name.'.jpg';
					//echo '<h2 class="images">';
			//	echo("<img src=\"$image\" style='width:500px;height:250px;'/>");
				//echo '</h2>';
				//session_start();
				//$checkin = $_SESSION['Checkin']; 
				//$checkout = $_SESSION['Checkout']; 
                include 'config.php';
				$sql = "SELECT * FROM CandidateInfo"; 
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					echo '<p class="brag">';
					

				echo '<p class="title" style="font-size:25px;">CANDIDATES</p> <br/>';
				echo "<table  style='color:solid blue;position:relative;left:100px;' border='2' width='90%' cellpadding='15'><tr><td><p class='title' style='position:relative; left:40px;font-weight:bold;'>Party</p></td>";
				echo "<td><p class='title' style='position:relative left:40px;  font-weight:bold;'>Name</p></td>";
				//echo "<td><p class='title' style='position:relative; left:40px; font-weight:bold;'>Email Address</p></td>"; 
				//echo "<td><p class='title' style='position:relative;  font-weight:bold;'>Phone No.</p></td>"; 
				echo "<td><p class='title' style='position:relative; left:40px; font-weight:bold;'>Address</p></td>"; 
				echo "<td><p class='title' style='position:relative; left:40px; font-weight:bold;'>Age</p></td>";
				echo "<td><p class='title' style='position:relative;left:40px;  font-weight:bold;'>Remove Candidate</p></td></tr>";
					while($row = $result->fetch_assoc()) {
								$r0=$row["Username"];
								$r1=$row["Party"];
								$r2=$row["Name"];
								//$r3=$row["Email"];
								$r4=$row["Address"];
								//$r5=$row["Phno"];
								$r6=$row["age"];
				//$msg='<h2 style="font-size:20px;color:red;font-style:arial; font-weight:bold;font-weight:bold; text-align:center;position:absolute; top:315px; left:810px"> State: </h2>';
				
				echo "<tr><td><p class='content' style='position:relative; '>$r1 </p></td>"; 
				echo "<td><p class='content' style='position:relative; '>$r2 </p></td>"; 
				//echo "<td><p class='content' style='position:relative; '>$r3 </p></td>"; 
				echo "<td><p class='content' style='position:relative; '>$r4 </p></td>"; 
				//echo "<td><p class='content' style='position:relative; '>$r5 </p></td>"; 
				echo "<td><p class='content' style='position:relative; '>$r6 </p></td>"; 
				echo'<td><a href="removecandi.php?link1='.$r0.'" style="height:50px;font-size:15pt;font-weight:bold;background-color:green;color:white;position:relative; left:50px;" >REMOVE! </a></td>';
				//echo'<td><a href="bookhotel.php" style="height:50px;font-size:12pt;font-weight:bold;background-color:green;color:white;position:relative; left:50px;top:10px;" >BOOK! </a></td>';
				//echo "<td><p class='content' style='position:relative; left:50px;'>REMOVE </p></td></tr>"; 
					}
					echo '</table></p><br/>';
				}
				
				else{
					echo "<br/><h2 style='color:red;font-size:20px;' align='center'>*SORRY! No candidates are there!.</h2><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>"; 
				}
             ?>
		
		</div>
	
</body>
</html>