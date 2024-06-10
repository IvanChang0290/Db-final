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
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .back-button-container {
            text-align: center;
            margin-top: 20px;
        }
        .back-button-container button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        .back-button-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Pokémon Skills</h2>
    <form action="add.php" method="post">
        <input type="text" name="P_ID" placeholder="Pokémon ID" required>
        <input type="text" name="Skill_1" placeholder="Skill 1" required>
        <input type="text" name="Skill_2" placeholder="Skill 2">
        <input type="text" name="Skill_3" placeholder="Skill 3">
        <input type="submit" value="Add Skills">
    </form>
</div>

<div class="back-button-container">
    <?php 
        session_start();
        $_SESSION['U_ID'] = $_GET['U_ID'];
    ?>
    <button onclick="location.href='display.php?U_ID=<?php echo $_GET['U_ID'] ?>'">返回</button>
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
    session_start();
    $U_ID = $_SESSION['U_ID'];
    $P_ID = $_POST['P_ID'];
    $Skill_1 = $_POST['Skill_1'];
    $Skill_2 = $_POST['Skill_2'];
    $Skill_3 = $_POST['Skill_3'];

    $check_pokemon_sql = "SELECT P_ID FROM pokemon WHERE P_ID = '$P_ID'";
    $check_result = $conn->query($check_pokemon_sql);
    if ($check_result->num_rows == 0) {
        echo "This Pokémon ID does not exist. Please enter a valid Pokémon ID.";
    }

    $check_skills_sql = "SELECT COUNT(*) as skill_count FROM have WHERE P_ID = '$P_ID' and B_ID = '$U_ID'";
    $check_result = $conn->query($check_skills_sql);
    $skill_count_row = $check_result->fetch_assoc();
    $skill_count = $skill_count_row['skill_count'];

    if ($skill_count >= 3) {
        echo "This Pokémon already has 3 skills. You cannot add more.";
    } else {
        $fail = 0;
        if ($skill_count == 2) {
            if(!empty($Skill_1)){
                $insert_sql = "INSERT INTO have (B_ID, P_ID, S_ID) VALUES ('$U_ID', '$P_ID', '$Skill_1')";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "Skills added successfully.";
                } else {
                    echo "Error: " . $insert_sql . "<br>" . $conn->error;
                    $fail = 1;
                }
            }
        } elseif ($skill_count == 1) {
            if(!empty($Skill_1)){
                $insert_sql = "INSERT INTO have (B_ID, P_ID, S_ID) VALUES ('$U_ID', '$P_ID', '$Skill_1')";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "Skills added successfully.";
                } else {
                    echo "Error: " . $insert_sql . "<br>" . $conn->error;
                    $fail = 1;
                }
            }
            if(!empty($Skill_2)){
                $insert_sql = "INSERT INTO have (B_ID, P_ID, S_ID) VALUES ('$U_ID', '$P_ID', '$Skill_2')";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "Skills added successfully.";
                } else {
                    echo "Error: " . $insert_sql . "<br>" . $conn->error;
                    $fail = 1;
                }
            }
        } elseif ($skill_count == 0) {
            if(!empty($Skill_1)){
                $insert_sql = "INSERT INTO have (B_ID, P_ID, S_ID) VALUES ('$U_ID', '$P_ID', '$Skill_1')";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "Skills added successfully.";
                } else {
                    echo "Error: " . $insert_sql . "<br>" . $conn->error;
                    $fail = 1;
                }
            }
            if(!empty($Skill_2)){
                $insert_sql = "INSERT INTO have (B_ID, P_ID, S_ID) VALUES ('$U_ID', '$P_ID', '$Skill_2')";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "Skills added successfully.";
                } else {
                    echo "Error: " . $insert_sql . "<br>" . $conn->error;
                    $fail = 1;
                }
            }
            if(!empty($Skill_3)){
                $insert_sql = "INSERT INTO have (B_ID, P_ID, S_ID) VALUES ('$U_ID', '$P_ID', '$Skill_3')";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "Skills added successfully.";
                } else {
                    echo "Error: " . $insert_sql . "<br>" . $conn->error;
                    $fail = 1;
                }
            }
        }
        
        if($fail == 0)
        {
            header('Location: display.php?U_ID='.$U_ID);
            exit;
        }
    }

    $conn->close();
}
?>
</body>
</html>
