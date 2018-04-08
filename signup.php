<?php 
	//require_once('signup.php');
	
class Registeration{
		
	public $name;
	public $email;
	public $age;
	private $address;
	private $phone;
	public $type;
	public $party;
	public $uname;
	private $pass;
	
	function GetInfo(){
		//if(!empty($_POST['Login']){
			
		if(isset($_POST['login']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) &&isset($_POST['age']) && isset($_POST['pass']) )
		{
			$this->name=$_POST['name'];
			$this->email=$_POST['email'];
			$this->address=$_POST['address'];
			$this->phone=$_POST['phone'];
			$this->age=$_POST['age'];
			$this->pass=$_POST['pass'];
			//$phone=$_POST['PhoneNumber'];
			if(!empty($this->name) && !empty($this->email) && !empty($this->address) && !empty($this->phone) && !empty($this->age) && !empty($this->pass))		
			{
				if($this->age>18){
					$this->type='V';
					self::GenerateUser();}
			
				else{
					echo '<div class="m2" style="font-size:30px;color:red; position:absolute;top:50%;left:50%;font-weight:bold;">';
					echo '*You must be 18 years or above to VOTE!!';
					echo '</div>';
				}
			}
			
			else{
				$msg='<h2 style="font-size:25px;color:red;font-style:arial; font-weight:bold;font-weight:bold; text-align:center;position:absolute; top:200px; left:530px">*Please fill in all fields</h2>';
				echo $msg;
			}
		}
		
		else if(isset($_POST['signup']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) &&isset($_POST['age']) && isset($_POST['party']) && isset($_POST['pass']))
		{
			$this->name=$_POST['name'];
			$this->email=$_POST['email'];
			$this->address=$_POST['address'];
			$this->phone=$_POST['phone'];
			$this->age=$_POST['age'];
			$this->party=$_POST['party'];
			$this->pass=$_POST['pass'];
			//$phone=$_POST['PhoneNumber'];
		
			if(!empty($this->name) && !empty($this->email) && !empty($this->address) && !empty($this->phone) && !empty($this->age) && !empty($this->party) && !empty($this->pass))
			{
				include 'config.php';
				$sql2 = "SELECT count(*) FROM CandidateInfo";
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) 
					{
						while($row = $result2->fetch_assoc()) 
							$count=$row["count(*)"];
					}
				if($this->age>35&& $count<7){
					$count++;
					$this->type='C';
					self::GenerateUser();}
				else if($count>=7) {
					echo '<div class="m2" style="font-size:30px;color:red; position:absolute;top:50%;left:50%;font-weight:bold;">';
					echo '*There can be only 7 candidates '; 
					echo '</div>';
				}
				else{
					echo '<div class="m2" style="font-size:30px;color:red; position:absolute;top:50%;left:50%;font-weight:bold;">';
					echo '*You must be 35 years or above to be a CANDIDATE!!';
					echo '</div>';
				}
			}
			
			else{
				$msg='<h2 style="font-size:25px;color:red;font-style:arial; font-weight:bold;font-weight:bold; text-align:center;position:absolute; top:200px; left:530px">*Please fill in all fields</h2>';
				echo $msg;
			}
		}
		
	}
	
	private function GenerateUser()
	{
		//$str=$this->name;
		$random= rand ( 0 , 100 );
		$str = strtok($this->name, ' ');
		$str=str_shuffle ($str);
		$this->uname=$str.$random;
		
	
	
		//echo 'Your Generated UserName is '.$this->uname;
		
		
		include 'config.php';
		
			
			$sql ="INSERT INTO Login(Username,Password,Type) VALUES('$this->uname','$this->pass','$this->type')";
			//echo 'Done'.$this->pass;
			if ($conn->multi_query($sql)=== TRUE) 
			{
				//echo 'inserting';
				if($this->type=='V'){
					//echo 'Hi Voter';
					$sql2 = "INSERT INTO VoterInfo(Username,Name,Email,Address,Phno,age,Voted) VALUES('$this->uname','$this->name','$this->email','$this->address',$this->phone,$this->age,'N')";
					//header("Location: index.php");
						if (($conn->multi_query($sql2)) === TRUE) 
					{
					echo '<div class="m2" style="font-size:30px;color:red; position:absolute;top:50%;left:60%;font-weight:bold;">';
					echo 'Your Generated UserName is '.$this->uname;
					echo'<br/><br/><br/><a href="index.php" style="height:50px;font-size:30pt;font-weight:bold;background-color:green;color:white;position:absolute;top:50%; left:55%;" >GO! </a>';
					echo '</div>';
					//header("Location: index.php");
					//$msg='<div class="m2" style="font-size:20px;color:red; font-weight:bold;">*You are registered successfully.</div>';
					//echo $msg;
					}
				}
				else if($this->type=='C'){
					//echo 'Hi Candidate';
					$sql2 = "INSERT INTO CandidateInfo(Username,Name,Email,Address,Phno,Party,age) VALUES('$this->uname','$this->name','$this->email','$this->address',$this->phone,'$this->party',$this->age)";
					$sql3="INSERT INTO VoteLog(Username,Party,Votes) VALUES('$this->uname','$this->party',0)";
					$result=$conn->query($sql3);
				
				if (($conn->multi_query($sql2)) === TRUE) 
				{
					echo '<div class="m2" style="font-size:30px;color:red; position:absolute;top:50%;left:60%;font-weight:bold;">';
					echo 'Your Generated UserName is '.$this->uname;
					echo'<br/><br/><br/><a href="index.php" style="height:50px;font-size:30pt;font-weight:bold;background-color:green;color:white;position:absolute;top:50%; left:55%;" >GO! </a>';
					echo '</div>';
					//header("Location: index.php");
					//$msg='<div class="m2" style="font-size:20px;color:red; font-weight:bold;">*You are registered successfully.</div>';
					//echo $msg;
				}
				}
			}	
				
		}
			
	
	}
		$register=new Registeration;
		$register->GetInfo();
		
		



