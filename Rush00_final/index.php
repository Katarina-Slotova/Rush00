<?php
session_start();
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
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
		if ($_SESSION['logged_in'] !== '')
		{
			echo '<p class="signed">You are signed in as '.$_SESSION['logged_in'].'</p>';
			echo '<div style="z-index: 10" class="signed"><form method="post" action="logout.php"> 
			<input class="logout" type="submit" name="logout" value="Log Out"/>
			</form></div>';
			echo '<div  class="signed"><form method="post" action="delete_account.php"> 
			<input class="delete" type="submit" name="logout" value="Delete Account"/>
			</form></div>';
		} else {
			echo '<div  class="signing">
			<a href="sign_in.html">Sign In</a>
			<a href="sign_up.html">Sign Up</a>
			</div>';
		}
	?>
	</nav>
	<h1>Welcome to NFT paradise</h1>
	<div class="container">
	<?php
		echo '<div class="gallery">';
		$nfts = fopen('db/products.csv', 'r');
		for ($i = 0; $i < 6; $i++) {
			if ($i % 2 == 0)
			echo '<div class="row">';
			$line = fgetcsv($nfts, 1000, ",");
			echo '<div class="nft-item">';
			echo '<img class="nft-img" src="./img/'.$line[1].'.png">';
			echo '<div class="nft-price">';
			echo '<p>Price: $'.$line[3].'</p>';
			echo '<form method="post" action="./add_basket.php"> 
			<input class="logout" type="hidden" name="item" value="'.$line[1].'"/>
			<input class="logout" type="submit" name="submit" value="Add to basket"/>
			</form>';
			echo '</div>';
			echo '</div>';
			if ($i % 2 != 0)
			echo '</div>';
		}
		echo '</div>';
	?>
	</div> <!-- container -->
</body>
</html>