<?php	
	@session_start();

	// USER REGISTRATION FUNCTION
	function registrationHandler($db){
		// init return value
		$failed = true;
		// form validation
		if (isset($_POST['register_user']) && isset($_POST['register_password'])) {
			// receive all input values from the front end form
			$username = mysqli_real_escape_string($db, $_POST['register_user']);
			$password = mysqli_real_escape_string($db, $_POST['register_password']);

			// makes sure the username is not taken
			$user_check_query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
			$result = mysqli_query($db, $user_check_query);
			$user = mysqli_fetch_assoc($result);

			// if user exists
			if ($user) { 
				if ($user['username'] === $username) {
					$failed = true;
					//notifies user of registration failure
					echo '<script>alert("Username '.$user['username'].' is already taken. Please try again.")</script>';
				}
			}
			// pushes username/password into database since username does not exist
			else {
				$failed = false;
				// encrypt the password before saving in the database		
				$password = md5($password);
				// inserts into database
				$query = "INSERT INTO user(username, password)
                          	VALUES('$username', '$password')";
				mysqli_query($db, $query);

				// outputs registration success alert and moves user to update profile page
				$_SESSION['username'] = $username;
				echo '<script>alert("You are now registered. Please fill out your user profile on the next page."); 
							location = "../main/index.php"; </script>';
			}
		}
		return $failed;
	}

	// USER LOGIN FUNCTION
	function loginHandler ($db) {
		// init return value
		$failed = true;
		// form validation
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$username = mysqli_real_escape_string($db, $_POST['username']);
			$password = mysqli_real_escape_string($db, $_POST['password']); 
			// encrypts password
			$password = md5($password);
			// builds sql query
			$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);
			// counts number of occurences where the username and password combination is found
			$count = mysqli_num_rows($results);

			// if count is 1, login is successful
			if ($count == 1) {
				$failed = false;
				$_SESSION['username'] = $username;
				// notifies user of login success
				echo '<script>alert("Login successful. Welcome '.$username.'!"); 
							location = "index.php"; </script>';
			}
			// else login fails and outputs error message
			else {
				$failed = true;
				// notifies user of login failure
				echo '<script>alert("Wrong username/password combination.")</script>'; 
			}
		}
		return $failed;
	}

	// connects to local database
	$db = mysqli_connect('localhost', 'root', '', 'sduserdb');

	// logic for registration module
	if (isset($_POST['reg_user'])) {
		// call registration function
		registrationHandler($db);
	}
	
	// logic for login module 
	if (isset($_POST['login_user'])) {
		// call login function
		loginHandler($db);
	}
	
?>