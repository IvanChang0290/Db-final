<!DOCTYPE html>
<html>
<head>
    <title>Pokémon List</title>
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
        .add-button-container {
            text-align: center;
            margin: 20px 0;
        }
        .add-button-container button {
            background-color: #28a745;
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

    <h1>Pokémon List</h1>

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

    <div class="add-button-container">
        <button onclick="location.href='add.php'">新增 Pokémon</button>
    </div>

    <div class="table-container">
        <table>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>修改</th>
                <th>刪除</th>
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
                $sql = "SELECT P_ID,S_ID FROM Have WHERE B_ID = '$U_ID'";

                $result = $conn->query($sql);  

                if ($result->num_rows > 0) {    
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["P_ID"]. "</td>
                                  <td>" . $row["S_ID"]. "</td>
                                  <td><a href='update.php?id=" . $row["P_ID"] . "'>修改</a></td>
							      <td><a href='delete.php?id=" . $row["P_ID"] . "'>刪除</a></td>
                                  </tr>";
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
