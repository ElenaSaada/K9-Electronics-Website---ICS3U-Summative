<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="site.css">
	</head>
	<body>
	<?php //require 'newPage.php'; 
	include 'website.php';
	$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$validURL = str_replace("&", "&amp;", $url);
	
if ($validURL == 'localhost/cart.php') {
	echo "<h1>YOUR CART</h1>";
	echo "<br>";
      $mysql = new mysqli("localhost", "root", "", "inventory");
      $result = $mysql->query("SELECT * FROM Cart");
	 // $total = $mysql->query("SELECT SUM(price) FROM Cart");
	  $calculate = $mysql->query('SELECT SUM(price) AS price_sum FROM Cart'); 
	  $row = $calculate->fetch_assoc();
	  $sum = $row['price_sum'];
	  $total = $sum * 1.13;
      
      echo "<table align=center> <form action='deleteItem.php' method='post'>";
      
      while ($row = $result->fetch_object()) {
        echo
        "<tr>
          <td><img src='Summative Pics/$row->ProductNumber.png' alt='$row->ProductNumber' class='cart'></td>
          <td>$row->Name</td>
          <td class='checkout'>$$row->Price.00</td>
          <td class='checkout'>
            <td>$row->Quantity</td>";
			//<select>";
			//$options = $mysql->query("SELECT quantity FROM Product WHERE ProductNumber='$row->ProductNumber'");
			//echo "poo";
			//while($row = $options->fetch_object()) {
				//$b = $row->quantity;
				//echo $row->quantity;
				//for ($x = 0; $x <= $row->quantity; $x++) {
					//echo "<option value='$x'>$x</option>";
				//}
			//}

      }
      echo "</form>";
      
      echo
      "<tr>
        <td>HST</td>
        <td></td>
        <td class='checkout'>%13</td>
        <td class='checkout'></td>
        <td class='checkout'></td>
      </tr>
      <tr>
        <td>TOTAL</td>
        <td></td>
        <td class='checkout'>$total</td>
        <td class='checkout'></td>
        <td class='checkout'></td>
      </tr>
      </table>";
      $mysql->close();
		echo "<br>";
		echo "<h2><a href='checkout.php'>CHECKOUT</h2>";
	}
?>
	</body>
</html>