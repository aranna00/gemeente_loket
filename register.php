<?php
require 'core/init.php';
$general->logged_in_protect();

if (isset($_POST['username'])){
	if(empty($_POST['username']) || empty($_POST['p']) || empty($_POST['email'])){
		$errors[]="All fields are required.";
	}
	else{
		if($users->user_exists($_POST["username"]) === true){
			$errors[]="That username already exists.";
		}
		if(!ctype_alnum($_POST["username"])){
			$errors[]="please enter a username with only letters and numbers.";
		}
		if(strlen($_POST["p"]) <6){
			$errors[]="Your password must be at least 6 characters";
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
			$errors[]="Please enter a valid email address";
		}
		else if($users->email_exists($_POST["email"])===true){
			$errors[]="That email already has an account";
		}
	}

	if(empty($errors)===true){
		$username	=htmlentities($_POST["username"]);
		$password	= $_POST["p"];
		$email 		=htmlentities($_POST["email"]);

		$users->register($username, $password, $email);
		header("location: register.php?success");
		exit();
	}
}



?>
<!doctype html>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" >
	<title>Register</title>
	<script type="text/javascript" src="assets/js/forms.js"></script>
	<script type="text/javascript" src="assets/js/sha512.js"></script>
</head>
<body>
	<div id="container">
		<div id="header"><?php include "header.php" ?></div>
		<form method="POST" action="<?php echo $general->esc_url($_SERVER['PHP_SELF']); ?>" name="registration_form">
			<h4>Username:</h4>
			<input type="text" name="username" id="username" placeholder="Username">
			<h4>Password:</h4>
			<input type="password" name="password" id="password" placeholder="Password">
			<h4>Confirm password:</h4>
			<input type="password" name="confirmpwd" id="confirmpwd" placeholder="Confirm password" >
			<h4>Email:</h4>
			<input type="email" name="email" placeholder="Email">
			<br>
			<input type="button" value="Register" id="send" onclick="return regformhash(this.form, this.form.username, this.form.password, this.form.confirmpwd);">
		</form>

		<?php
			if(isset($_GET["success"]) && empty($_GET["success"])){
				echo "Thank you for registering";
			}

			if(empty($errors)===false){
				echo "<p>".implode("</p><p>", $errors). "</p>";
			}
		?>

	</div>

<script type="text/javascript" src="assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="assets/js/ajax.js"></script>

</body>
</html>