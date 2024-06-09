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
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .info-container img {
            max-width: 150px;
            border-radius: 8px;
        }
        .info-container table {
            border-collapse: collapse;
            width: 100%;
            margin-left: 20px;
        }
        .info-container th, .info-container td {
            text-align: left;
            padding: 8px;
        }
        .info-container th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="info-container">
    <table>
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

                $U_ID = $_GET['U_ID'];
                $P_ID = $_GET['P_ID'];
                $img_path = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{$P_ID}.png";
                echo "<img src={$img_path}>";
            
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

                if ($result->num_rows > 0) {    
                    while($row = $result->fetch_assoc()) {

                        echo "<tr><th>Name</th><td>" . $row["P_ID"]. "</td></tr>";
                        echo "<tr><th>Name</th><td>" . $row["P_Name"]. "</td></tr>";
                        echo "<tr><th>Name</th><td>" . $row["P_ATK"]. "</td></tr>";
                        echo "<tr><th>Name</th><td>" . $row["P_DEF"]. "</td></tr>";
                        echo "<tr><th>Name</th><td>" . $row["P_HP"]. "</td></tr>";
                        echo "<tr><th>Name</th><td>" . $row["R_Name"]. "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>0 results</td></tr>";
                }
                $conn->close();
            ?>
    </table>
</div>

</body>
</html>
