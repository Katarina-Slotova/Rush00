<?php

$storage_location = '../db/customers.csv'; // global

if (valid_request()) {
	session_start();

	create_account_storage();
	if (account_exists())
		echo "ERROR: account exists!\n";
	else {
		create_account();
		$_SESSION['logged_in'] = $_POST['customer'];
		header('Location: '.'../index.php');
	}
}

function valid_request() {
	return	$_POST['customer'] && $_POST['passwd'] &&
			$_POST['submit'] && $_POST['submit'] === "OK";
}

function create_account_storage() {
	global $storage_location;

	if (!file_exists(dirname($storage_location)))
		mkdir(dirname($storage_location), 0777, true);
	if (!file_exists($storage_location))
		file_put_contents($storage_location, null);
}

function account_exists() {
	global $storage_location;

	$accounts_db = unserialize(file_get_contents($storage_location));
	if ($accounts_db) {
		foreach ($accounts_db as $entry => $account)
			if ($account['customer'] === $_POST['customer'])
				return true;
		return false;
	}
}

function create_account() {
	global $storage_location;

	$accounts_db = unserialize(file_get_contents($storage_location));
	$accounts_db[] = array(	'customer' => $_POST['customer'],
							'passwd' => hash('whirlpool', $_POST['passwd']));
	file_put_contents($storage_location, serialize($accounts_db));
}
?>
