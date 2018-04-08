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
<BODY>





<?php
	
	include 'config.php';
//	include 'layout.php';
	class UpdateCandidate{
	
		public $Uname;
		
		function RemoveCandidate(){
		$this->Uname =$_GET['link1'];
	
		include 'config.php';
		$sql = 'DELETE FROM CandidateInfo Where Username= "'.$this->Uname.'"';
		$sql2 = 'DELETE FROM Login Where Username= "'.$this->Uname.'"';
		$sql3 = 'DELETE FROM VoteLog Where Username= "'.$this->Uname.'"';
		$result = $conn->query($sql);
		$result2=$conn->query($sql2);
		$result3 = $conn->query($sql3);
		header("Location:approvecandidate.php");
		}
	}
		$remove=new UpdateCandidate;
		$remove->RemoveCandidate();
?>


</BODY>
</HTML>