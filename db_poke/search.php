<!DOCTYPE html>
<html>
<head>
    <title>Pokémon Pokédex - Search Results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-top: 20px;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            margin-top: 20px;
        }
        .table-container {
            width: 100%;
            margin-top: 20px;
        }
        .table-container table {
            width: 80%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }
        table, th, td {
            border: 1px solid #dee2e6;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .error {
            color: red;
            text-align: center;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>Pokémon Search Results</h1>
    
    <div class="button-container">
        <?php
            session_start();
            $U_ID = $_SESSION['U_ID'];
        ?>
        <button onclick="window.location.href='display.php?U_ID=<?php echo $U_ID ?>'">返回</button>
    </div>

    <div class="table-container">
        <table>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>HP</th>
                <th>ATK</th>
                <th>DEF</th>
                <th>Region</th>
                <th>  </th>
            </tr>
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
                
                session_start();
                $U_ID = $_SESSION['U_ID'];
                // Get search query and filter
                $search_query = $_GET['search_query'];
                $search_filter = $_GET['search_filter'];

                // SQL query to get Pokémon data based on search
                $sql = "SELECT DISTINCT
                            Have.P_ID AS P_ID, 
                            Pokemon.Name AS P_Name, 
                            Pokemon.ATK AS P_ATK, 
                            Pokemon.DEF AS P_DEF,
                            Pokemon.HP AS P_HP, 
                            Region.Name AS R_Name,
                            Pokemon_Type.Type AS P_Type 
                        FROM 
                            Have
                        JOIN 
                            Pokemon ON Have.P_ID = Pokemon.P_ID
                        JOIN 
                            Pokemon_Type ON Pokemon.P_ID = Pokemon_Type.P_ID
                        JOIN 
                            Region ON Pokemon.R_ID = Region.R_ID
                        WHERE 
                            Have.B_ID = '$U_ID' AND ";

                switch ($search_filter) {
                    case 'id':
                        $sql .= "Pokemon.P_ID = '$search_query'";
                        break;
                    case 'name':
                        $sql .= "Pokemon.Name = '$search_query'";
                        break;
                    case 'type':
                        $sql .= "Pokemon_Type.Type = '$search_query'";
                        break;
                    case 'region':
                        $sql .= "Region.Name = '$search_query'";
                        break;
                    default:
                        $sql .= "1"; // Default case to prevent SQL errors, although it shouldn't happen.
                }

                $result = $conn->query($sql);  // Send SQL Query
                if ($result === FALSE) {
                    // SQL query failed
                    echo "<tr><td colspan='8' class='error'>Error executing query: " . $conn->error . "</td></tr>";
                } else {
                    if ($result->num_rows > 0) {    
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["P_ID"]. "</td>
                                    <td>" . $row["P_Name"]. "</td>
                                    <td>" . $row["P_Type"]. "</td>
                                    <td>" . $row["P_HP"]. "</td>
                                    <td>" . $row["P_ATK"]. "</td>
                                    <td>" . $row["P_DEF"]. "</td>
                                    <td>" . $row["R_Name"]. "</td>
                                    <td><a href='info.php?U_ID=" . $U_ID . "&P_ID=" . $row["P_ID"] . "'>詳細資料</a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No results found</td></tr>";
                    }
                }
                $conn->close();
            ?>
            
        </table>
    </div>

    <div class="button-container">
        <?php
            session_start();
            $U_ID = $_SESSION['U_ID'];
        ?>
        <button onclick="window.location.href='display.php?U_ID=<?php echo $U_ID?>'">返回</button>
    </div>

</body>
</html>
