<?php
	session_start();
	

	//REGISTER USER
	function register_handler($db){
		// init return value
		/*$failed = true;
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
		return $failed;*/
			// receive all input values from the form
			$username = mysqli_real_escape_string($db, $_POST['register_user']);
			$password = mysqli_real_escape_string($db, $_POST['register_password']);
	
	
			//make sure the username is not taken
			//$user_check_query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
			//$result = mysqli_query($db, $user_check_query);
			//$user = mysqli_fetch_assoc($result);
	
			// register user if there are no errors in the form			
				$password = md5($password);//encrypt the password before saving in the database
				$query = "INSERT INTO user(username, password)
							VALUES('$username', '$password')";
				mysqli_query($db, $query);
	
				$_SESSION['username'] = $username;
				echo '<script>alert("You are now registered. Please fill out your user profile on the next page."); 
				              location = "../user_info/update_profile.php"; </script>';
	}

	//connect to database, WILL COMPLETE FOR LATER ASSIGNMENTS
	$db = mysqli_connect('localhost', 'root', '', 'sduserdb');

	//logic for register module
	if (isset($_POST['reg_user'])) {
		// call register handler function
		register_handler($db);
	}

	// login module
	function loginHandler ($db) {
		// init return value
		/*$failed = true;
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
		return $failed;*/

			$username = mysqli_real_escape_string($db, $_POST['username']);
			$password = mysqli_real_escape_string($db, $_POST['password']); 

				$password = md5($password);
				$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
				$results = mysqli_query($db, $query);


				$count = mysqli_num_rows($results);
				if($count == 1)
				{
					$_SESSION['username'] = $username;
					//notifies user of login success
					echo '<script>alert("Login successful."); 
								location = "index.php"; </script>';
				}
				else{
					//notifies user of login failure
				echo '<script>alert("Wrong username/password combination.")</script>'; 
				}
	}

	
	// logic for login module 
	if (isset($_POST['login_user'])) {
		// call login handler function
		loginHandler($db);
	}
	
?>