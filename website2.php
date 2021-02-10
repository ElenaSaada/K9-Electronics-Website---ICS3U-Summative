<?php
$mysql = new mysqli("localhost", "root", "", "Inventory");
$result = $mysql->query("SELECT DISTINCT Company FROM Products");
$result2 = $mysql->query("SELECT DISTINCT Category FROM Products");
?>	 

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="site.css">
  </head>
	<body>
<br>
<br>
<?php 
	$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$validURL = str_replace("&", "&amp;", $url);
	
if ($validURL == 'localhost/website2.php') {
	include "slideshow.html";
}
?>
<div class=navBar>
<ul>
 <li><a href="website2.php" class="button">Home</a>
 <li><a href="cart.php">Cart</a></li>
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
      <button type="submit">Search</button>
</form>
</ul>
</div> 

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
		while($row = $print->fetch_object()) {	
			$comp[$i] = $row->name;
			echo "<br>";		
			for ($index = 0; $index < count($item); $index++) {
	 			if ($comp[$i] == $item[$index]) {
					echo "<a href='?item=$index' name='item'>$item[$index]</a>";
					break;
					}
				}
				echo "<br>";
				echo "$".$row->price.".00";
				echo "<br>";
				echo "<img src='Electronics Picture/$row->productNumber.png'>";
				echo"<br>";
				?>
				<form method='post'>
				<button type='submit' name ='cart' value="<?= htmlspecialchars($comp[$i]) ?>">Add to Cart</button>
				</form>
				<?php	
				$i++;
			} 
	} else if (isset($_GET['product'])) {
		$product = $_GET['product'];
		$print = $mysql->query("SELECT productNumber, name, price, description FROM Products WHERE Category = '$category[$product]'");
		
		$i = 0;
		while($row = $print->fetch_object()) {					
			$cat[$i] = $row->name;
			echo "<br>";
			for ($index = 0; $index < count($item); $index++) {
			if ($cat[$i] == $item[$index]) {
					echo "<a href='?item=$index' name='item'>$item[$index]</a>";
					break;
				}
			}
			echo "<br>";
			echo "$".$row->price.".00";
			echo "<br>";
			echo "<img src='Electronics Picture/$row->productNumber.png'>";
			echo"<br>";
			?>
			<form method='post'>
			<button type='submit' name ='cart' value="<?= htmlspecialchars($cat[$i]) ?>">Add to Cart</button>
			</form>
			<?php	
			$i++;
		}
	} 
	if (isset($_GET['item'])) {
		$brandComp = $_GET['item'];
		$display = $mysql->query("SELECT productNumber, name, price, description, quantity FROM Products WHERE name = '$item[$brandComp]'");
		while($row = $display->fetch_object()) {	
			echo "<br>";
			echo $item[$brandComp];
			?>
			<form method='post'>
			<button type='submit' name ='cart' value="<?= htmlspecialchars($item[$brandComp]) ?>">Add to Cart</button>
			</form>
			<?php	
			echo "<br>";
			echo "$".$row->price.".00";
			echo "<br>";
			echo "<img src='Electronics Picture/$row->productNumber.png'>";
			echo"<br>";
			echo $row->description;
			echo"<br>";
			echo "Quantity: ".$row->quantity;
		}
	}
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		 if (isset($_POST['cart'])) {
			$cart = $_POST['cart'];  
			echo $cart;

			$addCart = $mysql->query("SELECT productNumber, price, name, quantity FROM Products WHERE name = '$cart'");
			while($row = $addCart->fetch_assoc()){
				$array[] = $row;
				echo $array[0]['price'];
			}
		  }
			$a = $array[0]['name'];
			$b = $array[0]['price'];
			$c = $array[0]['productNumber'];
			$d = $array[0]['quantity'];
			$sqlInsert = "INSERT INTO Cart (Name, Price, productNumber, quantity)
                   VALUES ('$a','$b', '$c', '$d')";
            if (mysqli_query($mysql, $sqlInsert)) {
				echo "success";
			} else {
				echo "fail";
		}
	 }
?>
</div>		
	</body>
</html>
