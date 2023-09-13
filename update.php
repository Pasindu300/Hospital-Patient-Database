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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated values from the form
    $patientId = $_POST['patient_id'];
    $fullName = $_POST['full_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $bloodGroup = $_POST['blood_group'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phone_number'];
    $nationality = $_POST['nationality'];
    $maritalStatus = $_POST['marital_status'];
    $occupation = $_POST['occupation'];
    $dateAdmitted = $_POST['date_admitted'];
    $email = $_POST['email'];

    // Prepare SQL statement to update the record
    $sql = "UPDATE patients SET full_name='$fullName', dob='$dob', gender='$gender', blood_group='$bloodGroup', 
            address='$address', phone_number='$phoneNumber', nationality='$nationality', marital_status='$maritalStatus', 
            occupation='$occupation', date_admitted='$dateAdmitted', email='$email' WHERE patient_id='$patientId'";

    if ($conn->query($sql) === TRUE) {
         header("Location: home.html?alert=success");
          exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Check if the patient ID is set in the URL parameter
    if (isset($_GET['id'])) {
        $patientId = $_GET['id'];

        // Retrieve the existing record from the database
        $sql = "SELECT * FROM patients WHERE patient_id='$patientId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Update Record</title>
                <!-- Add any necessary CSS styles here -->
                <link rel="stylesheet" type="text/css" href="style.css">
            </head>
            <body>
                <div class="container">
                    <h1>Update Record</h1>

                    <form method="post" action="update.php">
                        <input type="hidden" name="patient_id" value="<?php echo $row['patient_id']; ?>">

                        <label for="full_name">Full Name:</label>
                        <input type="text" name="full_name" id="full_name" value="<?php echo $row['full_name']; ?>">

                        <label for="dob">Date of Birth:</label>
                        <input type="date" name="dob" id="dob" value="<?php echo $row['dob']; ?>">

                        <label for="gender">Gender:</label>
                        <input type="text" name="gender" id="gender" value="<?php echo $row['gender']; ?>">

                        <label for="blood_group">Blood Group:</label>
                        <input type="text" name="blood_group" id="blood_group" value="<?php echo $row['blood_group']; ?>">

                        <label for="address">Address:</label>
                        <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>">

                        <label for="phone_number">Phone Number:</label>
                        <input type="text" name="phone_number" id="phone_number" value="<?php echo $row['phone_number']; ?>">

                        <label for="nationality">Nationality:</label>
                        <input type="text" name="nationality" id="nationality" value="<?php echo $row['nationality']; ?>">

                        <label for="marital_status">Marital Status:</label>
                        <input type="text" name="marital_status" id="marital_status" value="<?php echo $row['marital_status']; ?>">

                        <label for="occupation">Occupation:</label>
                        <input type="text" name="occupation" id="occupation" value="<?php echo $row['occupation']; ?>">

                        <label for="date_admitted">Date Admitted:</label>
                        <input type="date" name="date_admitted" id="date_admitted" value="<?php echo $row['date_admitted']; ?>">

                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>">

                        <input type="submit" value="Update">
                    </form>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "No record found.";
        }
    } else {
        echo "Invalid patient ID.";
		
    }
	 
}

// Close the database connection
$conn->close();
?>
