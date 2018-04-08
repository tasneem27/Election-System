<?php 
	include 'config.php';
	
	class Login
	{
		private $uname;
		private $pass;
		
		
		private function DisplayMenu($x)
		{
			if ($x==1)
				header("Location: homepage1.php");
			else if($x==2)
				header("Location: homepage2.php");
			else
				header("Location: homepage3.php");
		}
		
		 function GetUser($uname,$pass)
		{
			$servername = "localhost";
			$username = "root";
			$password = "root";
			$dbname = "ELECTION";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error); }
				$sql = "SELECT Username,Password,Type FROM Login";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) 
				{
					while($row = $result->fetch_assoc()) 
					{
						if($row["Username"]==$uname && $row["Password"]==$pass)
						{
							//session_start();
							if($row["Type"]=='V'){
								$sql2 = "SELECT Name FROM VoterInfo WHERE Username='$uname'";
								$result2 = $conn->query($sql2);
								if ($result2->num_rows > 0) 
								{
									while($row = $result2->fetch_assoc()) 
									{
										//session_start();
										$str = strtok($row["Name"], ' ');
										$_SESSION['varname'] = $str;
										$_SESSION['username']= $uname;
									}
								}
								self::DisplayMenu(1);
							}
						
							else if($row["Type"]=='C')
							{
								$sql2 = "SELECT Name FROM CandidateInfo WHERE Username='$uname'";
								$result2 = $conn->query($sql2);
								if ($result2->num_rows > 0) 
								{
									while($row = $result2->fetch_assoc()) 
									{
									//	session_start();
										$str = strtok($row["Name"], ' ');
										$_SESSION['varname'] = $str;
										$_SESSION['username']= $uname;
									}
								}
								self::DisplayMenu(2);
							}
						
							else{
								$str='Admin';
								$_SESSION['varname'] = $str;
								$_SESSION['username']= $uname;
								self::DisplayMenu(3);
							}
						
						}
					}
						
						echo '<div class="m2" style="font-size:20px;color:red; font-weight:bold;">*Wrong Username or Password.</div>';
						//echo $msg;
						
					
				}
				
			}
		}
		

	if(isset($_POST['Username']) && isset($_POST['Password']))
	{
		$uname=$_POST['Username'];
		$pass=$_POST['Password'];
		
		if(!empty($uname) && !empty($pass))
		{
			$user= new Login;
			$user->GetUser($uname,$pass);
		}
				//$conn->close();
		else
		{
			$msg='<div class="m2" style="font-size:20px;color:red; font-weight:bold;">*Please fill in all fields</div>';
			echo $msg;
		}
	}		
?>

<html>

<head>
	<style type= "text/css">
		body{
			background-image:url(election-box.jpg);
			background-repeat:no-repeat;
			background-size:cover;
			opacity:0.8;
			filter:alpha(opacity=80);
		}
		
		.m2{
			position:absolute;
			top:205px;
			left:23%;
		}
		
		form{
			background-color:white;
			opacity:0.8;
			color:#8fe56e;
			padding:50px;
			width:250px;
			height:250px;
			position:relative;
			top:100px;
			left:20%;
			
			font-weight:bold;
		}
		
		h1{
			text-align:center;
			color:#8ff442;
			font-family:arial;
			font-size:50px;
			position:relative;
			top:80px;
		}
		
		.login{
			position:relative;
			top:20px;
			left:90px;
		}
		
		.message{
			color:green;
			font-size:20px;
		}

	</style>

</head>

<body>
	<h1 style="color:#e0972a;">ELECTION SYSTEM</h1>

	<form action="" method="post">
	<input type="text" name="Username"  style="height:40px;font-size:12pt;font-weight:bold;color:blue;" size="25" placeholder="username"/><br/><br/>
	<input type="password" name="Password" style="height:40px;font-size:12pt;font-weight:bold;color:blue;" size="25" placeholder="password"/><br><br/>
	<div class="login">	<input type="submit" value="LOGIN" style="height:40px;font-size:12pt;font-weight:bold;background-color:green;color:white" ></div>
	<br/><br/><p class="message">Not registered? <a href="signup.php">Sign Up</a></p>
	</form>
	
</body>
</html>
