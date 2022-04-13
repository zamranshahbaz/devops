<?php
// MySQL Insert and Retrieve
echo "Hello there, this is a PHP Apache container";

$host = 'db';
$user = 'MYSQL_USER';
$pass = 'MYSQL_PASSWORD';
$mydatabase = 'MYSQL_DATABASE';


// MySQL Connection 
$conn = new mysqli($host, $user, $pass, $mydatabase);

if ($conn->connect_errno) {
    die("Connect Error: " . $conn->connect_error);
}
else{
  echo "<br><br>";
  echo "\nConnected with MYSQL"; 
  echo "<br>";
	$sql = "create table users (id int(6), username VARCHAR(30) ,password VARCHAR(30))";
	if ($conn->query($sql) === TRUE) {
		echo "Table users created successfully";
		echo "<br>";
	}

	$sql = "insert into users (username, password) values ('1','Zamran')";
	
	if ($conn->query($sql) === TRUE) {
		echo "Data inserted successfully";
		echo "<br>";
	}
	$sql = 'SELECT * FROM users';
	
	if ($result = $conn->query($sql)) {
		while ($data = $result->fetch_object()) {
			$users[] = $data;
		}
	}
	
	foreach ($users as $user) {
		echo "<br>";
		echo $user->username . " " . $user->password;
		echo "<br>";
	}
}



echo "<br>";
// Mongo Connection
// Bulk Insert and retrieve 

try {
	
	$manager =  new MongoDB\Driver\Manager("mongodb://root:password@mongo:27017");
	echo "Connection to database successfully";
	


	 $bulk = new MongoDB\Driver\BulkWrite;
	 $bulk->insert(['x' => 1]);
	 $bulk->insert(['x' => 2]);
	 $bulk->insert(['x' => 3]);
	 $manager->executeBulkWrite('db.collection', $bulk);
	 
	 $filter = ['x' => ['$gt' => 1]];
	 $options = [
			 'projection' => ['_id' => 0],
			 'sort' => ['x' => -1],
	 ];
	 
	 $query = new MongoDB\Driver\Query($filter, $options);
	 $cursor = $manager->executeQuery('db.collection', $query);
	 
	 foreach ($cursor as $document) {
			 var_dump($document);
	 }

	 


}
catch (Throwable $e) {

	echo "Captured Throwable for connection : " . $e->getMessage() . PHP_EOL;
}


























?>