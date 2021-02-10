<?php
	$user = 'root';
	$pass = '';
	$db = 'I';

	$mysql = new mysqli('localhost', $user, $pass, $db) or die("unable to connect");
	
	$makesql = "CREATE DATABASE I";
		if(mysqli_query($mysql, $makesql)) {  
    echo "Database created successfully";
		} else {
		echo "Error creating database: ";
	}

	//I


	$sql = "CREATE TABLE Products (
		ProductNumber INT AUTO_INCREMENT, 
		Name VARCHAR(500) NOT NULL,
		Company VARCHAR(15) NOT NULL,
		Category VARCHAR(20),
		Description VARCHAR(1000) NOT NULL,
		Price INT,
		Quantity INT,
		PRIMARY KEY(productNumber)
	)";
	
	$sql2 = "CREATE TABLE Cart (
		ProductNumber INT AUTO_INCREMENT, 
		Name VARCHAR(15) NOT NULL,
		Price INT,
		Quantity INT,
		PRIMARY KEY(productNumber)
	)";
	
	$sql3 = "CREATE TABLE Customers (
		receiptNumber INT AUTO_INCREMENT,	
		firstName VARCHAR(20),
		lastName VARCHAR(20),
		PRIMARY KEY(receiptNumber)
	)";
	
	$sql4 = "CREATE TABLE Receipts (
		firstName VARCHAR(20),
		lastName VARCHAR(20),
		receiptNumber INT AUTO_INCREMENT,
		Primary KEY(receiptNumber)
	)";
		
	$sql5 = "CREATE TABLE Orders (
		receiptNumber INT AUTO_INCREMENT,
		productNumber INT,
		quantity INT, 
		FOREIGN KEY (receiptNumber) REFERENCES 
				Receipts (receiptNumber),
		FOREIGN KEY (productNumber) REFERENCES
				Products(productNumber)
		)";
		
	$poo = "DROP TABLE Orders";
	if(mysqli_query($mysql, $poo)) {
		echo "yay";
	} else {
		echo "poo";
	}
	
	if(mysqli_query($mysql, $sql5)) {  
		echo "Table created successfully";
	} else {  
		echo "Table is not created successfully ";  
	} 
	
	/*$file = fopen("K9Electronics.csv", "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT INTO Products (ProductNumber,Name,Company,Category,Description,Price,Quantity)
                   VALUES ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] ."')";
            $result = mysqli_query($mysql, $sqlInsert);
            
            if (! empty($result)) {
                echo "success";
                echo "CSV Data Imported into the Database";
            } else {
                echo "error";
                echo "Problem in Importing CSV Data";
            }
		}
	fclose($file);*/
	
?>

