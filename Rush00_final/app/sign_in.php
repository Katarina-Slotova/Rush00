<?php
include 'auth.php';

session_start();

function valid_request() {
	if ($_POST['customer'] &&
		$_POST['passwd'] && 
		$_POST['submit'] &&
		$_POST['submit'] === "OK")
	{
		if (auth($_POST['customer'], $_POST['passwd'])) {
			$_SESSION["logged_in"] = $_POST['customer'];
			header('Location: '.'../index.php');
		} else {
			echo 'You could not log in'.PHP_EOL;
		}
	}
}
valid_request();
?>
