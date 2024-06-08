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

if (isset($_POST['visitor'])) {
    header("Location: visitor.php");
    exit;
}

// Retrieve form data
$user = $_POST['username'];
$pass = $_POST['password'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
//echo "$user";
//echo "$pass";
echo $password;
// Query to check user credentials
$sql = "SELECT password FROM user WHERE name='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $passHash = $row["Password"];
    echo $passHash;
    if (password_verify($pass, $row["Password"])) {
        echo "Login successful";
    } else {
        echo "Invalid password";
    }
} else {
    echo "No user found";
}

$conn->close();
?>
