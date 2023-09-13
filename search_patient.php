<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <!-- Add any necessary CSS styles here -->
    <title>Search Results - Hospital System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body>
    <div class="container">
        <h1>Search Results</h1>

        <div id="record-viewer">
            <!-- The search results will be dynamically added here by JavaScript -->
       
        <a href="home.html">Go Back</a><br>
		<br>
    </div>
</head>
<body>
    <h1>Search Results</h1>

    <?php
    // Place your PHP code here
    // ...

    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if search query is set
    if (isset($_GET['search_query'])) {
        $searchQuery = $_GET['search_query'];

        // Prepare SQL query to search for patients
        $sql = "SELECT * FROM patients WHERE full_name LIKE '%$searchQuery%' OR nic LIKE '%$searchQuery%'";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display the search results
            while ($row = $result->fetch_assoc()) {
                // Start the session
                session_start();

                echo "<div class='patient-record'>";
                echo "<br>";
                echo "<h3>Patient ID: " . $row['patient_id'] . "</h3>";
                echo "<br>";
                echo "<p>NIC: " . $row['nic'] . "</p>";
                echo "<br>";
                echo "<p>Full Name: " . $row['full_name'] . "</p>";
                echo "<br>";
                echo "<p>Date of Birth: " . $row['dob'] . "</p>";
                echo "<br>";
                echo "<p>Gender: " . $row['gender'] . "</p>";
                echo "<br>";
                echo "<p>Blood Group: " . $row['blood_group'] . "</p>";
                echo "<br>";
                echo "<p>Address: " . $row['address'] . "</p>";
                echo "<br>";
                echo "<p>Phone Number: " . $row['phone_number'] . "</p>";
                echo "<br>";
                echo "<p>Nationality: " . $row['nationality'] . "</p>";
                echo "<br>";
                echo "<p>Marital Status: " . $row['marital_status'] . "</p>";
                echo "<br>";
                echo "<p>Occupation: " . $row['occupation'] . "</p>";
                echo "<br>";
                echo "<p>Date Admitted: " . $row['date_admitted'] . "</p>";
                echo "<br>";
                echo "<p>Email: " . $row['email'] . "</p>";
                echo "<br>";
                echo "<a href='update.php?id=" . $row['patient_id'] . "'>Update Record</a>"; // Add Update Record link/button
				echo "<a href='delete.php?id=" . $row['patient_id'] . "'>Delete Record</a>"; // Add Delete Record link/button
                echo "<br>";
                echo "<br>";
                echo "</div>";
            }
        } else {
            echo "No results found.";
        }
    }

    // Close the database connection
    $conn->close();
    ?>

</body>
</html>
