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
    </style>
</head>
<body>

    <h1>Pokémon Search Results</h1>

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
                <th>Skill</th>
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
                $U_ID = $_SESSION['U_ID'] ;
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
                            Region.Name AS R_Name 
                        FROM 
                            Have
                        JOIN 
                            Pokemon ON Have.P_ID = Pokemon.P_ID
                        JOIN 
                            Region ON Pokemon.R_ID = Region.R_ID
                        WHERE 
                            Have.B_ID = '$U_ID'";

                switch ($search_filter) {
                    case 'id':
                        $sql .= "p.P_ID LIKE '%$search_query%'";
                        break;
                    case 'name':
                        $sql .= "p.Name LIKE '%$search_query%'";
                        break;
                    case 'type':
                        $sql .= "p.Type LIKE '%$search_query%'";
                        break;
                    case 'region':
                        $sql .= "r.Name LIKE '%$search_query%'";
                        break;
                    default:
                        $sql .= "1"; // Default case to prevent SQL errors, although it shouldn't happen.
                }

                $result = $conn->query($sql);  // Send SQL Query

                if ($result->num_rows > 0) {    
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["P_ID"]. "</td>
                                <td>" . $row["PokemonName"]. "</td>
                                <td>" . $row["Type"]. "</td>
                                <td>" . $row["HP"]. "</td>
                                <td>" . $row["ATK"]. "</td>
                                <td>" . $row["DEF"]. "</td>
                                <td>" . $row["RegionName"]. "</td>
                                <td>" . $row["SkillName"]. "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No results found</td></tr>";
                }
                $conn->close();
            ?>
            
        </table>
    </div>

</body>
</html>
