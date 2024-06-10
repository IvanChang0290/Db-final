<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Info</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .info-container {
            width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: flex; /* Add this line */
            align-items: center; /* Add this line */
        }
        .info-container img {
            width: 20%;
            border-radius: 8px;
        }
        .info-container .table1 {
            border-collapse: collapse;
            width: 40%;
            margin-left: 20px;
            margin-top: 10px;
            align-items: top; /* Add this line */
        }
        .info-container .table1 th, .info-container .table1 td {
            text-align: left;
            padding: 8px;
        }
        .info-container .table1 th {
            background-color: #f2f2f2;
            width: 30%;
        }
        .info-container .table1 td {
            width: 70%;
        }
        .info-container .table2 {
            border-collapse: collapse;
            width: 40%;
            margin-left: 20px;
            margin-top: 10px;
            align-items: top; /* Add this line */
        }
        .info-container .table2 th, .info-container .table2 td {
            text-align: left;
            padding: 8px;
        }
        .info-container .table2 th {
            background-color: #f2f2f2;
            width: 30%;
        }
        .info-container .table2 td {
            width: 70%;
        }
        .back-button-container {
            text-align: center;
            margin: 20px 0;
        }
        .back-button-container button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="info-container">
    <?php
                // ******** update your personal settings ******** 
                $servername = "localhost";
                $username = "root";
                $password = "123456789";
                $dbname = "db_poke";

                // Connect to MySQL server
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                // Set up character set
                if (!$conn->set_charset("utf8")) {
                    printf("Error loading character set utf8: %s\n", $conn->error);
                    exit();
                }
                
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $ID = $_GET['ID'];
                $P_ID = $_GET['P_ID'];
                $sql = "SELECT U_ID FROM user WHERE password='$ID'";
                $result = $conn->query($sql);

                $U_ID = '';
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $U_ID = $row["U_ID"];
                }
                
                
                $img_path = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{$P_ID}.png";
                echo "<img src={$img_path}>";
                echo "<table class='table1'>";

                $sql = "SELECT DISTINCT
                            Have.P_ID AS P_ID, 
                            Pokemon.Name AS P_Name, 
                            Pokemon.ATK AS P_ATK, 
                            Pokemon.DEF AS P_DEF,
                            Pokemon.HP AS P_HP, 
                            Region.Name AS R_Name 
                        FROM 
                            Have
                        JOIN 
                            Pokemon ON Have.P_ID = Pokemon.P_ID
                        JOIN 
                            Region ON Pokemon.R_ID = Region.R_ID
                        WHERE 
                            Have.B_ID = '$U_ID'AND Have.P_ID = '$P_ID'";

                $result = $conn->query($sql);  
                $regin = '';  
                if ($result->num_rows > 0) {    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><th>P_ID</th><td>" . $row["P_ID"]. "</td></tr>";
                        echo "<tr><th>Name</th><td>" . $row["P_Name"]. "</td></tr>";
                        echo "<tr><th>ATK</th><td>" . $row["P_ATK"]. "</td></tr>";
                        echo "<tr><th>DEF</th><td>" . $row["P_DEF"]. "</td></tr>";
                        echo "<tr><th>HP</th><td>" . $row["P_HP"]. "</td></tr>";
                        $regin = $row["R_Name"];
                    }
                } else {
                    echo "<tr><td colspan='4'>0 results</td></tr>";
                }
                echo "</table>";
                echo "<table class='table2'>";

                $sql = "SELECT DISTINCT
                            Pokemon_Type.Type AS P_Type 
                        FROM 
                            Have
                        JOIN 
                            Pokemon_Type ON Have.P_ID = Pokemon_Type.P_ID
                        WHERE 
                            Have.B_ID = '$U_ID'AND Have.P_ID = '$P_ID'";
                $result = $conn->query($sql);  
                $count = 1;
                if ($result->num_rows == 1) {  
                    $row = $result->fetch_assoc();
                    echo "<tr><th>Type1</th><td>" . $row["P_Type"]. "</td></tr>";
                    echo "<tr><th>Type2</th><td>none</td></tr>";
                }

                else if ($result->num_rows > 0) {    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><th>Type{$count}</th><td>" . $row["P_Type"]. "</td></tr>";
                        $count = $count + 1;
                    }
                } else {
                    echo "<tr><td colspan='4'>0 results</td></tr>";
                }

                $sql = "SELECT DISTINCT
                            Skill.Name AS S_Name
                        FROM 
                            Skill
                        JOIN 
                            Have ON Have.S_ID = Skill.S_ID
                        WHERE 
                            Have.B_ID = '$U_ID'AND Have.P_ID = '$P_ID'";

                echo "<tr><th>Regin</th><td>" . $regin. "</td></tr>";
                $result = $conn->query($sql);  

                if ($result->num_rows > 0) {    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><th>Skill</th><td>" . $row["S_Name"]. "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>0 results</td></tr>";
                }
                echo "</table>";


                $conn->close();

            ?>
</div>

<div class="back-button-container">
        <?php 
            session_start();
            $_SESSION['U_ID'] = $_GET['U_ID'];
        ?>
        <button onclick="location.href='display.php?U_ID=<?php echo $_GET['U_ID'] ?>'">返回</button>
</div>

</body>
</html>
