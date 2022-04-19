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
	<div class="container">
		<div class="row">
			<?php
				$nfts = file('db/products.csv');
				foreach ($nfts as $nft) {
					$nft_arr = explode(',', $nft);
					if ($nft_arr[2] == 'animals') {
						echo '<div class="nft-item">';
						echo '<img class="nft-img" src="./img/'.$nft_arr[1].'.png" alt="'.$nft_arr[1].'-pic">';
						echo '<div class="nft-price">';
						echo '<p>Price: $'.$nft_arr[3].'</p>';
						echo '<form method="post" action="./add_basket.php"> 
						<input class="logout" type="hidden" name="item" value="'.$nft_arr[1].'"/>
						<input class="logout" type="submit" name="submit" value="Add to basket"/>
						</form>';
						echo '</div>';
						echo '</div>';
					}
				}
			?>
		</div>
	</div>
</body>
</html>