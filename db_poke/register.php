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

$sql = "SELECT * FROM User";  // Ensure this matches your database schema
$result = $conn->query($sql);  // Send SQL Query
if ($conn->query($sql) === FALSE) {
    // Redirect back to the original page with error message
    echo "<script>
        alert('Error: " . $sql . "<br>" . $conn->error . "');
        window.location.href = 'index.html'; // Change this to your original page
    </script>";
}


$U_ID = $result->num_rows;
$U_ID = strval($U_ID);
$U_ID = substr($U_ID, 0, 8);

// Retrieve form data
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$email = $_POST['email'];
$date_of_birth = $_POST['date_of_birth'];
$country = $_POST['country'];
$game_ID = $_POST['game_ID'];

// Insert user into database
$sql = "INSERT INTO User (U_ID,Name,Password,Email,Date_of_birth,Country,Game_ID) VALUES ('$U_ID', '$username', '$password', '$email', '$date_of_birth', '$country', '$game_ID')";

if ($conn->query($sql) === FALSE) {
    
    $message = "Error: " . $conn->error;
    $conn->close();
    echo "<script>alert('" . addslashes($message) . "');</script>";
    echo "<script>
        window.location.href = 'index.html';
    </script>";
}

$info = $_POST['game_ID'];
$sql = "INSERT INTO Backpack (B_ID , U_ID, info) VALUES ('$U_ID', '$U_ID', '$info')";
$result = $conn->query($sql);
if ($result === TRUE) {
    // Redirect back to the original page with success message
    $conn->close();
    echo "<script>
        alert('Registration successful!');
        window.location.href = 'index.html';
    </script>";
} else {
    // Redirect back to the original page with error message
    $message = "Error: " . $conn->error;
    $conn->close();

    echo "<script>alert('" . addslashes($message) . "');</script>";
    echo "<script>
        window.location.href = 'index.html';
    </script>";
}




?>
