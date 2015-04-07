<?php
require "core/init.php";
$members		=$users_obj->get_users();
$member_count	= count($members);
?>

<!doctype html>
<html lang='nl'>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href"css/syle.css">
	<title>Members</title>
</head>
<body>
	<div id="container">
		<h1> Our members</h1>
		<p>We have a total of <strong><?php echo $member_count;?></strong> registered users.</p>

		<?php
		foreach($members as $member){
			echo "<p>".$member["username"]." joined: ". date("F j, Y", $member["time"]). "<p>";
		}
		?>
	</div>
</body>
</html>