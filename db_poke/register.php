<?php
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "db_poke";

// Connect MySQL server
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$user = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Insert user into database
$sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

if ($conn->query($sql) === TRUE) {
    // Redirect back to the original page with success message
    echo "<script>
        alert('Registration successful!');
        window.location.href = 'index.html'; // Change this to your original page
    </script>";
} else {
    // Redirect back to the original page with error message
    echo "<script>
        alert('Error: " . $sql . "<br>" . $conn->error . "');
        window.location.href = 'index.html'; // Change this to your original page
    </script>";
}

$conn->close();
?>
