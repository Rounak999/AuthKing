<?php
include("db_connect.php");
session_start(); // Start the session
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = $_POST['username'];
    $incomingHashedPassword = $_POST['password']; 

    
    $stmt = $conn->prepare("SELECT password FROM login_details WHERE employee_id = ?");
    $stmt->bind_param("s", $myusername);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($storedPassword);
        $stmt->fetch();

        $finalHashedValue = sha1($storedPassword . $myusername);

        if ($finalHashedValue === $incomingHashedPassword) {
            // Password match; set session and navigate to welcome.php
            $_SESSION['login_user'] = $myusername;
            header("location: welcome.php");
            exit;
        } else {
            $error = "Your Login Name or Password is invalid";
        }
    } else {
        $error = "Your Login Name or Password is invalid";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f9f9f9, #e9ecef);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .container {
            width: 350px;
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }
        .header {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .content {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
        }
        .box {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .box:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
            outline: none;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #007bff, #00b4d8);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background: linear-gradient(135deg, #00b4d8, #007bff);
        }
        .error {
            font-size: 13px;
            color: #cc0000;
            margin-top: 10px;
            text-align: center;
        }

        /* Animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha1/0.6.0/sha1.min.js"></script>
    <script>
        function hashPassword(event) {
            event.preventDefault(); // Prevent form from submitting
            const username = document.getElementsByName('username')[0].value;
            const password = document.getElementsByName('password')[0].value;

            const hashedPassword = sha1(password);
            const combinedHash = sha1(hashedPassword + username);
            document.getElementsByName('password')[0].value = combinedHash;

            // Submit the form
            document.getElementById('login-form').submit();
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">Login</div>
        <div class="content">
            <form id="login-form" action="" method="post" onsubmit="hashPassword(event)">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="box" required />
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="box" required />
                <input type="submit" value="Submit" />
            </form>
            <div class="error"><?php echo $error; ?></div>
        </div>
    </div>
</body>
</html>
