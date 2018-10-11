<?php 
	class Account {
		private $errorArray;
		private $con;
		public function __construct($con){
			$this->con = $con;
			$this->errorArray = array();
		}
		public function login($un, $pw){
			$pw = md5($pw);
			$query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'");
			if(mysqli_num_rows($query) == 1){
				return true;
			}else{
				array_push($this->errorArray, Constants::$loginFail);
				return false;
			}
		}
		public function register($un, $fn, $ln, $pw, $pw2, $em){
			$this->validateUsername($un);
			$this->validateFirstname($fn);
			$this->validateLastname($ln);
			$this->validatePassword($pw, $pw2);
			$this->validateEmail($em);
			if(empty($this->errorArray)){
				//insert into database
				return $this->insertUserDetails($un, $fn, $ln, $pw, $em);
			}else{
				echo "xxx";
				echo date("Y-m-d");
				return false;
			}
		}

		public function getError($error){
			if(!in_array($error, $this->errorArray)){
				$error = "";
			}
			return "<span class = 'errorMessage'>$error</span>";
		}

		private function insertUserDetails($un, $fn, $ln, $pw, $em){
			$encryptedPw = md5($pw);
			$profilePic = "assets/images/profilePics/prof.png";
			$date = date("Y-m-d");

			$result = mysqli_query($this->con, "INSERT INTO users VALUES('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");

			return $result;

		}
		private function validateUsername($un){
			if(strlen($un) > 25 || strlen($un) < 5){
				array_push($this->errorArray, Constants::$usernameRange);
				return;
			}
			$checkExistingUsernameQuery = mysqli_query($this->con,"SELECT username FROM users WHERE username = '$un' ");
			if(mysqli_num_rows($checkExistingUsernameQuery) != 0){
				array_push($this->errorArray, Constants::$existingUsername);
				return;
			}

			//to do check if username exist
		}
		private function validateFirstname($fn){
			if(strlen($fn) > 30 || strlen($fn) < 2){
				array_push($this->errorArray, Constants::$firstnameRange);
				return;
			}
		}
		private function validateLastname($ln){
			if(strlen($ln) > 30 || strlen($ln) < 2){
				array_push($this->errorArray, Constants::$lastnameRange);
				return;
			}
		}
		private function validatePassword($pw1, $pw2){
			if($pw1 != $pw2){
				array_push($this->errorArray, Constants::$passwordMatching);
				return;
			}
			if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\W]{8,}$/', $pw1)){
				array_push($this->errorArray, Constants::$passwordComponent);
				return;
			}
		}
		private function validateEmail($em){
			if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
				array_push($this->errorArray, Constants::$emailFormat);
				return;
			}
			$checkExistingEmailQuery = mysqli_query($this->con,"SELECT email FROM users WHERE email = '$em' ");
			if(mysqli_num_rows($checkExistingEmailQuery) != 0){
				array_push($this->errorArray, Constants::$existingEmail);
				return;
			}

			//to do: check that email has not already been used
		}
	}
 ?>