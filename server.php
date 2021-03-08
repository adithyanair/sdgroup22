<?php 
	session_start();

	// variable declaration
	$username = "";
	$password = "";

	// connect to database
	$db = mysqli_connect('ip', 'root', 'pw', 'db');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }


        //make sure the username is not taken
		$user_check_query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		
		if ($user) { // if user exists
		  if ($user['username'] === $username) {
			array_push($errors, "Username already exists");
		  }
		}

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

	// ... 

	// LOGIN USER
	/*if (isset($_POST['login_user'])) {
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
	}*/

	$ID = "admin";
	$pass = "123456";

if (isset($_POST["ID"]) && isset($_POST["pass"])) { 

    if ($_POST["ID"] === $anvandarID && $_POST["pass"] === $pass) { 
    
    $_SESSION["inloggedin"] = true; 

    header("Location: index.php"); 
    exit; 
    } 
        // Wrong login - message
        else {$wrong = "Bad ID and password, the system could not log you in";} 
}
	

?>