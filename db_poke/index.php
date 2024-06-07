<!DOCTYPE html>
<html>
<head>
    <title>Pokémon Pokédex</title>
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
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        .form-container {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 5px;
        }
        .form-container button {
            background-color: #007bff;
            color: white;
            padding: 15px;
            margin: 10px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container .toggle-link {
            display: block;
            text-align: center;
            margin: 10px 0;
            color: #007bff;
            cursor: pointer;
            text-decoration: none;
        }
        .form-container .visitor-link {
            display: block;
            text-align: center;
            margin: 10px 0;
            color: #007bff;
            cursor: pointer;
            text-decoration: none;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        .form-container .toggle-link:hover,
        .form-container .visitor-link:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function showForm(formId) {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'none';
            document.getElementById(formId).style.display = 'block';
        }
    </script>
</head>
<body>

    <h1>Pokémon Pokédex</h1>

    <div id="login-form" class="form-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
            <span class="toggle-link" onclick="showForm('register-form')">Don't have an account? Register</span>
        </form>
    </div>

    <div id="register-form" class="form-container" style="display:none;">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="register-username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="register-password" name="password" required>
            
            <button type="submit">Register</button>
            <span class="toggle-link" onclick="showForm('login-form')">Already have an account? Login</span>
        </form>
        <a class="visitor-link" href="visitor.php">Continue as Visitor</a>
    </div>

</body>
</html>
