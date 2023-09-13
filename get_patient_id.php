<?php
// Assuming you are using MySQL as the database
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the next patient ID from the database
$sql = "SELECT MAX(patient_id) + 1 AS next_patient_id FROM patients";
$result = $conn->query($sql);

if (!$result) {
    // Output the error message
    die("Query execution failed: " . $conn->error);
}

$row = $result->fetch_assoc();
$nextPatientId = $row["next_patient_id"];

// Close the database connection
$conn->close();

// Return the next patient ID as a JSON response
$response = array("next_patient_id" => $nextPatientId);
echo json_encode($response);
?>
