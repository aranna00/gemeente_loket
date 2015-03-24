<?php
require "core/init.php";
$general->logged_in_protect();
$err= array(1=> "je moet ingelogd zijn om die pagina te zien","je moet uitgelogd zijn om die pagina te zien komen");
?>
<!doctype html>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div id="container">
		<div id="header"><?php include "header.php" ?></div>
		<div id="main"></div>
		<div id="footer"></div>
	</div>
</body>
</html>