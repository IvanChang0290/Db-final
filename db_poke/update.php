<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>修改寶可夢技能</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    table {
        margin-top: 20px;
    }
    .back-button {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .back-button button {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
    .back-button button:hover {
        background-color: #218838;
    }
</style>
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
            $P_ID= $_GET['P_ID'];


            if (isset($B_ID) && isset($P_ID)) {
                $select_sql = "SELECT * FROM have WHERE B_ID='$B_ID' AND P_ID='$P_ID'"; 
                $result = $conn->query($select_sql);

                if ($result->num_rows > 0) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    echo "<tr>
                        <th>P_ID</th>
                        <td bgcolor='#FFFFFF'><input type='text' name='P_ID' value='" . $row['P_ID'] . "' readonly></td>
                        </tr>";
                    
                    // Fetch and display skills
                    $skill1 = $skill2 = $skill3 = "";
                    $skills_sql = "SELECT S_ID FROM have WHERE B_ID='$B_ID' AND P_ID='$P_ID'";
                    $skills_result = $conn->query($skills_sql);
                    $skills = array();
                    while ($skills_row = mysqli_fetch_assoc($skills_result)) {
                        $skills[] = $skills_row['S_ID'];
                    }
                    $skill1 = isset($skills[0]) ? $skills[0] : "";
                    $skill2 = isset($skills[1]) ? $skills[1] : "";
                    $skill3 = isset($skills[2]) ? $skills[2] : "";

                    echo "<tr>
                        <th>技能 1</th>
                        <td bgcolor='#FFFFFF'><input type='text' name='skill1' value='$skill1' /></td>
                        </tr>";
                    echo "<tr>
                        <th>技能 2</th>
                        <td bgcolor='#FFFFFF'><input type='text' name='skill2' value='$skill2' /></td>
                        </tr>";
                    echo "<tr>
                        <th>技能 3</th>
                        <td bgcolor='#FFFFFF'><input type='text' name='skill3' value='$skill3' /></td>
                        </tr>";

                    echo "<tr>
                        <th colspan='2'><input type='submit' value='更新'/></th>
                        </tr>";
                } else {
                    echo "查詢失敗!";
                }
            } else {
                echo "資料不完全";
            }
        ?>
    </table>
</form>
<div class="back-button">
    <button onclick="location.href='display.php?ID=<?php echo $ID ?>'">返回</button>
</div>
</body>
</html>
