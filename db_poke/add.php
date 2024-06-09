<!DOCTYPE html>
<html>
<head>
    <title>Add Pokémon</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .form-container {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-container input[type="text"],
        .form-container input[type="submit"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Pokémon</h2>
    <form action="add.php" method="post">
        <input type="text" name="P_ID" placeholder="ID" required>
        <input type="text" name="Skill" placeholder="Skill" required>
        <input type="submit" value="Add Pokémon">
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "123456789";
    $dbname = "db_poke";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $P_ID = $_POST['P_ID'];
    $Skill = $_POST['Skill'];

    // Retrieve Name, Type, and Region based on P_ID
    $sql = "SELECT Name, Type, Region FROM pokemon WHERE P_ID = '$P_ID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Name = $row['Name'];
        $Type = $row['Type'];
        $Region = $row['Region'];

        // Insert new record into the 'have' table
        $insert_sql = "INSERT INTO have (P_ID, Name, Type, Region, Skill) VALUES ('$P_ID', '$Name', '$Type', '$Region', '$Skill')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    } else {
        echo "No Pokémon found with ID: " . $P_ID;
    }

    $conn->close();
}
?>

</body>
</html>

