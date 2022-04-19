<?php
session_start();
header('Location: '.$_SERVER["HTTP_REFERER"]);

if(isset($_POST['logout'])) {
	logout();
}

function logout() {
	$_SESSION['logged_in'] = '';
}
?>
