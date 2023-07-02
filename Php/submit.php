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

// Retrieve form data
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];
$healthReport = $_FILES['healthReport'];

// File upload directory
$uploadDir = 'uploads/';

// Generate a unique name for the uploaded file
$fileName = uniqid() . '_' . $healthReport['name'];
$targetPath = $uploadDir . $fileName;

// Move the uploaded file to the desired location
if (move_uploaded_file($healthReport['tmp_name'], $targetPath)) {
  // Insert user details into the database
  $sql = "INSERT INTO users (name, age, weight, email, health_report) VALUES ('$name', '$age', '$weight', '$email', '$fileName')";
  
  if ($conn->query($sql) === TRUE) {
    echo "User details and health report inserted successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
} else {
  echo "Error uploading the health report.";
}

// Close the database connection
$conn->close();
?>
