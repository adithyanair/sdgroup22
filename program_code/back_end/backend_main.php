<?php
	session_start();
	
	// array of mock hardcoded data, WILL DELETE FOR LATER ASSIGNMENTS
	$users = [
		"joe" => "123456",
		"jon" => "654321",
		"joy" => "abcdef",
		"shavie" => "1234" 
	];	

	// login module
	function loginHandler (&$users) {
		// init return value
		$failed = true;
		if (isset($_POST['username']) && !isset($_SESSION['username'])) {
			// checks and verifies posted data from login page
			if (isset($users[$_POST['username']])) {
				if ($users[$_POST['username']] == $_POST['password']) {
					$failed = false;
					$_SESSION['username'] = $_POST['username'];
					//notifies user of login success
					echo '<script>alert("Login successful."); 
								location = "index.php"; </script>';
				}
			}
			// sets the failed login flag
			if (!isset($_SESSION['username'])) { 
				//notifies user of login failure
				echo '<script>alert("Wrong username/password combination.")</script>';
			}
		}
		return $failed;
	}

	//REGISTER USER
	function register_handler(&$users){
		// init return value
		$failed = true;
		if (isset($_POST['register_user']) && isset($_POST['register_password']))
		{
			// checks and verifies posted data from register page
			if (isset($users[$_POST['register_user']])) {
				//notifies user of register failure
				echo '<script>alert("Username already taken.")</script>';
			}
			// pushes username/password into user db if user does not exist
			else {
				$failed = false;
				$_SESSION['username'] = $_POST['register_user'];
				$register_user = $_POST['register_user'];
				$register_password = $_POST['register_password'];
				//pushes data into users array
				$users[$register_user] = $register_password;
				//notifies user of register success
				echo '<script>alert("You are now registered. Please fill out your user profile on the next page."); 
				              location = "../user_info/update_profile.php"; </script>';
			}
		}
		return $failed;
	}

	//connect to database, WILL COMPLETE FOR LATER ASSIGNMENTS
	//$db = mysqli_connect('ip', 'root', 'pw', 'db');

	// logic for login module 
	if (isset($_POST['login_user'])) {
		// call login handler function
		loginHandler($users);
	}

	//logic for register module
	if (isset($_POST['reg_user'])) {
		// call register handler function
		register_handler($users);
	}

    // FUTURE CODE FOR REFERENCE - LOGIN USER
	/*
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM user WHERE username='$username' AND e_password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);


        //make sure the username is not taken
		$user_check_query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password);//encrypt the password before saving in the database
			$query = "INSERT INTO user ( username, e_password) 
						VALUES('$username', '$password')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "<p> <font color = #bdb6b5> You are now logged in </p>";
			header('location: index.php');
		}
	}
	*/

?>