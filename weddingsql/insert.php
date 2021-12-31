<?php
// https://www.youtube.com/watch?v=qm4Eih_2p-M&t=20s&ab_channel=CodeAndCoins

$firstname = $_POST['firstname']; //Required
$lastname = $_POST['lastname']; //1st Required, Additional not required
$food = $_POST['food']; //Required
$allergies = $_POST['allergies']; //Not required
$email = $_POST['email']; //Required
$hotel = $_POST['hotel']; //Required
$comments = $_POST['comments']; //Not required
$confirm = $_POST['confirm']; //Required
$null = null;


//Make non-required empty values null
$number = count($lastname);
if ($number > 1 ){
	for ($i=1; $i < $number; $i++) { 
		if (empty($lastname[$i])){
			$lastname[$i] = null;
		if (empty($allergies[$i])){
			$allergies[$i] = null;
			}
		}
	}
}
if (empty($comments)) {
	$comments = null;
}


//Validate then connect to SQL and set up the queries
if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
	if (!empty($firstname[0]) || !empty($lastname[0]) || !empty($food) || !empty($email) || !empty($hotel)) {
	 	$host = "localhost";
	    $dbUsername = "root";
	    $dbPassword = "";
	    $dbname = "example";
	    //create connection
	    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	    if (mysqli_connect_error()) {
	     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
	    } else {
	     $SELECT = "SELECT email From rsvp Where email = ? Limit 1";
	     $INSERT = "INSERT Into rsvp (firstname, lastname, food, allergies, email, hotel, comments) values(?, ?, ?, ?, ?, ?, ?)";
	     $INSERT1 = "INSERT Into response_list (firstname, lastname, response) values(?, ?, ?)";
	     //Prepare statement
	     $stmt = $conn->prepare($SELECT);
	     $stmt->bind_param("s", $email);
	     $stmt->execute();
	     $stmt->bind_result($email);
	     $stmt->store_result();
	     // $stmt->store_result();
	     // $stmt->fetch();
	     $rnum = $stmt->num_rows;
	     if ($rnum==0) {
	      $stmt->close();
	      $stmt = $conn->prepare($INSERT);
	      $stmt->bind_param("sssssss", $firstname[0], $lastname[0], $food[0], $allergies[0], $email, $hotel, $comments);
	      $stmt->execute();
	      $stmt->close();
	      $stmt = $conn->prepare($INSERT1);
  		  $stmt->bind_param("sss", $firstname[0], $lastname[0], $confirm);
  		  $stmt->execute();
  		  $stmt->close();

	      $number2 = count($firstname);
	      if ($number2 > 1 ) {
	      	for($i=1; $i<$number2; $i++)
		      {
		      	  $stmt = $conn->prepare($INSERT);
			      $stmt->bind_param("sssssss", $firstname[$i], $lastname[$i], $food[$i], $allergies[$i], $email, $hotel, $null);
			      $stmt->execute();
			      $stmt->close();
			      $stmt = $conn->prepare($INSERT1);
       	  		  $stmt->bind_param("sss", $firstname[$i], $lastname[$i], $confirm);
          		  $stmt->execute();
		      }
		  }
	      // echo "thanks";
	      include("../phpmailer/auto-email.php");	 
	      header("Location: thankyoursvp.html");
	      
	     } else {
	        // echo "uh oh";
	      header("Location: errorrsvp.html");
	     }
	     $stmt->close();
	     $conn->close();
	    }
	} else {
	 echo "All field are required";
	 die();
	}
} else {
  	echo "You must enter in a valid email";
	die();
}


?>
