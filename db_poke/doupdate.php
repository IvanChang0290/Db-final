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

<div class="all-container">
<div class="regin-container">

<?php
// doupdate.php

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "db_poke";

// Connect MySQL server
$conn = new mysqli($servername, $username, $password, $dbname);

// set up char set
if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//session_start();
$ID = $_GET['ID'];
$sql = "SELECT U_ID FROM user WHERE password='$ID'";
$result = $conn->query($sql);
$U_ID = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $U_ID = $row["U_ID"];
}
else
{
    echo "No such user";
}
$B_ID = $U_ID;
$P_ID = $_POST["P_ID"];
$skill1 = $_POST['skill1'];
$skill2 = $_POST['skill2'];
$skill3 = $_POST['skill3'];
$Ori_skill1 = $_POST['origin_skill1'];
$Ori_skill2 = $_POST['origin_skill2'];
$Ori_skill3 = $_POST['origin_skill3'];

// Update skills
if(isset($_POST["P_ID"]) && isset($_POST["skill1"]) && isset($_POST["origin_skill1"]) )
{
    if($Ori_skill1 != $skill1)
    {
        $update_sql = "UPDATE have SET S_ID='$skill1' WHERE B_ID='$B_ID' AND P_ID='$P_ID' AND S_ID='$Ori_skill1'";
        $conn->query($update_sql);
        echo $conn->error;
        echo "<h1>技能1更新成功</h1>";
    }
    
}
else
{
    echo "<h1>資料不完全</h1>";
}

if(isset($_POST["P_ID"]) && isset($_POST["skill2"]) && isset($_POST["origin_skill2"]))
{
    if($Ori_skill2 != $skill2)
    {
        $update_sql = "UPDATE have SET S_ID='$skill2' WHERE B_ID='$B_ID' AND P_ID='$P_ID' AND S_ID='$Ori_skill2'";
        $conn->query($update_sql);
        echo $conn->error;
        echo "<h1>技能2更新成功</h1>";
    }
    
}
else
{
    echo "<h1>資料不完全</h1>";
}

if(isset($_POST["P_ID"]) && isset($_POST["skill3"]) && isset($_POST["origin_skill3"]))
{
    if($Ori_skill3 != $skill3)
    {
        $update_sql = "UPDATE have SET S_ID='$skill3' WHERE B_ID='$B_ID' AND P_ID='$P_ID' AND S_ID='$Ori_skill3'";
        $conn->query($update_sql);
        echo $conn->error;
        echo "<h1>技能3更新成功</h1>";
    }
    
}
else
{
    echo "<h1>資料不完全</h1>";
}

?>
</div>
</div>

<div class="back-button-container">
    <button onclick="location.href='display.php?ID=<?php echo $ID ?>'">返回</button>
</div>
