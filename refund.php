<?php	
$mysql = new mysqli("localhost", "root", "", "I");
include 'newPage2.php';

echo "<h1>REFUNDED ITEMS:</h1>";
echo "<br>";
if (isset($_POST['submit'])) {
	if (isset($_POST['checkbox'])) {
		$product = $_POST['checkbox'];
		foreach($product as $key => $value) {
			$mysql->query("DELETE From Orders WHERE productNumber = '$value'");
			$name = $mysql->query("SELECT name FROM Products WHERE productNumber = '$value'");
			while ($row = $name->fetch_object()) {
				echo "<h2>$row->name<h2>";
				echo "<br>";
			}
		} 
	}
}
$mysql->close();
?>