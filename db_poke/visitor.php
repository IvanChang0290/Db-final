<!DOCTYPE html>
<html>
<head>
    <title>Pokémon Pokédex - Visitor</title>
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
        .form-container {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container input[type="email"],
        .form-container input[type="date_of_birth"],
        .form-container input[type="country"],
        .form-container input[type="game_ID"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 5px;
        }
        .form-container button {
            background-color: #007bff;
            color: white;
            padding: 15px;
            margin: 10px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container .toggle-link {
            display: block;
            text-align: center;
            margin: 10px 0;
            color: #007bff;
            cursor: pointer;
        }
        .form-container .visitor-link {
            display: block;
            text-align: center;
            margin: 10px 0;
            color: #007bff;
            cursor: pointer;
            text-decoration: none;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        .form-container .toggle-link:hover,
        .form-container .visitor-link:hover {
            text-decoration: underline;
        }
        .pokemon-img {
            width: 70px;
            height: auto;
            display: block;
            margin: 20px auto;
        }
        .form-container img {
            display: block;
            margin: 0 auto 20px;
            width: 70px;
        }
        .header-images {
            text-align: center;
        }
        .header-images img {
            width: 70px;
            height: auto;
            margin: 0 10px;
        }
        .search-container {
            width: 100%;
            text-align: center;
            margin: 20px auto;
        }
        .search-container input[type="text"] {
            width: 60%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .search-container select {
            width: 20%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .search-container button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <h1>Pokémon Pokédex</h1>

    <div class="search-container">
        <h2>Search Pokémon</h2>
        <form action="visitor.php" method="get">
            <input type="text" id="search-query" name="search_query" placeholder="Search Pokémon...">
            <select id="search-filter" name="search_filter">
                <option value="id">ID</option>
                <option value="name">Name</option>
                <option value="type">Type</option>
                <option value="region">Region</option>
            </select>
            <button type="submit">Search</button>
        </form>
    </div>

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
                
                // SQL query to get Pokémon data
                $sql = "SELECT * FROM pokemon";  // Ensure this matches your database schema
                $result = $conn->query($sql);  // Send SQL Query

                if ($result->num_rows > 0) {    
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["P_ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Type"]. "</td></tr>";
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
