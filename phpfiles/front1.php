<html>
<body>
    <?php
$servername = "localhost";
$username = "root";
$password = "rameena123";
$dbname = "test";
$name0=$_POST["location"];
$name1 = $_POST["date"];
$name2 = $_POST["time"];
$name3 = $_POST["name"];
$name4 = $_POST["phone"];
$name5 = $_POST["mail"];
$name6 = $_POST["comment"];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO people (location, date, time, Name, Phone, Mail, comment)
VALUES ('$name0', '$name1', '$name2', '$name3', '$name4', '$name5', '$name6')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
</body>
</html>