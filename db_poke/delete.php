<?php

// ******** update your personal settings ******** 
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "db_poke";

// Connecting to and selecting a MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$P_ID = $_GET["P_ID"];

session_start();
$U_ID = $_SESSION['U_ID'];
$sql = "SELECT password FROM user WHERE U_ID='$U_ID'";
$result = $conn->query($sql);
$ID = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ID = $row["password"];
}
else
{
    echo "No such user";
}

if (isset($P_ID) && isset($U_ID)) {
    $delete_sql = "DELETE FROM have WHERE P_ID = '$P_ID' and B_ID = '$U_ID';"; // TODO 

	if ($conn->query($delete_sql) === TRUE) {
        // echo "刪除成功!<a href='main.php'>返回主頁</a>";
        // 重定向用戶到下一頁
		header('Location: display.php?ID='.$ID);
		exit;
    }else{
        echo "刪除失敗!";
	}

}else{
	echo "資料不完全";
}
				
?>