<?php
session_start();

$storage_location = './db/customers.csv';
header('Location: '.$_SERVER["HTTP_REFERER"]);

$customers = unserialize(file_get_contents($storage_location));
print_r($customers);
for ($i=0; $i < count($customers); $i++) { 
	if ($customers[$i]['customer'] === $_SESSION['logged_in']) {
		array_splice($customers, $i, 1);
		$_SESSION['logged_in'] = '';
		break;
	}
}

file_put_contents($storage_location, serialize($customers));
?>
