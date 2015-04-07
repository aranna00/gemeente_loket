<?php
require 'core/init.php';
$general_obj->logged_in_protect();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" >
	<title>Activate</title>
</head>
<body>
	<div id="container">
		<?php include "menu.php";?>

		<?php

		if(isset($_GET["succes"]) === true && empty($_GET["success"])===true){
			?>
			<h3> Thank you, we,ve activated your account. you're free to log in </h3>
			<?php

		}
		else if(isset($_GET["email"], $_GET["email_code"]) === true){
			$email 		=trim($_GET['email']);
			$email_code =trim($_GET['email_code']);

			if($users_obj->email_exists($email) === false){
				$errors[] = 'Sorry we couldn\'t find that emailadres.';
			}
			else if($users_obj->activate($email, $email_code) ===false){
				$errors[]="Sorry, we couldn\'t activate your account";
			}

			if(empty($errors) === false){
				echo "<p>".implode("</p><p>",$errors) . "</p>";
			}
			else{
				header("location: activate.php?success");
				exit();
			}
		}
		else{
			header("location: index.php");
			exit();
		}
		?>
	</div>
</body>
</html>