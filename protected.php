<?php
require "core/init.php";
$general_obj->logged_out_protect();

$user		=$users_obj->userdata($_SESSION["id"]);
$username	=$user["username"];
$role		=$users_obj->role_check($username);

if(!$role=="admin"){
	echo "nope";
}