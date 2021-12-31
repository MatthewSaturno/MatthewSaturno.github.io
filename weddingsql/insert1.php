<?php

$confirm = $_POST['confirm'];
$firstname = $_POST['firstname'][0];
$lastname = $_POST['lastname'][0];

if (!empty($firstname) || !empty($lastname) || !empty($confirm)) {
	$host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "example";
    
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
    	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
    	$INSERT = "INSERT Into response_list (firstname, lastname, response) values(?, ?, ?)";
     	//Prepare statement
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sss", $firstname, $lastname, $confirm);
        $stmt->execute();
        $stmt->close();
        header("Location: thankyoursvp.html");

	}
} else {
	echo "All field are required";
	die();
}	
?>