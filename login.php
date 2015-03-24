<?php
require "core/init.php";
$general->logged_in_protect();

if(empty($_POST) === false){
	$username = trim($_POST["username"]);
	$password = trim($_POST["p"]);

	if (empty($username) === true || empty($password) === true){
		$errors[] = "sorry, but we need your username and password.";
	}
	else if	($users->user_exists($username) === false){
		$errors[]="sorry that username doesn\'t exist.";
	}
	else if($users->email_confirmed($username)=== false){
		$errors[]="sorry, but you need to activate your account.
		Please check your email.";
	}
	else{
		$login = $users->login($username, $password);
		if ($login === false){
			$errors[]="Sorry, that username/password is invalid";
		}
		else{
			
			$_SESSION["id"] = $login;

			header("Location: home.php");
			exit();
		}
	}
}
?>
<!doctype html>
<html lang="nl">
<head>
	<meta charset="UTF-8">
	<script type="text/javascript" src="assets/js/forms.js"></script>
	<script type="text/javascript" src="assets/js/sha512.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" >
	<title>Login</title>
</head>
<body>	
	<div id="container">
		<div id="header"><?php include "header.php" ?></div>
 
		<?php if(empty($errors) === false){
 
			echo '<p>' . implode('</p><p>', $errors) . '</p>';			
 
		} 
		?>

		<form method="post" action="login.php">
			<h4>Username:</h4>
			<input type="text" name="username" placeholder="Username">
			<h4>Password:</h4>
			<input type="password" name="password" placeholder="Password">
			<br>
			<input type="submit" value="Login" id="send" onclick="formhash(this.form, this.form.password);">
		</form>
	</div>

<script type="text/javascript" src="assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="assets/js/ajax.js"></script>

</body>
</html>