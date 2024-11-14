<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pothan";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $phoneno = htmlspecialchars($_POST['phoneno']);
    $email = htmlspecialchars($_POST['email']);
    $mark = htmlspecialchars($_POST['mark']);
    $address = htmlspecialchars($_POST['address']);

    // Prepare SQL statement
    $sql = "INSERT INTO user (Name, PhoneNo, Email, Landmark, Address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $phoneno, $email, $mark, $address);

    // Execute statement and handle response
    if ($stmt->execute()) {
        // Store user data in session
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['user_name'] = $name;

        // Redirect to home page with success message
        echo "<script>alert('Registration Successful!'); 
              window.location.href='home.php';</script>";
    } else {
        // Redirect back to signup page with failure message
        echo "<script>alert('Registration Failed. Try again.'); 
              window.location.href='signup.html';</script>";
    }

    // Close resources
    $stmt->close();
    $conn->close();
}
?>
