<?php
require "core/init.php";
$general_obj->logged_out_protect();


$user		=$users_obj->userdata($_SESSION["id"]);
$username	=$user->username;
$test		=$afspraak_obj->checkAfspraak($username,$_SESSION["id"],$user->role);
$error = array(1=> "niet alles is ingevuld","query is mislukt" )
?>

<!doctype html>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<title>Kapvergunning</title>
</head>
<body>
	<div id="container">
		<div id="header">
			<div id="header"><?php include "header.php" ?></div>
		</div>

		<div id="error">
			<?php 
				if(isset($_GET["err"])){
					echo $error[$_GET["err"]];
				}
			?>
		</div>
		<?php if(!isset($_GET["new"])): ?>
		<table border=1>
			<tr>
				<td>ID</td>
				<td>naam</td>
				<td>vraag</td>
				<td>datum</td>
			</tr>
				<?php
					foreach($test as $afspraak): ?>
						<tr>
						<td><?= $afspraak->ID ?></td>
						<td><?= $afspraak->USER ?></td>
						<td><?= $afspraak->REDEN ?></td>
						<td><?= $afspraak->DATUM ?></td>
						</tr>
					<?php endforeach ?>
		</table>
		<?php endif; ?>
		<?php
		if(isset($_GET["new"])): ?>
			<div id="afspraak">
				<form id="afpr" method="POST" action="Send.php">
					<input type="hidden" name="username" value="<?php echo $username; ?>" class="afpr"><br>
					<input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>" class="afpr"><br>
					<TEXTAREA name="REDEN" placeholder="Plaats hier uw reden van het aanvragen van een afspraak." class="afpr"></TEXTAREA><br>
					<input type="submit" class="blargh" value="aanvragen" class="afpr">
				</form>
			</div>
		<?php else: ?>
			<div>
				<input class="blargh" type="button" value="afspraak maken" onclick="location.href='afspraken.php?new'">
			</div>
		<?php endif; ?>
	</div>
</body>
</html>