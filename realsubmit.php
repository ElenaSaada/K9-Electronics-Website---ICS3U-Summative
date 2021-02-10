<?php	
$mysql = new mysqli("localhost", "root", "", "Inventory");
include 'website.php';
  
if (isset($_POST['submit'])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  
  $sqlInsert = "INSERT INTO receipts (firstName, lastName)
                VALUES ('$firstName','$lastName')";

  if (mysqli_query($mysql, $sqlInsert)) {
  } else {
    echo "fail";
  }
  
  $receiptNumber = $mysql->query("SELECT receiptNumber FROM Receipts WHERE firstName = '$firstName' AND lastName = '$lastName'");
  
  while($row = $receiptNumber->fetch_object()){
    $var1 = $row->receiptNumber;
  }
  //$var2 = strval($receiptNumber);
  echo 
  "<br>
  <h2>Thank you for shopping at K9 Electronic, $firstName!</h2>
  <p>Your receipt number is:</p>
  <h2>$var1</h2>
  <p>Please save this number for returns.</p>";
  
  /*if (isset($_POST['submit'])) {
 
      $receiptNumber = $mysql->query("SELECT receiptNumber FROM Orders WHERE firstName = '$firstName' AND lastName = '$lastName'");
      while($row = $receiptNumber->fetch_object()){
        echo $row->receiptNumber;
      }
  }*/
  
    $result = $mysql->query("SELECT * FROM Cart");
	$result3 = $mysql->query("SELECT * FROM receipts");
	  //$calculate = $mysql->query('SELECT SUM(price) AS price_sum FROM Cart'); 
	  //$row = $calculate->fetch_assoc();


    while ($row = $result->fetch_object()) {
		$productNumber = $row->ProductNumber;
		$quantity = $row->Quantity;
	}
	while ($row = $result3->fetch_object()) {
		$receiptNumber = $row->receiptNumber;
	}
		$sqlInsert = "INSERT INTO orders (receiptNumber, productNumber, quantity)
                VALUES ('$receiptNumber', '$productNumber', '$quantity')";
      $mysql->close();
	}

?>