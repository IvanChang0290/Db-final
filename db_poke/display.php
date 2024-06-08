<!DOCTYPE html>
<html>
<head>
    <title>Pokémon List</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Pokémon List</h1>
    <div class="container">
        <table>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
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

                $U_ID = $_GET['U_ID'];
                echo $U_ID; // Output: some_value

                // SQL query to get Pokémon data
                $sql = "SELECT * FROM pokemon";  // Ensure this matches your database schema
                $result = $conn->query($sql);  // Send SQL Query

                if ($result->num_rows > 0) {    
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["P_ID"]. "</td>
                                  <td>" . $row["Name"]. "</td>
                                  <td>" . $row["Type"]. "</td>
                                  <td><a href='update.php?id=" . $row["ISBN"] . "'>修改</a></td>
							      <td><a href='delete.php?id=" . $row["ISBN"] . "'>刪除</a></td>
                                  </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>0 results</td></tr>";
                }
                $conn->close();
            ?>
            
        </table>
    </div>
    
</body>
</html>
