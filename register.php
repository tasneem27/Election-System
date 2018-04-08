<?php
	require_once('signup.php');
			$register->register();
		?>
		
<html>

<body>
	<form action="register.php" id="getpass" method="post">
	<input type="hidden" name="getpass" value=""/>
	 <div class="input-field">
	<label for="password">Set Password</label>; 
	 <input type="password" name="pass" required/>
	<input type="submit" value="Register" class="button"/>
	 </div>
	</form>
</body>
</html>