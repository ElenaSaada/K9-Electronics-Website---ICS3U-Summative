<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="website.css"/>
<?php	
$mysql = new mysqli("localhost", "root", "", "inventory");
include 'newPage2.php';
$value = $_GET['search'];

//.$row['ProductNumber'].
echo $value;
echo "<br><br>";
$result = $mysql->query("SELECT * FROM Products
  WHERE name LIKE '%$value%'"); //or die(mysql_error());
  
if(mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<h2><a href='?item=".$row['ProductNumber']."' name='item'>".$row['Name']."</a></h2>";
  }
} else {
  echo "<h2>Your search has no results, please try again.<h2>";
}


/*if(strlen($value) >= $min_length) {
  $value = htmlspecialchars($value);*/
 // include 'newPage2.php';
  /*$value = mysqli_real_escape_string($mysql, $value);
  echo "$value";
  $result = $mysql->query("SELECT * FROM Products
    WHERE name LIKE '%$value%'"); //or die(mysql_error());
   
  while ($row = $result->fetch_object()) {
    echo "$row->productNumber";
  }
  
  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      echo "<p><h2>$row->productNumber</p>";
    }
  } else {
    $num = mysqli_num_rows($result); 
	echo "Your search has no results, please try again.";
	echo $num;
  }*/
 mysqli_free_result($result);
?>