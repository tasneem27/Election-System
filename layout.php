<?php 
	session_start();
	$var_value = $_SESSION['varname']; 
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stylesheets.css"/>
	</head>
	<body>
	<h3 style="color:white;"> Welcome <?php echo $var_value ?></h3>
	<h3 style="color:white;"><a style="color:#8ff442; font-size:20px; position:absolute; left:-10px;" href="profile.php">My Profile</a></h3>
	<h3 style="color:white;"><a style="color:#8ff442; font-size:20px; position:absolute; left:100px;" href="index.php">Logout</a></h3>
	<h1> Take A Break</h1>
	<ul>
		<li><a class="active" href="homepage.php">Home</a></li>
		<li><a href="places.php">Places</a></li>
		<li><a href="flights.php">Flights</a></li>
		<li><a href="hotels.php">Hotels</a></li>
		<li><a href="contact.php"> Contact Us</a></li>
		<li><a href="feedback.php">Feedback</a></li>
		
	</ul>
	</body>
</html>