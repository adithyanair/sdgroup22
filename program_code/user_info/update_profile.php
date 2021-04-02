<?php //include '../back_end/backend_main.php';
      include '../back_end/backend_user_info.php'; ?>

<!DOCTYPE html>
<html>
	<head>
		<title> PROFILE SETUP </title>
		<link rel="stylesheet" type="text/css" href="user_style.css">
	</head>
	
	<body>
		<div class="header">
			<h1>Setup or Update Your Profile</h1>
		</div>

		<form method="post" action="update_profile.php">

			<div class="input-group">
				<input type="text" class="form-control" placeholder=" Client Name*" name="client_name" maxlength="50" required>
			</div>
			<div class="input-group">
				<input type="text" class="form-control" placeholder=" Address 1*" name="client_add1" maxlength="100" required>
			</div>
			<div class="input-group">
				<!--- This is optional --->
				<input type="text" class="form-control" placeholder=" Address 2" name="client_add2" maxlength="100" >
			</div>
			<div class="input-group">
				<input type="text" class="form-control" placeholder=" City*" name="city" maxlength="100" required>
			</div>

			<div class="input-group">
				<!-- This will be connected with DB for the list of states -->
				<select class="state-control" id = "state" placeholder="State" name="state" required> 
				<option class="form-control" value="" placeholder="State">State*</option>
				<option value="AL">Alabama</option>
				<option value="AK">Alaska</option>
				<option value="AZ">Arizona</option>
				<option value="AR">Arkansas</option>
				<option value="CA">California</option>
				<option value="CO">Colorado</option>
				<option value="CT">Connecticut</option>
				<option value="DE">Delaware</option>
				<option value="FL">Florida</option>
				<option value="GA">Georgia</option>
				<option value="HI">Hawaii</option>
				<option value="ID">Idaho</option>
				<option value="IL">Illinois</option>
				<option value="IN">Indiana</option>
				<option value="IA">Iowa</option>
				<option value="KS">Kansas</option>
				<option value="KY">Kentucky</option>
				<option value="LA">Louisiana</option>
				<option value="ME">Maine</option>
				<option value="MD">Maryland</option>
				<option value="MA">Massachusetts</option>
				<option value="MI">Michigan</option>
				<option value="MN">Minnesota</option>
				<option value="MS">Mississippi</option>
				<option value="MO">Missouri</option>
				<option value="MT">Montana</option>
				<option value="NE">Nebraska</option>
				<option value="NV">Nevada</option>
				<option value="NH">New Hampshire</option>
				<option value="NJ">New Jersey</option>
				<option value="NM">New Mexico</option>
				<option value="NY">New York</option>
				<option value="NC">North Carolina</option>
				<option value="ND">North Dakota</option>
				<option value="OH">Ohio</option>
				<option value="OK">Oklahoma</option>
				<option value="OR">Oregon</option>
				<option value="PA">Pennsylvania</option>
				<option value="RI">Rhode Island</option>
				<option value="SC">South Carolina</option>
				<option value="SD">South Dakota</option>
				<option value="TN">Tennessee</option>
				<option value="TX">Texas</option>
				<option value="UT">Utah</option>
				<option value="VT">Vermont</option>
				<option value="VA">Virginia</option>
				<option value="WA">Washington</option>
				<option value="WV">West Virginia</option>
				<option value="WI">Wisconsin</option>
				<option value="WY">Wyoming</option>
				</select>  
			</div>

			<div class="input-group">
				<input type="text" class="form-control" placeholder=" Zip Code*" name="zipcode" minlength="5" maxlength="9" required>
			</div> 
			
			<div class="input-group">
				<button type="submit" class="form-control submit" name="submit">Submit</button>
			</div>
			
			<a href='../main/index.php' style='color:#ffffff; font-size:17px; letter-spacing:1px; text-decoration:none; text-shadow:4px 4px 4px #000000; position:fixed; top:50px; right:100px;">'>Return to Main Menu</a>

		</form>
	</body>
</html>
