<?php
	session_start();
	session_destroy();
	
	// Redirect back to the original page
	$referer = $_SERVER['HTTP_REFERER'];
	header("Location: login.html");
?>
