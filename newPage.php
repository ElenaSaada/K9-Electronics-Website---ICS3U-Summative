<?php
$mysql = new mysqli("localhost", "root", "", "Inventory");
$result = $mysql->query("SELECT DISTINCT Company FROM Products");
$result2 = $mysql->query("SELECT DISTINCT Category FROM Products");
?>	 

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Style.css">
  </head>

<br>
<div class=navBar>
<ul>
 <li><a href="website.php" class="button">Home</a>
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
<form class="example" action="action_page.php">
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
			$i++;
		} 
	} else if (isset($_GET['product'])) {
		$product = $_GET['product'];
		$print = $mysql->query("SELECT productNumber, name, price, description FROM Products WHERE Category = '$category[$product]'");
		
		$i = 0;
		while($row = $print->fetch_object()) {					
			$cat[$i] = $row->name;
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
			$i++;
		}
	} 
	if (isset($_GET['item'])) {
		$brandComp = $_GET['item'];
		$display = $mysql->query("SELECT productNumber, name, price, description FROM Products WHERE name = '$item[$brandComp]'");
		while($row = $display->fetch_object()) {	
			echo $item[$brandComp];
			echo "<br>";
			echo "$".$row->price.".00";
			echo "<br>";
			echo "<img src='Electronics Picture/$row->productNumber.png'>";
			echo"<br>";
			echo $row->description;
			echo"<br>";
		}
	}   
?>
</div>		
</html>