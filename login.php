<?php

    include 'conn.php';

     $emailid = $_POST['emailid'];
     $password = $_POST['password'];

     $queryResult = $connect ->query("SELECT * FROM user WHERE emailid='".$emailid."' and password='".$password."'");

    $result=array();
     
    while ($fetchData=$queryResult->fetch_assoc()) {
	    $result[]=$fetchData;
}
echo json_encode($result);
?>