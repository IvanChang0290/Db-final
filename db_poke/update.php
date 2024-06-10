<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改寶可夢技能</title>
</head>

<body>
<h1 align="center">修改寶可夢技能</h1>
	<form action="doupdate.php" method="post">	
	  <table width="500" border="1" bgcolor="#cccccc" align="center">
		
		<?php

			// ******** update your personal settings ******** 
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

			$B_ID = $_GET['U_ID'];
			$P_ID= $_GET['P_ID'];

			 
			session_start();
			$_SESSION["old_isbn"]=$ISBN;


			if (isset($B_ID) && isset($P_ID)) {
				
				$select_sql = "select * from have where B_ID='$B_ID' and P_ID='$P_ID'"; // TODO 
				$result = $conn->query($select_sql);

				if ($result->num_rows > 0) {
					$row = mysqli_fetch_array ( $result, MYSQLI_ASSOC );
					
					echo "<tr>
						<th>B_ID</th>
						<td bgcolor='#FFFFFF'><input type='text' name='B_ID' value=" . $row['B_ID'] . " readonly></td>
						</tr>";
					
					echo "<tr>
						<th>P_ID</th>
						<td bgcolor='#FFFFFF'><input type='text' name='P_ID' value=" . $row['P_ID'] . " readonly></td>
						</tr>";
					echo "<tr>
						<th>Skill</th>
						<td bgcolor='#FFFFFF'><input type='text' name='S_ID' value=" . $row['S_ID'] . " /></td>
						</tr>";
					
					echo "<th colspan='2'><input type='submit' value='更新'/></th>";
					echo "</tr>";

				}else{
					echo "查詢失敗!";
				}

			}else{
				echo "資料不完全";
			}
		?>

	  </table>
	</form>
</body>
</html>
