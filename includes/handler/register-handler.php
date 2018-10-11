<?php
function sanitizeFormPassword($inputText){
	return strip_tags($inputText);
}
function sanitizeFormUsername($inputText){
	return str_replace(" ", "", strip_tags($inputText));
}
function sanitizeFormString($inputText){
	$inputText = str_replace(" ", "", strip_tags($inputText));
	return ucfirst(strtolower($inputText));
}


if(isset($_POST['registerButton'])) {
	$username = sanitizeFormUsername($_POST['username']);
	$firstname = sanitizeFormString($_POST['firstname']);
	$lastname = sanitizeFormString($_POST['lastname']);
	$email = sanitizeFormString($_POST['email']);
	$password = sanitizeFormPassword($_POST['password']);
	$password2 = sanitizeFormPassword($_POST['password2']);

	echo "register button is pressed";
	$wasSuccessful = $account->register($username,$firstname,$lastname,$password, $password2, $email);
	if($wasSuccessful){
		$_SESSION['userLoggedIn'] = $username;
		header("Location: index.php");
	}else{
		//echo "herehere";
	}
}

?>