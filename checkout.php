<?php
$mysql = new mysqli("localhost", "root", "", "Inventory");
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="website.css">
	</head>
	<body>
<?php
include "website.php"; 
?>
<h1>THANK YOU FOR YOUR PURCHASE!</h1>
	<?php
	//	$i = 0;
//		$result = $mysql->query("SELECT Count(receiptNumber) FROM Orders");
	//	$row = mysql_fetch_assoc($result);
	//	echo $row['c'];
	//		while($row = $result->fetch_assoc()) {
		//		$company[$i] = $row->Company;
		//		echo "<a href='?brand=$increment' name='brand'>$company[$increment]</a>";
		//	echo $row;
		//	$i++;
	//		}
	?>
	<h2>Fill the following form to complete your purchase:</h2>
		<form method = 'post' action='submit.php'>
		  First Name:<br><input type="text" name="firstName"><br>
		  Last Name:<br><input type="text" name="lastName"><br>
	<!--	  <input type="submit" name="submit" value="Submit"/> -->
		<button class="submit" type="submit" name= 'submit'>Submit Order</button>
		</form>
	<br>
<?php	
/*if (isset($_POST['submit'])) {
	echo "yes";
		$firstName = htmlentities($_POST['firstName']);
		$lastName = htmlentities ($_POST['lastName']);
		$sqlInsert = "INSERT INTO Orders (firstName, lastName, category, quantity)
                  VALUES ('$firstName','$lastName', 'phones', '10')";
          if (mysqli_query($mysql, $sqlInsert)) {
			echo "success";
		} else {
			echo "fail";
	}
echo "<h2>HERE IS YOUR RECEIPT NUMBER:</h2>";
$receiptNumber = $mysql->query("SELECT receiptNumber FROM Orders WHERE firstName = '$firstName' AND lastName = '$lastName'");
while($row = $receiptNumber->fetch_object()){
	echo $row->receiptNumber;
}
}*/
?>
	</body>
</html>