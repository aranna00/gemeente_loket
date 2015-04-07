<?php
require "core/init.php";
$general_obj->logged_out_protect();



$user		=$users_obj->userdata($_SESSION["id"]);
$username	=$user->username;
$test = $kapvergun_obj->checkForKap($username,$_SESSION["id"],$user->role);
$error=	array(1=> "een van de velden is niet ingevuld","de query is niet goed gegaan");
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
				<td>ID</td><td>naam</td><td>confirmed</td><td>accepted</td><td>comment</td>
			</tr>
				<?php
				foreach($test as $vergunning){
					echo "<tr>";
					echo "<td> $vergunning->ID </td>";
					echo "<td> $vergunning->USER </td>";
					echo "<td> $vergunning->CONFIRMED </td>";
					echo "<td> $vergunning->ACCEPTED </td>";
					echo "<td> $vergunning->COMMENT </td>";
					echo "</tr>";
				}
				?>
		</table>
		<?php endif; ?>
		<?php
		if(isset($_GET["new"])): ?>
			<div id="kapAanvraag">
				<form id="Kap" method="POST" action="Send.php">
					<input type="hidden" name="username" value="<?php echo $username; ?>" class="kap"><br>
					<input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>" class="kap"><br>
					<TEXTAREA name="COMMENT" placeholder="Plaats hier uw reden van het aanvragen van een kapvergunning." class="kap"></TEXTAREA><br>
					<input type="checkbox" name="spoed" value="1"> spoed<br>
					<input type="submit" class="blargh" value="aanvragen" class="kap">
				</form>
			</div>
		<?php else: ?>
			<div>
				<input class="blargh" type="button" value="vergunning aanvragen" onclick="location.href='kapvergunning.php?new'">
			</div>
		<?php endif; ?>
	</div>
</body>
</html>