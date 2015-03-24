<?php
date_default_timezone_set("Europe/Amsterdam");
session_start();
require 'connect/database.php';
require 'classes/users.php';
require 'classes/general.php';
require 'classes/kapvergun.php';
require 'classes/afspraak.php';

$users		= new Users($db);
$general	= new general();
$kapvergun 	= new kapvergun($db);
$afspraak	= new afspraak($db);

$errors		= array();

?>