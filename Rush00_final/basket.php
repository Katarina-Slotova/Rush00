<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Basket</title>
</head>
<body>
	<nav>
		<ul class="dropdown">
			<li><a href="#">Categories</a>
			<ul class="categories"> 
				<li><a class="test" href="./nature.php">Nature</a>
				<li><a class="test" href="./animals.php">Animals</a></li>
				<li><a class="test" href="./people.php">People</a></li>
			</ul>
		</li>
	</ul>
	<a href="basket.php">See my basket</a>
	<a href="index.php"><img class="logo" src="./img/logo.png" alt=""></a>
	<?php
		if(isset($_POST['logout'])) {
			logout();
		}
		function logout() {
			$_SESSION['logged_in'] = '';
		}
		if ($_SESSION['logged_in'] !== '')
		{
			echo '<p class="signed">You are signed in as '.$_SESSION['logged_in'].'</p>';
			echo '<div  class="signed"><form method="post"> 
			<input class="logout" type="submit" name="logout" value="Log Out"/>
			</form></div>';
		} else {
			echo '<div  class="signing">
			<a href="sign_in.html">Sign In</a>
			<a href="sign_up.html">Sign Up</a>
			</div>';
		}
	?>
	</nav>
	<h1>Your basket:</h1>
<?php

$storage_location = './db/basket.csv';

$basket = unserialize(file_get_contents($storage_location));

foreach ($basket as $line) {
	$total = 0;
	if ($_SESSION['logged_in'] == $line[0]) {
		echo '<p>Customer: '.$line[0].'</p><br>';
		echo '<ul>';
		for ($i = 1; $i < count($line); $i++) {
			echo '<li>'.$line[$i].': $'.get_price($line[$i]).'</li><br>';
			$total += get_price($line[$i]);
		}
		echo '</ul>';
	}
}
echo '<p>Total Price: $'.$total.'</p>';
echo '<form method="post" action="./validate_order.php"> 
		<input class="validate-order" type="submit" name="validate-order" value="Validate order"/>
	</form>';

function get_price($item)
{
	$products = file("db/products.csv");

	foreach ($products as $line) {
		$data = str_getcsv($line);
		if ($data[1] === $item)
			return $data[3];
	}
	return 0;
}
?>
</body>
</html>
