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

// Update skills
$update_sql = "UPDATE have SET S_ID='$skill1' WHERE B_ID='$B_ID' AND P_ID='$P_ID' AND S_ID IN (SELECT S_ID FROM (SELECT S_ID FROM have WHERE B_ID='$B_ID' AND P_ID='$P_ID' LIMIT 1) AS temp)";
$conn->query($update_sql);

$update_sql = "UPDATE have SET S_ID='$skill2' WHERE B_ID='$B_ID' AND P_ID='$P_ID' AND S_ID IN (SELECT S_ID FROM (SELECT S_ID FROM have WHERE B_ID='$B_ID' AND P_ID='$P_ID' LIMIT 1, 1) AS temp)";
$conn->query($update_sql);

$update_sql = "UPDATE have SET S_ID='$skill3' WHERE B_ID='$B_ID' AND P_ID='$P_ID' AND S_ID IN (SELECT S_ID FROM (SELECT S_ID FROM have WHERE B_ID='$B_ID' AND P_ID='$P_ID' LIMIT 2, 1) AS temp)";
$conn->query($update_sql);

echo "技能更新成功";

$conn->close();
?>
