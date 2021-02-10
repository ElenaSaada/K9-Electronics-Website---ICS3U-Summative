<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="website.css">
	</head>
	<body>
  <?php	
  $mysql = new mysqli("localhost", "root", "", "I");
  include 'newPage2.php';
  ?>
  <h1>RETURN ITEMS</h1>
	<h2>Fill the following form to return your purchases:</h2>
		<form method = 'post' action='returnItems.php'>
		  First Name:<br><input type="text" name="firstName"><br>
		  Last Name:<br><input type="text" name="lastName"><br>
      Receipt Number:<br><input type="text" name="receiptNumber"><br>
		<button class="submit" type="submit" name= 'submit'>Continue</button>
		</form>
	<br>
	</body>
</html>