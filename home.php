<?php
require "core/init.php";
$general_obj->logged_out_protect();

$user		=$users_obj->userdata($_SESSION["id"]);
$username	=$user->username;

$responses= array(1=> 	"je aanvraag voor een kapvergunning is succesvol verzonden",
						"test");
?>

<!doctype html>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<title>Home</title>
</head>
<body>
	<div id="container">
		<div id="header"><?php include "header.php" ?></div>
		<div id="responses"><?php if(isset($_POST["resp"])){echo "</div>";} ?>
	</div>


</body>
</html>