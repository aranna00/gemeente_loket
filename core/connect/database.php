<?php

if (!defined('HOST')) define('HOST', "localhost");
if (!defined('USER')) define('USER', "gemeente_loket");
if (!defined('PASSWORD')) define('PASSWORD', "ujQnbH9vE66Ndd2G");
if (!defined('DATABASE')) define('DATABASE', "gemeente_loket");

$db = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USER, PASSWORD);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>