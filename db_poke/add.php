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
        .form-container input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            width: 90%;
            padding: 10px;
            margin: 0 auto;
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
    <h2>Add Pokémon Skills</h2>
    <form action="add.php" method="post">
        <input type="text" name="P_ID" placeholder="Pokémon ID" required>
        <input type="text" name="Skill_1" placeholder="Skill 1" required>
        <input type="text" name="Skill_2" placeholder="Skill 2" >
        <input type="text" name="Skill_3" placeholder="Skill 3" >
        <input type="submit" value="Add Skills">
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
    $B_ID = $_GET['U_ID'];
    $P_ID = $_POST['P_ID'];
    $Skill_1 = $_POST['Skill_1'];
    $Skill_2 = $_POST['Skill_2'];
    $Skill_3 = $_POST['Skill_3'];


    $check_pokemon_sql = "SELECT P_ID FROM pokemon WHERE P_ID = '$P_ID'";
    $check_result = $conn->query($check_pokemon_sql);
    if ($check_result->num_rows == 0) {
    echo "This Pokémon ID does not exist. Please enter a valid Pokémon ID.";
    }

    // Check the number of skills the Pokémon already has
    $check_skills_sql = "SELECT COUNT(*) as skill_count FROM have WHERE P_ID = '$P_ID' and B_ID = '$B_ID'";
    $check_result = $conn->query($check_skills_sql);
    $skill_count_row = $check_result->fetch_assoc();
    $skill_count = $skill_count_row['skill_count'];

    if ($skill_count >= 3) {
        echo "This Pokémon already has 3 skills. You cannot add more.";
    } else {
            // Insert new record into the 'have' table
            if ($skill_count == 2) {
                if(!empty($Skill_1)){
                    $insert_sql =" INSERT INTO have (B_ID,P_ID,S_ID) VALUES ('$B_ID','$P_ID','$Skill_1')";
                }
            } elseif ($skill_count == 1) {
                if(!empty($Skill_1)){
                    $insert_sql =" INSERT INTO have (B_ID,P_ID,S_ID) VALUES ('$B_ID','$P_ID','$Skill_1')";
                }
                if(!empty($Skill_2)){
                    $insert_sql =" INSERT INTO have (B_ID,P_ID,S_ID) VALUES ('$B_ID','$P_ID','$Skill_2')";
                }
            } elseif ($skill_count == 0) {
                if(!empty($Skill_1)){
                    $insert_sql =" INSERT INTO have (B_ID,P_ID,S_ID) VALUES ('$B_ID','$P_ID','$Skill_1')";
                }
                if(!empty($Skill_2)){
                    $insert_sql =" INSERT INTO have (B_ID,P_ID,S_ID) VALUES ('$B_ID','$P_ID','$Skill_2')";
                }
                if(!empty($Skill_3)){
                    $insert_sql =" INSERT INTO have (B_ID,P_ID,S_ID) VALUES ('$B_ID','$P_ID','$Skill_3')";
                }
            }

            if ($conn->query($insert_sql) === TRUE) {
                echo "Skills added successfully.";
            } else {
                echo "Error: " . $insert_sql . "<br>" . $conn->error;
            }
        }

    $conn->close();
}
?>

</body>
</html>
