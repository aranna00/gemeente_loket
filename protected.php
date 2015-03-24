<?php
require "core/init.php";
$general->logged_out_protect();

$user		=$users->userdata($_SESSION["id"]);
$username	=$user["username"];
$role		=$users->role_check($username);

if(!$role=="admin"){
	echo "nope";
}