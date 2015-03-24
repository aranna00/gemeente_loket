<div id=""></div>

<!-- <div id="logo"><img src="pics/logo.gif"/></div> -->
<div id="menu">
	<?php
	if(isset($_SESSION["id"])){
		$user		=$users->userdata($_SESSION["id"]);
		$username	=$user["username"];
	}
	if(!isset($_SESSION["id"])): ?>
		<ul>
			<li><a href="index.php" class="blargh">Home</a></li>
			<li><a href="register.php" class="blargh">Register</a></li>
			<li><a href="login.php" class="blargh">Login</a></li>
		</ul>
	<?php else :?>
		<ul>
			<li><a href="home.php" class="blargh">Home</a></li>
			<li><a href="logout.php" class="blargh">Logout</a></li>
			<li><a href="kapvergunning.php" class="blargh">kapvergunning</a></li>
			<li><a href="afspraken.php" class="blargh">afspraken</a></li>
		</ul>
	<?php endif; ?>
</div>