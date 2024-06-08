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
                
                // Get search query and filter
                $search_query = $_GET['search_query'];
                $search_filter = $_GET['search_filter'];

                // SQL query to get Pokémon data based on search
                $sql = "SELECT * FROM pokemon WHERE $search_filter LIKE '%$search_query%'";
                $result = $conn->query($sql);  // Send SQL Query

                if ($result->num_rows > 0) {    
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["P_ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Type"]. "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No results found</td></tr>";
                }
                $conn->close();
            ?>
            
        </table>
    </div>

</body>
</html>

