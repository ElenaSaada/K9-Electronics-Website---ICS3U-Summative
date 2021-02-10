<?php
$mysql = new mysqli("localhost", "root", "", "I");
$result = $mysql->query("SELECT DISTINCT Company FROM Products");
$result2 = $mysql->query("SELECT DISTINCT Category FROM Products");
?>	 

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="website.css">
  </head>

	<br>
	<div class=navBar>
	<ul>
	 <li><a href="website.php" class="button">Home</a>
	 <li><a href="cart.php">Cart</a></li>
	 <li><a href="returns.php">Refunds</a></li>
	  <li class="dropdown">
		<a class="dropbtn">Shop by Brand</a>    
		<div class="dropdown-content">
			<?php
				$increment = 0;
				while($row = $result->fetch_object()) {
					$company[$increment] = $row->Company;
					echo "<a href='?brand=$increment' name='brand'>$company[$increment]</a>";
					$increment++;
				}
			?>
		 </div>
	  </li>
		<li class="dropdown">
		<a class="dropbtn">Shop by Products</a>
		<div class="dropdown-content">
			<?php
				$increase = 0;
				while($row = $result2->fetch_object()) {
					$category[$increase] = $row->Category;
					echo "<a href='?product=$increase' name='product'>$category[$increase]</a>"; 
					$increase++;
				}
			?> 
		</div>
	  </li>
	<form class="example" action="search.php">
    <input type="text" placeholder="Search.." name="search">
		<form action="search.php" method="GET">
		<input type="submit">
		</form>
		
			<?php
			
			// search function
				/*$value = $_GET['search'];
				$min_length = 50;
				
				if(strlen($value) >= $min_length) {
					$value = htmlspecialchars($value);
					
					$value = mysql_real_escape_string($value);
					$results = mysql_query("SELECT * FROM Products
						WHERE('Name' LIKE '%".$value."%') OR ('text' LIKE '%".$value."%')) or die(mysql_error()");
				
					if(mysql_num_rows($results) > 0){
						while($result = mysql_fetch_array($raw_results)){
							echo "<p><h2>".$result['Name']."</h2>".$results['text']."</p>";
						}
					} else {
						echo "Your search has no results, please try again.";
					}
				}*/
			?>
	</form>
	</ul>
	</div> 
  <br>
  <br>

	<div id="mainSection">
	<?php
		global $item;
		$item = array();
		$key = 0;
		$print = $mysql->query("SELECT name FROM Products");
		while($print && $row = $print->fetch_object()) {	
			$item[$key] = $row->name;
			$key++;
		}
		if (isset($_GET['brand'])) {
			$brand = $_GET['brand'];
			$print = $mysql->query("SELECT productNumber, name, price, description FROM Products WHERE Company = '$company[$brand]'");				
			$i = 0;
			$y = 0;
			
      echo "<div class='wrapper'>";
			while($row = $print->fetch_object()) {
        echo "<div>";
				$comp[$i] = $row->productNumber;
				$comp2[$i] = $row->name;
				for ($index = 0; $index < count($item); $index++) {
					if ($comp2[$i] == $item[$index]) {
						echo "<br> <br>";
						echo "<a href='?item=$index' name='item'>$item[$index]</a>";
						break;
						$i++;
					}
				}
				echo"<br>";
				echo "<br>";
				echo "<img src='Summative Pics/$row->productNumber.png'>";
				echo "<br>";
				echo "$".$row->price.".00";
			
			$result3 = $mysql->query("SELECT quantity FROM Products");
			$options = $mysql->query("SELECT quantity FROM Products WHERE productNumber= $comp[$i]");
			?>
				<form method="POST">
					<button type='submit' name ='cart' value="<?= htmlspecialchars($comp[$i]) ?>">Add to Cart</button>
				
				<select name="<?= htmlspecialchars($comp[$i]) ?>">

			<?php
				while ($row2 = $result3->fetch_object()) {
					while($row3 = $options->fetch_object()) {
						for ($x = 1; $x <= $row3->quantity; $x++) {
							echo "<option value='$x'>$x</option>";					
						}
					}
				}?>
				</form>
				</select>
				<?php
				$y++;
      echo "</div>";        
			} 
      echo "</div>";
		} else if (isset($_GET['product'])) {
			$product = $_GET['product'];
			$print = $mysql->query("SELECT productNumber, name, price, description FROM Products WHERE Category = '$category[$product]'");
			
			$i = 0;
      echo "<div class='wrapper'>";
			while($row = $print->fetch_object()) {
      echo "<div>";      
				$cat[$i] = $row->productNumber;
				$cat2[$i] = $row->name;
				for ($index = 0; $index < count($item); $index++) {
					if ($cat2[$i] == $item[$index]) {
						//echo "<br>";
						echo "<a href='?item=$index' name='item'>$item[$index]</a>";
						break;
						$i++;
					}
				}
				echo "<br>";
				echo "<br>";
				echo "<img src='Summative Pics/$row->productNumber.png' class='wrapper'>";
				echo"<br>";
				echo "$".$row->price.".00";
				?>
				<form method='post'>
				<button type='submit' name ='cart' value="<?= htmlspecialchars($cat[$i]) ?>">Add to Cart</button>
				<select name="<?= htmlspecialchars($cat[$i]) ?>">
				
				<?php
				$result3 = $mysql->query("SELECT quantity FROM Products");
				$options = $mysql->query("SELECT quantity FROM Products WHERE productNumber= $cat[$i]");				
			
				while ($row2 = $result3->fetch_object()) {
					while($row3 = $options->fetch_object()) {
						for ($x = 1; $x <= $row3->quantity; $x++) {
							echo "<option value='$x'>$x</option>";					
						}
					}
				}?>
					</form>
					</select>
					<?php
        echo "</div>";  
			}
      echo "</div>";  
		} 
		if (isset($_GET['item'])) {
			//$i = 0;
			$brandComp = $_GET['item'];
			$display = $mysql->query("SELECT productNumber, name, price, description FROM Products WHERE name = '$item[$brandComp]'");
			while($row = $display->fetch_object()) {	
				echo $item[$brandComp]; ?>
				<form method='post'>
				<button type='submit' name ='cart' value="<?= htmlspecialchars($item[$brandComp]) ?>">Add to Cart</button>
				</form>
				<?php
				echo "<br>";
				echo "$".$row->price.".00";
				echo "<br>";
				echo "<img src='Summative Pics/$row->productNumber.png' class='wrapper'>";
				echo"<br>";
				echo $row->description;
				echo"<br>";
			}
		} 
		 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			 if (isset($_POST['cart'])) {
				$cart = $_POST['cart'];  
				/*for ($z = 0; $z < 4; $z++) {
					if(!empty($_POST['quantityNumber'])) {
						$number = $_POST['quantityNumber'][$z];
					//	break;
					}
				}*/
				
				//for ($z = 0; $z < 4; $z++) {
					//if(empty($_POST[$cart])) {
						$number = $_POST[$cart];
						$new = 10 - $number;
						echo $cart;
						$mysql->query("UPDATE Products SET quantity = $new WHERE productNumber = $cart");
						//break;
					//}
				//}
				//if ($cart == $number2) {
				//	$number = $number2;
				//}
				//echo $cart;

				$addCart = $mysql->query("SELECT productNumber, price, name, quantity FROM Products WHERE productNumber = '$cart'");
				while($row = $addCart->fetch_assoc()) {
					$array[] = $row;
					echo $array[0]['price'];
				}
			}
				$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$validUrl = str_replace("&","&amp;", $url);
	
				if($validUrl != 'localhost/submit.php' && $validUrl != 'localhost/returnItems.php') {
				
				$a = $array[0]['name'];
				$b = $array[0]['price'] * $number;
				$c = $array[0]['productNumber'];
				$d = $number;
				$sqlInsert = "INSERT INTO Cart (Name, Price, productNumber, quantity)
					   VALUES ('$a','$b', '$c', '$d')";
								   
				if (mysqli_query($mysql, $sqlInsert)) {
					echo "";
				//} else {
					//echo "fail";
				}
			}
		 }
	?>
	</div>		
</html>