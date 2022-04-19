<?php
function auth($customer, $passwd) {
	$storage_location = '../db/customers.csv';

	if (!$customer || !$passwd)
		return false;
	$passwd = hash('whirlpool', $passwd);
	$accounts_db = unserialize(file_get_contents($storage_location));
	foreach ($accounts_db as $entry => $account) {
		if ($account['customer'] === $customer && $account['passwd'] === $passwd)
			return true;
	}
	return false;
}
?>