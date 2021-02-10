<?php
$mysql = new mysqli("localhost", "root", "", "Inventory");
$result = $mysql->query("SELECT DISTINCT Company FROM Products");
$result2 = $mysql->query("SELECT DISTINCT Category FROM Products");
?>	 

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="website.css">
  </head>

  <body>
<br>
<?php 
	include 'newPage2.php'; 
	$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$validUrl = str_replace("&","&amp;", $url);
	
	if($validUrl == 'localhost/website.php') {
		include "slideshow.html";
	}
?>
	</body>
</html>
