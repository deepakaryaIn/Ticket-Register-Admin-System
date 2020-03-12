<?php

include 'conn.php';

$queryResult=$connect->query("SELECT * FROM register where Status=1");

$result=array();

while ($fetchData = $queryResult->fetch_assoc()) {
	$result[] = $fetchData;
	# code...
}

echo json_encode($result);

?>