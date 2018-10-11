<?php 
	include("includes/config.php");
	include("includes/class/Account.php");
	include("includes/class/Constants.php");
	$account = new Account($con);
	include("includes/handler/register-handler.php");
	include("includes/handler/login-handler.php");
	function getInputValue($name){
		if(isset($_POST[$name])){
			echo $_POST[$name];
		}
	}
 ?>
<html>
<head>
	<title>Welcome to Spotify</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
</head>
<body>
	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>
					<p>	
						<?php echo $account->getError(Constants::$loginFail); ?>
						<label for="loginUsername">Username</label>
						<input id="loginUsername" type="text" name="loginUsername" placeholder="e.g.bart simpson" required>
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" type="password" name="loginPassword"  required>
					</p>

					<button type="submit" name="loginButton">Log In</button>
					
				</form>

				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your account</h2>
					<p>	
						<?php echo $account->getError(Constants::$usernameRange); ?>
						<?php echo $account->getError(Constants::$existingUsername); ?>
						<label for="username">Username</label>
						<input id="username" type="text" name="username" placeholder="e.g. bart simpson" value="<?php getInputValue('username') ?>" required>
					</p>
					<p>	
						<?php echo $account->getError(Constants::$passwordComponent); ?>
						<label for="password">Password</label>
						<input id="password" type="password" name="password" placeholder="Your Password" value="<?php getInputValue('password') ?>" required>
					</p>
					<p>
						<?php echo $account->getError(Constants::$passwordMatching); ?>
						<label for="password2">Confirm Password</label>
						<input id="password2" type="password" name="password2"  required>
					</p>
					<p>	
						<?php echo $account->getError(Constants::$firstnameRange); ?>
						<label for="firstname">First Name</label>
						<input id="firstname" type="text" name="firstname" placeholder="e.g.bart" value="<?php getInputValue('firstname') ?>" required>
					</p>
					<p>	
						<?php echo $account->getError(Constants::$lastnameRange); ?>
						<label for="lastname">Last Name</label>
						<input id="lastname" type="text" name="lastname" placeholder="e.g.simpson" value="<?php getInputValue('lastname') ?>" required>
					</p>
					<p>	
						<?php echo $account->getError(Constants::$emailFormat); ?>
						<?php echo $account->getError(Constants::$existingEmail); ?>
						<label for="email">Email</label>
						<input id="email" type="email" name="email" placeholder="bart@gmail.com" value="<?php getInputValue('email') ?>" required>
					</p>
					<button type="submit" name="registerButton">Log In</button>
					
				</form>
			</div>
		</div>
	</div>
</body>
</html>