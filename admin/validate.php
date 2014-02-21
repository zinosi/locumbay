<?php

include('functions.php');  

$error = ""; // Initialize error as blank

$record = array(
				'lname' 	=> 'First Name',
				'llname' 	=> 'Last Name',
				'userName' 	=> 'Username',
				'password'	=> 'Password',
				'confirm_password' => 'Repeat Password',
				'email' => 'Email Address',
				'dob'	=> 'Date of Birth',
				'housenum' => 'Address 1',
				'address' => 'Address 2',
				'postcode' => 'Post-Code',
				'city' => 'City',
				'country' => 'Country',
				'telnum'  => 'Telephone Number',
				'GPhCnum' => 'GPhC Pharmacy Registration Number',
				'ninum'  => 'National Insurance Number',
				'qualify' => 'Where did you qualify?',
				'csinuse' => 'Computer System in Use',
				'nationality' => 'Nationality',
				'mobnumb' => 'Mobile Number',
				'compName' => 'Company Name',
				'store' => 'Store',
				'startdate' => 'Start Date',
				'enddate' => 'End Date',
				'price' => 'Price',
				'vatnum' => 'Vat Number',
				'compnumb' => 'Company Number',
				'UserType' => 'User Type',
				'address1' => 'Address 1',
				'pharmacyName'=>'Pharmacy Name',
				'branchName'=>'Branch Name/Number',
				'item_pday'=>'Number of Items/day',
				'staff'=>'Number of Staff',
				'ref1firstname'=>'Reference 1 First Name',
				'ref1lastname'=>'Reference 1 Last Name',
				'ref1relationship'=>'Reference 1 Relationship',
				'ref1knowref'=>'Reference 1 How long have you known Reference',
				'ref1compName'=>'Reference 1 Company Name',
				'ref1address1'=>'Reference 1 Address1',
				'ref1postcode'=>'Reference 1 Postcode',
				'ref1email'=>'Reference 1 Email Address',
				'ref1telnum'=>'Reference 1 Telephone Number',
				'ref2firstname'=>'Reference 2 First Name',
				'ref2lastname'=>'Reference 2 Last Name',
				'ref2relationship'=>'Reference 2 Relationship',
				'ref2knowref'=>'Reference 2 How long have you known Reference',
				'ref2compName'=>'Reference 2 Company Name',
				'ref2address1'=>'Reference 2 Address1',
				'ref2postcode'=>'Reference 2 Postcode',
				'ref2email'=>'Reference 2 Email Address',
				'ref2telnum'=>'Reference 2 Telephone Number',
				);


if (isset($_POST['submit']) || isset($_POST['edit_details']) || isset($_POST['login'])) { // check if the form is submitted
	#### removing extra white spaces & escaping harmful characters ####
//	echo '<pre>',print_r($_POST);
	foreach($_POST as $key => $value)
	{
		if(is_array($value))
		{
			$$key  = $value;
		//	print_r($$key);
		}
		else{
		if($key == 'password'){$$key  = $value;}
		else{$$key = mysql_real_escape_string(trim($value));}
		}
		if($key!='dob' && $key != 'address' && $key != 'mobnumb'){
			if($key != 'submit')
			if(isset($record[$key]))
			{
				validate_empty($$key,$record[$key]);
			}
			
			if(isset($_POST['submit'])) 
			{
				if($key == 'email')
				validate_email($$key);
			}
		}
	}//foreach()
	if(isset($password) && isset($confirm_password))
	{
	validate_same($password,$confirm_password,'Password');
	}
	# Validate Username #
		// if its not alpha numeric, throw error
	//	if (!ctype_alnum($username)) {
	//		$error .= '<p class="error">Username should be alpha numeric characters only.</p>';
	//	}
		// if username is not 3-20 characters long, throw error
	//	if (strlen($username) < 3 OR strlen($username) > 20) {
	//		$error .= '<p class="error">Username should be within 3-20 characters long.</p>';
	//	}

	# Validate First Name #
		// if its not alpha numeric, throw error
	//	if (!ctype_alpha(str_replace(array("'", "-"), "",$first_name))) { 
	//		$error .= '<p class="error">First name should be alpha characters only.</p>';
	//	}
		// if first_name is not 3-20 characters long, throw error
	//	if (strlen($first_name) < 3 OR strlen($first_name) > 20) {
	//		$error .= '<p class="error">First name should be within 3-20 characters long.</p>';
	//	}

	# Validate Last Name #
		// if its not alpha numeric, throw error
	//	if (!ctype_alpha(str_replace(array("'", "-"), "", $last_name))) { 
	//		$error .= '<p class="error">Last name should be alpha characters only.</p>';
	//	}
		// if first_name is not 3-20 characters long, throw error
	//	if (strlen($last_name) < 3 OR strlen($last_name) > 20) {
	//		$error .= '<p class="error">Last name should be within 3-20 characters long.</p>';
	//	}

	# Validate Password #
		// if first_name is not 3-20 characters long, throw error
	//	if (strlen($password) < 3 OR strlen($password) > 20) {
	//		$error .= 'Password should be within 3-20 characters long.';
	//	}

	# Validate Confirm Password #
		// if first_name is not 3-20 characters long, throw error
	//	if ($confirm_password != $password) {
	//		$error .= 'Confirm password mismatch.';
	//	}
	
if(isset($email) && isset($_POST['submit']))
{
	$queryEmail = "SELECT * FROM common_users WHERE c_emailadd ='$email'";
	$resultEmail = mysql_query($queryEmail);
	$foundEmail = mysql_num_rows($resultEmail);
	
	$queryuser = "SELECT * FROM common_users WHERE c_username ='$userName'";
	$resultuser = mysql_query($queryuser);
	$foundUser = mysql_num_rows($resultuser);

	# Validate Email #
		// if email is invalid, throw error
		/*if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // you can also use regex to do same
			$error .= 'Enter a valid email address.';
		}
		else*/
		if($foundEmail)
		{
			$error .= "<li>User with Same Email address Already Present.</li>";
		}
		
		if($foundUser)
		{
			$error .= "<li>Username Already Exists.</li>";
		}
}
	# Validate Phone #
		// if phone is invalid, throw error
	//	if (!ctype_digit($phone) OR strlen($phone) != 10) {
	//		$error .= '<p class="error">Enter a valid phone number.</p>';
	//	}

	# Validate Gender #
		// if gender is not selected or invalid, throw error
	//	if ($gender != 'male' && $gender != 'female') {
	//		$error .= '<p class="error">Please select your gender.</p>';
	//	}

	# Validate Blood Group #
		// if blood group is not selected, throw error
	//	if ($blood_group == 0) {
	//		$error .= '<p class="error">Please select your blood group.</p>';
	//	}

	# Validate Date of Birth (DOB) #
		// if day is not 1-31, throw error
	//	if (intval($day)<1 OR intval($day)>31) {
	//		$error .= '<p class="error">Enter a valid day between 1-31.</p>';
	//	}
		// if month is not 1-12, throw error
	//	if (intval($month)<1 OR intval($month)>12) {
	//		$error .= '<p class="error">Enter a valid month between 1-12.</p>';
	//	}
		// if age is below 18 , throw error
	//	if ($age < 18) {
	//		$error .= '<p class="error">You should be at least 18 years old.</p>';
	//	}

	# Validate Bio #
	//	if (strlen($bio)==0 OR strlen($bio)>240) {
	//		$error .= '<p class="error">Please write something about you withing 240 characters.</p>';
	//	}

	#### end validating input data ####
	#####################################
}


?>