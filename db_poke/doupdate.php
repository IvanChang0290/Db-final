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
$B_ID = $_POST['B_ID'];
	$P_ID = $_POST['P_ID'];
	$S_ID = $_POST['S_ID'];
if (isset($_POST['B_ID']) && isset($_POST['P_ID']) && isset($_POST['S_ID'])) {

	session_start();
	$update_sql = "UPDATE have SET S_ID='$S_ID' where B_ID='$B_ID' and P_ID='$P_ID'";	// TODO 
	echo $update_sql;
	if ($conn->query($update_sql) === TRUE) {
		// 重定向用戶到下一頁
		header('Location: display.php');
		exit;

	} else {
		echo "<h2 align='center'><font color='antiquewith'>修改失敗!!</font></h2>";
	}

}else{
	echo "資料不完全";
}
				
?>