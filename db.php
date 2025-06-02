<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "Use eventmanage";

if ($conn -> query($query) === true)
{
// echo "Success";
}
else
{
    die("Error");
}

?>
