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
        .all-container {
            width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            /* display: flex;  */
            /* align-items: center;  */
        }
        .all-container .info-container {
            display: flex; /* Add this line */
            align-items: center; /* Add this line */

        }
        .info-container .img1 {
            width: 20%;
            border-radius: 8px;
        }
        .info-container .img2 {
            width: 50%;
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
        
        .all-container .regin-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .regin-container .img1 {
            width: 20%;
            border-radius: 8px;
        }
        .regin-container .img2 {
            width: 60%;
            border-radius: 8px;
        }
        .regin-container .table1 {
            border-collapse: collapse;
            width: 40%;
            margin-left: 20px;
            margin-top: 10px;
            align-items: top; 
        }
        .regin-container .table1 th, .regin-container .table1 td {
            text-align: left;
            padding: 8px;
        }
        .regin-container .table1 th {
            width: 30%;
        }
        .regin-container .table1 td {
            width: 70%;
        }
        .regin-container .table2 {
            border-collapse: collapse;
            width: 40%;
            margin-left: 20px;
            margin-top: 10px;
            align-items: top; /* Add this line */
        }
        .regin-container .table2 th, .regin-container .table2 td {
            text-align: left;
            padding: 8px;
        }
        .regin-container .table2 th {
            background-color: #f2f2f2;
            width: 30%;
        }
        .regin-container .table2 td {
            width: 70%;
        }
        .regin-container h1 {
            font-size: 27px;
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
        .pokemon-button {
            background-color: #ffffff;
            color: black;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            align-items: center;
        }
        .pokemon-button .img3 {
            width: 100%;
        }
    </style>
</head>
<body>

<div>
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
    echo "<div class='all-container'>";
        echo "<div class='info-container'>";
                echo "<table class='table1'>";

                    $sql = "SELECT DISTINCT
                                User.Name AS U_Name, 
                                User.Email AS U_Email, 
                                User.Country AS U_Country, 
                                User.Game_ID AS U_Game_ID            
                            FROM 
                                User
                            WHERE 
                                User.U_ID = '$U_ID'";

                    $result = $conn->query($sql);  
                    if ($result->num_rows > 0) {    
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><th>Name</th><td>" . $row["U_Name"]. "</td></tr>";
                            echo "<tr><th>Email</th><td>" . $row["U_Email"]. "</td></tr>";
                            echo "<tr><th>Country</th><td>" . $row["U_Country"]. "</td></tr>";
                            echo "<tr><th>Game_ID</th><td>" . $row["U_Game_ID"]. "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 results</td></tr>";
                    }
            echo "</table>";
        echo "</div>";
    echo "</div>";
?>
<div>

<div class="back-button-container">
        <?php 
            session_start();
            $_SESSION['ID'] = $_GET['ID'];
        ?>
        <button onclick="location.href='display.php?ID=<?php echo $_GET['ID'] ?>'">返回</button>
</div>

</body>
</html>
