<?php
date_default_timezone_set("Europe/Amsterdam");
session_start();
require 'connect/database.php';
require 'classes/users.php';
require 'classes/general.php';
require 'classes/kapvergun.php';
require 'classes/afspraak.php';

$users_obj		= new Users($db);
$general_obj	= new general();
$kapvergun_obj 	= new kapvergun($db);
$afspraak_obj	= new afspraak($db);

$errors		= array();

?>