<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="website.css">
	</head>
	<body>
<form method = "post" action="refund.php">
<?php	
$mysql = new mysqli("localhost", "root", "", "I");
include 'newPage2.php';
  
if (isset($_POST['submit'])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $receiptNumber = $_POST['receiptNumber'];
  $result = $mysql->query("SELECT * FROM Orders WHERE ReceiptNumber=$receiptNumber");
  //$row = $result->fetch_assoc();

  echo "
  <h1>RETURN ITEMS</h1>
  <h2>Welcome back, $firstName!<h2>
  <h2>Please select the items you would like to return:</h2>";

    echo "<table align=center>";
	echo "<form action='refund.php' method='post'>";
    while ($row = $result->fetch_object()) {
		$pnum = $row->productNumber;
		$result2 = $mysql->query("SELECT name FROM Products WHERE productNumber = $pnum");
		while ($row2 = $result2->fetch_object()) {
			echo
			"<tr>
				<td>$row2->name</td>
				<td><img src='Summative Pics/$pnum.png' alt='$pnum' class='cart'></td>
				<td class='checkout'>
				<td>$row->quantity</td>
				<td class='checkout'><input type='checkbox' name='checkbox[]' value='$pnum'/></td>
				<tr>";
			}
		}
	echo "</table>";
  $mysql->close();
	}
?>
<button class="submit" type="submit" name= 'submit'>Continue</button> 
</form>
	<br>
	</body>
</html>