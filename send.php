<?php

require "core/init.php";
if(isset($_POST["userid"])&&isset($_POST["username"])&&isset($_POST["COMMENT"])){
	if(!isset($_POST["spoed"])){$spoed="";}
	$id=$_POST["userid"];
	$username=$_POST["username"];
	$comment=$_POST["COMMENT"];
	if(!$kapvergun->aanvragen($id,$username,$comment,$spoed)){
		header("location:kapvergunning.php?new&err=2");
		die();
	}
	else{
		header("location:home.php?resp=1");
		die();
	}

}
else{
	header("location:kapvergunning.php?new&err=1");
}

if(isset($_POST["userid"])&&isset($_POST["username"])&&isset($_POST["REDEN"])){
	$id=$_POST["userid"];
	$username=$_POST["username"];
	$reden=$_POST["REDEN"];
	if(!$afspraak->aanvragen($id,$username,$reden)){
		header("location:afspraken.php?new&err=2");
		die();
	}
	else{
		header("location:home.php?resp=1");
		die();
	}
	// echo $afspraak->aanvragen($id,$username,$reden))

}
else{
	// header("location:afspraken.php?new&err=1");
}	

