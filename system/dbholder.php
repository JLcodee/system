<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zsnhs_portal";

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

 
    $firstname = mysqli_real_escape_string($conn, trim($_POST['firstname']));
    $midin = mysqli_real_escape_string($conn, trim($_POST['midin']));
    $lastname = mysqli_real_escape_string($conn, trim($_POST['lastname']));
    $age = mysqli_real_escape_string($conn, trim($_POST['age']));
    $sex = mysqli_real_escape_string($conn, trim($_POST['sex']));
    $gradelevel = mysqli_real_escape_string($conn, trim($_POST['gradelevel']));
    $section = mysqli_real_escape_string($conn, trim($_POST['section']));
    $LRN = mysqli_real_escape_string($conn, trim($_POST['LRN']));

}
    // Prepare and bind
    $stmt = $conn->prepare("
        INSERT INTO sign_up (firstname, midin, lastname, age, sex, gradelevel, section, LRN)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt === false) {
        die("Preparation failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssssssss", $firstname, $midin, $lastname, $age, $sex, $gradelevel, $section, $LRN);

    // Execute query
    if ($stmt->execute()) {
        echo "Query successful";
    } else {
        echo "Query failed: " . htmlspecialchars($stmt->error);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

?>