?>


<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>




<body background="election-box.jpg">

<h1 style="color:#e0972a;">ELECTION SYSTEM</h1>
<br><br><br><br><br>
<div class="forms">
	<ul class="tab-group">
		<li class="tab active"><a href="#login">Sign up as Voter</a></li>
		<li class="tab"><a href="#signup">Sign up as Candidate</a></li>
	</ul>
	<form action="signup.php" id="login" method="post">
		<input type="hidden" name="login" value=""/>
	      <div class="input-field">
		<label for="name">Name</label>
	        <input type="name" name="name" required="name" />
	        <label for="email">Email</label>
	        <input type="email" name="email" required="email" />
	      <label for="password">Set Password</label> 
	    <input type="password" name="pass" required/>
		<label for="address">Address</label>
	        <input type="address" name="address" required="address" />
		<label for="integer">Phone #</label>
	        <input type="integer" name="phone" required="integer" />
		<label for="number">Age</label>
	        <input type="number" name="age" required="number" />
	        <input type="submit" value="Register" class="button"/>
	      </div>
	  </form>
	  <form action="signup.php" id="signup" method="post">
		<input type="hidden" name="signup" value=""/>
	      <div class="input-field">
	        <label for="name">Name</label>
	        <input type="name" name="name" required="name" />
	        <label for="email">Email</label>
	        <input type="email" name="email" required="email" />
	         <label for="password">Set Password</label> 
	    <input type="password" name="pass" required/>
		<label for="address">Address</label>
	        <input type="address" name="address" required="address" />
		<label for="integer">Phone #</label>
	        <input type="integer" name="phone" required="integer" />
		<label for="number">Age</label>
	        <input type="number" name="age" required="number" />
		<label for="name">Party</label>
	        <input type="name" name="party" required="name" />
	        <input type="submit" value="Register" class="button"/>
	      </div>
	  </form>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script type="text/javascript">
$(document).ready(function(){
	  $('.tab a').on('click', function (e) {
	  e.preventDefault();
	  
	  $(this).parent().addClass('active');
	  $(this).parent().siblings().removeClass('active');
	  
	  var href = $(this).attr('href');
	  $('.forms > form').hide();
	  $(href).fadeIn(500);
	});
});
</script>

</body>
</html>