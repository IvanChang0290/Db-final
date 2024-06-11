<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>修改寶可夢技能</title>
<style>
    body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .all-container {
            width: 400px;
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
            width: 20%;
        }
        .info-container .table1 td {
            width: 40%;
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
            width: 100%;
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
            width: 35%;
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
    .back-button {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .back-button button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-left: 10px;
        margin-right: 10px;
    }
    .back-button button:hover {
        background-color: #218838;
    }
    .update-button {
        text-align: center;
    }
    .update-button button {
        background-color: #007bff;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }
    .update-button button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<h1 align="center">修改寶可夢技能</h1>
<div class='all-container'>
<div class='regin-container'>

<form method="post">    
    <table class='table1'>
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
                $sql = "SELECT name FROM pokemon WHERE P_ID='$P_ID'";
                $result = $conn->query($sql);
                $pokeName = '';
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $pokeName = $row["name"];
                }
                else
                {
                    echo "No such pokemon";
                }

                $select_sql = "SELECT * FROM have WHERE B_ID='$B_ID' AND P_ID='$P_ID'"; 
                $result = $conn->query($select_sql);

                if ($result->num_rows > 0) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    
                    
                    echo "<tr>
                        <th>P_ID</th>
                        <td>$pokeName</td>
                        <td><input type='text' name='P_ID' value='" . $row['P_ID']. "' readonly></td>
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
                    
                    
                    $sql = "SELECT name FROM skill WHERE S_ID='$skill1'";
                    $result = $conn->query($sql);
                    $skillName = '';
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $skillName = $row["name"];
                    }
                    else
                    {
                        echo "No such skill";
                    }

                    $sql2 = "SELECT name FROM skill WHERE S_ID='$skill2'";
                    $result2 = $conn->query($sql2);
                    $skillName2 = '';
                    if ($result2->num_rows > 0) {
                        $row = $result2->fetch_assoc();
                        $skillName2 = $row["name"];
                    }
                    else
                    {
                        echo "No such skill";
                    }

                    $sql3 = "SELECT name FROM skill WHERE S_ID='$skill3'";
                    $result3 = $conn->query($sql3);
                    $skillName3 = '';
                    if ($result3->num_rows > 0) {
                        $row = $result3->fetch_assoc();
                        $skillName3 = $row["name"];
                    }
                    else
                    {
                        echo "No such skill";
                    }

                    echo "<tr>
                        <th>技能 1</th>
                        <td >$skillName</td>
                        <td ><input type='text' name='skill1' value='$skill1' maxlength='3'/>
                        <input type='hidden' name='origin_skill1' value='$skill1' /></td>
                        </tr>";
                    echo "<tr>
                        <th>技能 2</th>
                        <td >$skillName2</td>
                        <td ><input type='text' name='skill2' value='$skill2' maxlength='3'/>
                        <input type='hidden' name='origin_skill2' value='$skill2' /></td>
                        </tr>";
                    echo "<tr>
                        <th>技能 3</th>
                        <td >$skillName3</td>
                        <td ><input type='text' name='skill3' value='$skill3' maxlength='3'/>
                        <input type='hidden' name='origin_skill3' value='$skill3' /></td>
                        </tr>";

                } else {
                    echo "查詢失敗!";
                }
            } else {
                echo "資料不完全";
            }
        ?>
    </table>
    <?php
        $url='doupdate.php?ID=' . $_GET['ID'] ;
    ?>
    <div class="back-button">
        <button type='submit' formaction="<?php echo $url ?>">更新</button>
        <button formaction="display.php?ID=<?php echo $ID ?>">返回</button>
        
    </div>
</form>
</div>
</div>

</body>
</html>
