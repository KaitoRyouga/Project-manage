<?php

	require_once 'class/user.php';

	session_start();

	$user = new user();
	$user->connect();

	// $edit = new edit();
	// $edit->connect();
?>