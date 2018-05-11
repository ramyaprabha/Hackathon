<?php
/* connect to gmail */
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'sih.atomises@gmail.com';
$password = 'sihatomises@123';
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "rameena123";
$dbname = "test";
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

// Create connection
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
/* grab emails */
$emails = imap_search($inbox,'FROM "plakhani22"');

/* if emails are returned, cycle through each... */
if($emails) {
	rsort($emails);
    $message = imap_fetchbody($inbox,$emails[0],1); //complete msg
	/*echo $message; */
	$mess = explode(",",$message); //mess has all the separate values with the column name
	//echo $mess[0]; //mess[0] has the date
	$messofmess0 = explode(":",$mess[0]);
	echo $messofmess0[1]; // Has the value of date
	$messofmess1 = explode(":",$mess[1]);
	echo $messofmess1[1]; // Has the value of time
	$messofmess2 = explode(" ",$mess[2]);
	echo $messofmess2[1]; // Has the value of lat
	echo $messofmess2[3]; // Has the value of lng
	$messofmess3 = explode(":",$mess[3]);
	echo $messofmess3[1]; // Has the value of depth
	$messofmess4 = explode(":",$mess[4]);
	echo $messofmess4[1]; // Has the value of magnitude
	$sql = "INSERT INTO liveeq(DATE,TIME,LAT,LNG,Depth,Magnitude)
	VALUES ('$messofmess0[1]','$messofmess1[1]','$messofmess2[1]','$messofmess2[3]','$messofmess3[1]','$messofmess4[1]')";
	$sql1 = "INSERT INTO messages(msgg)
	VALUES ('$message')";
	if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	if (mysqli_query($conn, $sql1)) {
    echo "Done";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
} 

/* close the connection */
imap_close($inbox);
mysqli_close($conn);
exec('python C:\xampp\htdocs\file\sendingmail2.py');
//$out= shell_exec ('python C:\xampp\htdocs\file\sendingmail2.py');
 //       echo $out;
header("location: livefinal.php");
exit;

?>