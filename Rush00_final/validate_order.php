<?php
session_start();

header('Location: '.$_SERVER["HTTP_REFERER"]);

$storage_location = './db/validated_orders.csv';
$user_basket = array();

create_basket_storage($storage_location);

$validated = unserialize(file_get_contents($storage_location));
if (!is_array($validated))
	$validated = array();
$basket = unserialize(file_get_contents('./db/basket.csv'));

for ($i=0; $i < count($basket); $i++) { 
	if ($basket[$i][0] === $_SESSION['logged_in']) {
		$user_basket = $basket[$i];
		print_r($user_basket);
		array_push($validated, $user_basket);
		print_r($validated);
		array_splice($basket, $i, 1);
		break;
	}
}
file_put_contents('./db/basket.csv', serialize($basket));
file_put_contents($storage_location, serialize($validated));

function create_basket_storage($storage_location) {
	if (!file_exists(dirname($storage_location)))
		mkdir(dirname($storage_location), 0777, true);
	if (!file_exists($storage_location))
		file_put_contents($storage_location, null);
}
?>