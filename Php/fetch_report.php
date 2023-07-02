<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve email from GET parameters
$email = $_GET['email'];

// Fetch user's health report
$sql = "SELECT health_report FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $fileName = $row['health_report'];
  $filePath = 'uploads/' . $fileName;

  // Output the file for download
  if (file_exists($filePath)) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    readfile($filePath);
  } else {
    echo "Health report not found.";
  }
} else {
  echo "User not found.";
}

// Close the database connection
$conn->close();
?>
