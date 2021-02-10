<?php
$mysql = new mysqli("localhost", "root", "", "Inventory");
$result = $mysql->query("SELECT DISTINCT Company FROM Products");
$result2 = $mysql->query("SELECT DISTINCT Category FROM Products");
?>	 

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
  </head>

<br>

<ul>
  <li><a href="practiceWebsite.php" class="button">Home</a>
  <li><a href="#cart">Cart</a></li>
  <li class="dropdown">
    <a class="dropbtn">Shop by Brand</a>    
	<div class="dropdown-content">
		<?php
			$increment;
			while($row = $result->fetch_object()) {
				$company[$increment] = $row->Company;
		?>
				<a href="brandCategory.php" class="button"><?php echo $company[$increment]; ?></a>
		<?php
			$increment++;
			}
		?>
	 </div>
  </li>
    <li class="dropdown">
    <a class="dropbtn">Shop by Products</a>
    <div class="dropdown-content">
		<?php
			while($row = $result2->fetch_object()) {
		?>
		<a href="brandCategory.php" class="button"><?php echo $row->Category; ?></a>
		<?php
			}
		?>
	</div>
  </li>
<form class="example" action="action_page.php">
<input type="text" placeholder="Search.." name="search">
      <button type="submit">Search</button>
</form>
</ul>

<div class="title">
<h1>WELCOME TO K9 ELECTRONICS</h1>
<h2>THE STORE FOR ALL YOUR TECH NEEDS</h2>
</div>
<img src="Brand Logos/storelogo.png" alt="Website Logo">
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$brandNumber = $mysql->query("SELECT COUNT(DISTINCT Company) FROM Products");
		$number = $brandNumber->fetch_object();
	for ($i = 0; $i < $number; $i++) {
		while($row = $result->fetch_object()) {
			$company[$i] = $row->Company;
			if (isset($_POST[$company[$i]])) {
				$photo = $mysql->query("SELECT ProductNumber FROM Products WHERE Company = $company[$i]");
				while($row1 = $photo->fetch_object()) {		
					$image = $row1->ProductNumber;
?>
<img src="Electronics Picture/1.png">
<?php
				}	
			}
		}
	}
?>
</html>