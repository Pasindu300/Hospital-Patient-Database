<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if patient ID is set
if (isset($_GET['id'])) {
    $patientId = $_GET['id'];

    // Prepare SQL query to delete the patient record
    $sql = "DELETE FROM patients WHERE patient_id = $patientId";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header("Location: home.html?alert=error");
          exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
