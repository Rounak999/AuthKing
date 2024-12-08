<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    header("location: login.php"); // Redirect to login page if not logged in
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style type="text/css">
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
            width: 400px;
            padding: 40px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 1s ease-out, float 3s ease-in-out infinite;
        }
        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            color: #4CAF50;
            font-weight: 600;
            animation: fadeColor 3s linear infinite;
        }
        /* Animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        @keyframes fadeColor {
            0% {
                color: #4CAF50;
            }
            50% {
                color: #007bff;
            }
            100% {
                color: #4CAF50;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome</h1>
        <p>flag{######}</p>
    </div>
</body>
</html>
