<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $patientId = $_POST["patient_id"];
    $nic = $_POST["nic"];
    $fullName = $_POST["full_name"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $bloodGroup = $_POST["blood_group"];
    $address = $_POST["address"];
    $phoneNumber = $_POST["phone_number"];
    $nationality = $_POST["nationality"];
    $maritalStatus = $_POST["marital_status"];
    $occupation = $_POST["occupation"];
    $dateAdmitted = $_POST["date_admitted"];
    $email = $_POST["email"];
      
    // Perform necessary validations and database operations here
    $conn = new mysqli('localhost', 'root', '', 'hospital_system');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO patients (patient_id, nic, full_name, dob, gender, blood_group, address, phone_number, nationality, marital_status, occupation, date_admitted, email)
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssss", $patientId, $nic, $fullName, $dob, $gender, $bloodGroup, $address, $phoneNumber, $nationality, $maritalStatus, $occupation, $dateAdmitted, $email);

        if ($stmt->execute()) {
            // Redirect back to the homepage after adding the patient
            header("Location: home.html?alert=true");
          exit;
        } else {
            echo "Error: " . $stmt->error;
        }
		

        $stmt->close();
    }

    $conn->close();
}
?>
