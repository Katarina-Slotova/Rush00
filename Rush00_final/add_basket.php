<?php
session_start();

$storage_location = './db/basket.csv'; // global
header('Location: '.$_SERVER["HTTP_REFERER"]);

create_basket_storage($storage_location);

$user_basket = array();
$basket = unserialize(file_get_contents($storage_location));
if (!is_array($basket))
	$basket = array();

for ($i=0; $i < count($basket); $i++) { 
	if ($basket[$i][0] === $_SESSION['logged_in']) {
		$user_basket = $basket[$i];
		array_splice($basket, $i, 1);
		break;
	}
}

if (empty($user_basket))
	$user_basket = array($_SESSION['logged_in'], $_POST['item']);
else {
	array_shift($user_basket);
	if (!in_array($_POST['item'], $user_basket)) {
		array_push($user_basket, $_POST['item']);
		array_unshift($user_basket, $_SESSION['logged_in']);
	}
}

array_push($basket, $user_basket);
//print_r($basket);
file_put_contents($storage_location, serialize($basket));

function create_basket_storage($storage_location) {
	if (!file_exists(dirname($storage_location)))
		mkdir(dirname($storage_location), 0777, true);
	if (!file_exists($storage_location))
		file_put_contents($storage_location, null);
}
?>
