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
        .logout-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .logout-container button {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        /* .logout-container button:hover {
            background-color: #c82333;
        } */
        .user-container {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .user-container button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        /* .user-container button:hover {
            background-color: #0066cc;
        } */
    </style>
</head>
<body>

    <div class="logout-container">
        <form action="logout.php" method="post">
            <button type="submit">登出</button>
        </form>
    </div>

    <div class="user-container">
            <button onclick="location.href='U_info.php?ID=<?php echo $_GET['ID'] ?>'">User</button>
    </div>

    <h1>Pokémon List</h1>

    <div class="search-container">
        <h2>Search Pokémon</h2>
        <?php 
            session_start();
            $_SESSION['ID'] = $_GET['ID'];
        ?>
        <form action="search.php" method="get">
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
        <?php 
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
            $sql = "SELECT U_ID FROM user WHERE password='$ID'";
            $result = $conn->query($sql);

            $U_ID = '';
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $U_ID = $row["U_ID"];
            }
            session_start();
            $_SESSION['U_ID'] = $U_ID;
        ?>
        <button onclick="location.href='add.php?ID=<?php echo $_GET['ID'] ?>'">新增 Pokémon</button>
    </div>

    <div class="table-container">
        <table>
            <tr>
                <th>P_ID</th>
                <th>Name</th>
                <th>atk</th>
                <th>def</th>                
                <th>hp</th>
                <th>region</th>
                <th>  </th>
                <th>  </th>
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

                $ID = $_GET['ID'];
                $sql = "SELECT U_ID FROM user WHERE password='$ID'";
                $result = $conn->query($sql);

                $U_ID = '';
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $U_ID = $row["U_ID"];
                }

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

                $result = $conn->query($sql);  

                if ($result->num_rows > 0) {    
                    while($row = $result->fetch_assoc()) {

                        echo "<tr><td>" . $row["P_ID"]. "</td>
                                  <td>" . $row["P_Name"]. "</td>
                                  <td>" . $row["P_ATK"]. "</td>
                                  <td>" . $row["P_DEF"]. "</td>
                                  <td>" . $row["P_HP"]. "</td>
                                  <td>" . $row["R_Name"]. "</td>
                                  <td><a href='info.php?ID=" . $ID . "&P_ID=" . $row["P_ID"] . "'>詳細資料</a></td>
                                  <td><a href='delete.php?ID=" . $ID . "&P_ID=" . $row["P_ID"] . "'>刪除</a></td>
                                  <td><a href='update.php?ID=" . $ID . "&P_ID=" . $row["P_ID"] . "'>修改</a></td>
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
